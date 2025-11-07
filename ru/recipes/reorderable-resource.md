# Reorderable resource

> [!WARNING]
> Такой способ сортировки подходит только если записей мало и не используется пагинация!

В данном примере таблица ресурса будет сортироваться по полю `position`, поэтому убедитесь, что это поле есть у модели.

Добавьте в свой ресурс следующий код:

```php
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\MoonShineRequest;
use MoonShine\UI\Components\Table\TableBuilder;

protected string $sortColumn = 'position';

protected SortDirection $sortDirection = SortDirection::ASC;

/**
 * @param TableBuilder $component
 */
public function modifyListComponent(ComponentContract $component): ComponentContract
{
    return $component->reorderable(
        $this->getAsyncMethodUrl('reorder')
    );
}

public function reorder(MoonShineRequest $request): void
{
    if ($request->str('data')->isNotEmpty()) {
        $request->str('data')->explode(',')->each(
            fn($id, $position) => $this->getModel()
                ->where('id', $id)
                ->update([
                    'position' => $position + 1,
                ]),
        );
    }
}
```

При таком подходе можно перетаскивать строки хватаясь курсором за любую ячейку. Чтобы аккуратно перетаскивать строки за ручку (как сделано в поле `Json`), необходимо добавить колонку-ручку с заданным классом и передать этот класс библиотеке `SortableJS`. Содержимое колонки не важно — в данном примере ставится иконка, а класс `handle` добавляется всей ячейке.

Добавьте новое поле в метод fields() индексной страницы с иконкой ручки:
```php
protected function fields(): iterable
{
    return [
        Preview::make(
            column: '__handle',
            formatted: static fn () => Icon::make('bars-4'),
        )->customWrapperAttributes(['class' => 'handle', 'style' => 'cursor: move']),
        // ... Прочие колонки таблицы
    ];
}
```

Чтобы сообщить `SortableJS` какой элемент будет ручкой, следует добавить таблице атрибут `data-handle` с css селектором. В данном примере это класс `handle`. Дополните метод ресурса:
```php
public function modifyListComponent(ComponentContract $component): ComponentContract
{
    return $component->reorderable(
        $this->getAsyncMethodUrl('reorder')
    )->customAttributes([
        'data-handle' => '.handle',
    ]);
}
```
Теперь строки перетаскиваются только за первую ячейку, оставляя прочие столбцы свободными для взаимодействия и выделения текста.

Также можно не добавлять отдельную ячейку-ручку, а добавить класс уже существующему столбцу и передать селектор в `data-handle`.
