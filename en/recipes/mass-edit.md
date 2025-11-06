# Bulk Edit Records

In this example, we will add a `bulk` button on the index page and edit the headers of all selected entries in the modal.

> [!NOTE]
> If you decide to use this recipe, be sure to add validation and use the example wisely.

```php
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
