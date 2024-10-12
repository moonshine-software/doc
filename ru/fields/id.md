# ID

Наследует [Hidden](#/docs/{{version}}/fields/hidden.md).

\* имеет те же возможности

Поле `ID` используется для `primary key`.
Оно так же как и поле Hidden отображается только в preview и не отображается в формах.

```php
use MoonShine\UI\Fields\ID;

ID::make()
```

Если `primary key` имеет наименование, отличное от `id`, то необходимо указать аргументы у метода `make()`.

```php
ID::make('ID', 'primary_key')
```