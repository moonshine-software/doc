# Position

Extends [Preview](https://moonshine-laravel.com/docs/resource/fields/fields-preview)
* has the same features  

The *Position* field allows you to create numbering for iterating elements.

```php
use MoonShine\Fields\Json;
use MoonShine\Fields\Position;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Json::make('Product Options', 'options')
            ->fields([
                Position::make(),
                Text::make('Title'),
                Text::make('Value'),
                Switcher::make('Active')
            ])
    ];
}

//...
```

![json_fields](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/json_fields.png)  
![json_fields_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/json_fields_dark.png)
