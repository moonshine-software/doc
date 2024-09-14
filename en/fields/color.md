https://moonshine-laravel.com/docs/resource/fields/fields-color?change-moonshine-locale=en

------
# Color

## Extends [Text](https://moonshine-laravel.com/docs/resource/fields/fields-text)
* has the same features    

The *Color* field is an extension of *Text*, which provides a convenient way to enter colors.
```php
use MoonShine\Fields\Color;

//...

public function fields(): array
{
    return [
        Color::make(&#39;Color&#39;)
    ];
}

//
```
![Color](https://moonshine-laravel.com/screenshots/color.png)

![Color](https://moonshine-laravel.com/screenshots/color_dark.png)


