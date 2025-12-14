# Paginator

Paginator for *TableBuilder*.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\TypeCasts\PaginatorCaster;

protected function components(): iterable
{
    $posts = Post::query()->paginate(); // or ->simplePaginate() or ->cursorPaginate()

    $paginator = (new PaginatorCaster(
        $posts->appends(request()->except('page'))->toArray(),
        $posts->items()
    ))->cast();

    return [
        TableBuilder::make()
            ->fields([
                Text::make('Name')
            ])
            ->items($paginator)
    ];
}
```
