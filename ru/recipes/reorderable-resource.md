# Reorderable resource

> [!WARNING]
> Такой способ сортировки подходит только если записей мало и не используется пагинация!

В данном примере таблица ресурса будет сортироваться по полю `posit`, поэтому убедитесь, что это поле есть у модели.

Добавьте в свой ресурс следующий код:

```php
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\MoonShineRequest;
use MoonShine\UI\Components\Table\TableBuilder;

protected string $sortColumn = 'posit';

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
                    'posit' => $position + 1,
                ]),
        );
    }
}
```
