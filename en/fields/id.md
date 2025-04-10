# ID

Inherits from [Hidden](/docs/{{version}}/fields/hidden).

\* has the same capabilities

The `ID` field is used for the `primary key`.
Like the `Hidden` field, it is displayed only in the "preview" mode and does not appear in forms.

```php
make(
    Closure|string|null $label = 'ID',
    ?string $column = 'id',
    ?Closure $formatted = null,
)
```

If the `primary key` has a name that is different from `id`, you need to specify the arguments in the `make()` method.

```php
use MoonShine\UI\Fields\ID;

ID::make(column: 'primary_key')
```
