# StackFields

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