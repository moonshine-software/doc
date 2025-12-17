# MorphMany

Наследует [HasMany](/docs/{{version}}/fields/has-many).

\* имеет те же возможности.

Поле отношения в **Laravel** типа `MorphMany`.

> [!WARNING]
> Параметр `formatted` не используется в поле `MorphMany`!

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
