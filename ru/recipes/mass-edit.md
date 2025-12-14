# Массовое редактирование записей

В данным примере мы добавим `bulk` кнопку на индексной странице и в модальном окне отредактируем заголовки всех выбранных записей.

> [!NOTE]
> Если решите использовать данный рецепт, не забудьте добавить валидацию и используйте пример с умом.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\Core\DependencyInjection\CrudRequestContract;
use MoonShine\Crud\JsonResponse;

#[AsyncMethod]
public function massEdit(CrudRequestContract $request): JsonResponse
{
    Post::query()
        ->whereIn('id', $request->array('ids'))
        ->update([
            'name' => $request->input('name')
        ]);

    return JsonResponse::make()->toast('Success', ToastType::SUCCESS);
}

protected function buttons(): ListOf
{
    return parent::buttons()->add(
        ActionButton::make()
            ->bulk()
            ->icon('pencil')
            ->inModal(
                'Mass edit',
                fn() => FormBuilder::make()
                    ->name('mass-edit')
                    ->fields([
                        HiddenIds::make($this->getListComponentName()),
                        Text::make('Name')->required(),
                    ])
                    ->asyncMethod('massEdit', events: [
                        AlpineJs::event(
                            JsEvent::TABLE_UPDATED,
                            $this->getListComponentName()
                        )
                    ])
                    ->submit('Save'),
            ),
    );
}
```
