# Reorderable resource

> [!WARNING]
> This sorting method is only suitable if there are few records and pagination is not used!

In this example, the resource table will be sorted by the `position` field, so make sure that the model has this field.

Add the following methods to the resource:

```php
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\Core\DependencyInjection\CrudRequestContract;
use MoonShine\Support\Attributes\AsyncMethod;
use MoonShine\UI\Components\Table\TableBuilder;

protected string $sortColumn = 'position';

protected bool $usePagination = false;

protected SortDirection $sortDirection = SortDirection::ASC;

#[AsyncMethod]
public function reorder(CrudRequestContract $request): void
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

Add the code to the index page of the resource:

```php
/**
 * @param TableBuilder $component
 */
protected function modifyListComponent(ComponentContract $component): ComponentContract
{
    return $component->reorderable(
        $this->getResource()->getAsyncMethodUrl('reorder')
    );
}
```

With this approach, you can drag rows by clicking on any cell with your mouse. To carefully drag rows using the handle (as in the `Json` field), you will need to add a handle column with a specific class and pass that class to the `SortableJS` library. The content of the column does not matter — in this example, we have added an icon and the `handle` class to the entire cell.

Add a new field to the index page using the fields() method with the handle icon:
```php
protected function fields(): iterable
{
    return [
        Preview::make(
            column: '__handle',
            formatted: static fn () => Icon::make('bars-4'),
        )->customWrapperAttributes(['class' => 'handle', 'style' => 'cursor: move']),
        // ... Other columns of the table
    ];
}
```

To tell SortableJS which element should be used as a handle, you need to add the `data-handle` attribute with a CSS selector to the table. In this case, we use the `handle` class. Then, you need to define a resource method:
```php
protected function modifyListComponent(ComponentContract $component): ComponentContract
{
    return $component->reorderable(
        $this->getResource()->getAsyncMethodUrl('reorder')
    )->customAttributes([
        'data-handle' => '.handle',
    ]);
}
```
With this setup, the rows can only be dragged by the first column, leaving the other columns free for other interactions and text selection.

You may also choose not to create a separate handle column, but instead, add a class to an existing column and pass its selector as the value of the `data-handle` attribute.
