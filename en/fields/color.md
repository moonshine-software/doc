# Color

Extends [Text](https://moonshine-laravel.com/docs/resource/fields/fields-text)
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
![Color](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/color.png)

![Color](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/color_dark.png)


