# HasOneThrough

Наследует [HasMany](/docs/{{version}}/fields/has-one).

\* имеет те же возможности.

Поле *HasOneThrough* предназначено для работы с отношением того же имени в Laravel, наследуется от поля *HasOne* и включает все его методы.

```php
use MoonShine\Laravel\Fields\Relationships\HasOneThrough;

HasOneThrough::make('Car owner', 'carOwner', resource: new OwnerResource::class)
```
