# StackFields

The `StackFields` field allows you to group fields when displayed in preview.

The `fields()` method needs to be passed an array of fields to group.

The `withLabels()` method can be used to display labels on the index page.

```php
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\StackFields;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        StackFields::make('Title')->fields([
            Text::make('Title'),
            BelongsTo::make('Author', resource: 'name'),
        ])
    ];
}

//...
```

![stack_fields](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/stack_fields.png)
![stack_fields_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/stack_fields_dark.png)

