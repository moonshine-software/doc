# ID

Наследует [Hidden](/docs/{{version}}/fields/hidden).

\* имеет те же возможности

Поле `ID` используется для `primary key`.
Оно так же как и поле `Hidden` отображается только в режиме "preview" и не отображается в формах.

```php
make(
    Closure|string|null $label = 'ID',
    ?string $column = 'id',
    ?Closure $formatted = null,
)
```

Если `primary key` имеет наименование, отличное от `id`, то необходимо указать аргументы у метода `make()`.

```php
use MoonShine\UI\Fields\ID;

ID::make(column: 'primary_key')
```
