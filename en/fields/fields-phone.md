https://moonshine-laravel.com/docs/resource/fields/fields-phone?change-moonshine-locale=en

------

# Phone

Extends [Text](https://moonshine-laravel.com/docs/resource/fields/fields-text)
* has the same features  

The *Phone* field is an extension of *Text*, which by default sets `type=tel`.  

```php
use MoonShine\Fields\Phone;

//...

public function fields(): array
{
    return [
        Phone::make('Phone')
    ];
}

//...
```

> [!NOTE]
> To use a mask for the phone, use the `mask('7 999 999-99-99')` method
