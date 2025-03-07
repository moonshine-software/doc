# Reorderable resource

> [!WARNING]
> This sorting method is only suitable if there are few records and pagination is not used!

Add the following methods to the resource:

```php
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\MoonShineRequest;
use MoonShine\UI\Components\Table\TableBuilder;

/**
 * @param TableBuilder $component
 */
public function modifyListComponent(ComponentContract $component): ComponentContract
{
    return $component->reorderable(
        $this->getAsyncMethodUrl('reorder')
    );
}

public function reorder(MoonShineRequest $request)
{
    if ($request->str('data')->isNotEmpty()) {
        $request->str('data')->explode(',')->each(
            fn($id, $position) => $this->getModel()
                ->where('id', $id)
                ->update([
                    'posit' => $position + 1,
                ]),
        );
    }
}
```
