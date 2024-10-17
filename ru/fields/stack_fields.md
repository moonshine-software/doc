# StackFields

Поле `StackFields` позволяет группировать поля при отображении в предпросмотре.

Метод `fields()` требует передачи массива полей для группировки.

Метод `withLabels()` может быть использован для отображения меток на странице индекса.

```php
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\StackFields;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        StackFields::make('Заголовок')->fields([
            Text::make('Заголовок'),
            BelongsTo::make('Автор', resource: 'name'),
        ])
    ];
}

//...
```

![stack_fields](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/stack_fields.png)
![stack_fields_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/stack_fields_dark.png)
