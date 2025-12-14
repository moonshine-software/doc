# HasOneThrough

Inherits from [HasOne](/docs/{{version}}/fields/has-one).

\* has the same capabilities.

The `HasOneThrough` field is designed to work with the same-name relationship in **Laravel**.
It inherits from the `HasOne` field and including all its methods.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Fields\Relationships\HasOneThrough;

HasOneThrough::make(
    'Car owner',
    'carOwner',
    resource: OwnerResource::class
)
```
