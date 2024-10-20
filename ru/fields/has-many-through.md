# HasManyThrough

Наследует [HasMany](/docs/{{version}}/fields/has-many).

\* имеет те же возможности.

Поле *HasManyThrough* предназначено для работы с отношением того же имени в Laravel, наследуется от поля *HasMany* и включает все его методы.

```php
use MoonShine\Laravel\Fields\Relationships\HasManyThrough;

HasManyThrough::make('Deployments', 'deployments', resource: DeploymentResource::class)
```