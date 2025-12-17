# MorphMany

Inherits from [HasMany](/docs/{{version}}/fields/has-many).

\* has the same capabilities.

A relationship field in **Laravel** of type `MorphMany`.

> [!WARNING]
> The `formatted` parameter is not used in the `MorphMany` field!

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Fields\Relationships\MorphMany;

MorphMany::make(
    'Comments',
    'comments',
    resource: CommentResource::class
)
```
