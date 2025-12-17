# MorphOne

Наследует [HasOne](/docs/{{version}}/fields/has-one).

\* имеет те же возможности.

Поле отношения в **Laravel** типа `MorphOne`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Fields\Relationships\MorphOne;

MorphOne::make(
    'Profile',
    'profile',
    resource: ProfileResource::class
)
```
