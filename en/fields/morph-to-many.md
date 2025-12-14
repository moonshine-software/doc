# MorphToMany

Inherits from [BelongsToMany](/docs/{{version}}/fields/belongs-to-many).

\* has the same capabilities.

Relationship field in **Laravel** of type `MorphToMany`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Fields\Relationships\MorphToMany;

MorphToMany::make(
    'Categories',
    'categories',
    resource: CategoryResource::class
)
```
