# ID

Наследует [Hidden](/docs/{{version}}/fields/hidden)

\* имеет те же возможности

Поле `ID` используется для `primary key`.
Оно так же как и поле Hidden отображается только в preview и не отображается в формах.

```php
use MoonShine\UI\Fields\ID;

//...

protected function fields(): iterable
{
    return [
        ID::make()
    ];
}
```

Если `primary key` имеет наименование, отличное от `id`, то необходимо указать аргументы у метода `make()`.

```php
use MoonShine\UI\Fields\ID;

//...

protected function fields(): iterable
{
    return [
        ID::make('ID', 'primary_key')
    ];
}

//...
```