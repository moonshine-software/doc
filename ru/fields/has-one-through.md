# HasOneThrough

Наследует [HasOne](/docs/{{version}}/fields/has-one).

\* имеет те же возможности.

Поле `HasOneThrough` предназначено для работы с одноименной связью в **Laravel**.
Оно наследуется от поля `HasOne` и включает все его методы.

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
