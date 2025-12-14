# HasManyThrough

Наследует [HasMany](/docs/{{version}}/fields/has-many).

\* имеет те же возможности.

Поле `HasManyThrough` предназначено для работы с одноименной связью в **Laravel**.
Оно наследуется от поля `HasMany` и включает все его методы.

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
