# StackFields

Содержит все [Базовые методы](#/docs/{{version}}/fields/basic-methods.md).

Поле `StackFields` позволяет группировать поля при отображении в предварительном просмотре.

Метод `fields()` должен принимать массив полей для группировки.

Метод `withLabels()` может использоваться для отображения меток на индексной странице.

```php
use MoonShine\UI\Fields\BelongsTo;
use MoonShine\UI\Fields\StackFields;
use MoonShine\UI\Fields\Text;

StackFields::make('Title')->fields([
    Text::make('Title'),
    BelongsTo::make('Author', resource: 'name'),
])
```

![stack_fields](https://moonshine-laravel.com/screenshots/stack_fields.png)

![stack_fields_dark](https://moonshine-laravel.com/screenshots/stack_fields_dark.png)