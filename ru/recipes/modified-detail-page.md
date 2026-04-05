# Как добавить свои элементы на детальную страницу или изменить её?

Если стандартного табличного вида детальной страницы недостаточно, вы можете переопределить `DetailPage` и собрать страницу из нужных вам компонентов.

Это удобно, когда нужно:

- добавить собственные блоки рядом с полями;
- изменить порядок отображения элементов;
- вывести связанные данные, таблицы, кнопки или любые дополнительные виджеты;
- полностью адаптировать под сценарий конкретного ресурса.

![Modified DetailPage](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/modified_detail_page.png)

```php
class ExampleDetailPage extends DetailPage
{
    protected function mainLayer(): array
    {
        return [
            $this->getDetailComponent(),
            LineBreak::make(),
            ...$this->getTopButtons(),
        ];
    }

    public function getDetailComponent(bool $withoutFragment = false): ComponentContract
    {
        return Fragment::make([
            Grid::make([
                Column::make([
                    $this->fieldsOne(),
                ], colSpan: 6),

                Column::make([
                    $this->fieldsTwo(),
                ], colSpan: 6),
            ]),
        ])->name('crud-detail');
    }

    protected function fieldsOne()
    {
        return FieldsGroup::make([
            Box::make('Example', [
                Text::make('name'),
                Text::make('title'),
            ]),
        ])
            ->fill($this->getItem()->toArray(), $this->getResource()->getCastedData())
            ->previewMode();
    }

    protected function fieldsTwo()
    {
        $resource = $this->getResource();

        return Box::make([
            TableBuilder::make([
                Text::make('name'),
                Text::make('title'),
            ])
                ->cast($resource->getCaster())
                ->items([$resource->getItem()])
                ->vertical()
                ->simple()
                ->preview()
                ->class('table-divider'),
        ]);
    }
}
```

В этом примере:

- `mainLayer()` задаёт общую структуру страницы;
- `getDetailComponent()` отвечает за основной блок с содержимым;
- `Fragment`, `Grid` и `Column` помогают собрать кастомную сетку;
- `FieldsGroup` и `Box` позволяют удобно группировать поля;

Таким образом, можно не только добавить свои элементы на детальную страницу, но и полностью перестроить её под нужный сценарий: от компактного блока с полями до полноценной панели с дополнительной
информацией и действиями.
