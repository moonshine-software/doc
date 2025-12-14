# HasManyThrough

Inherits from [HasMany](/docs/{{version}}/fields/has-many).

\* has the same capabilities.

The `HasManyThrough` field is designed to work with the same-name relationship in **Laravel**.
It inherits from the `HasMany` field and including all its methods.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Fields\Relationships\HasManyThrough;

HasManyThrough::make(
    'Deployments',
    'deployments',
    resource: DeploymentResource::class
)
```
