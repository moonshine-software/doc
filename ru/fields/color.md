# Color

Расширяет [Text](/docs/{{version}}/fields/text)
* имеет те же функции    

Поле *Color* является расширением *Text*, которое предоставляет удобный способ ввода цветов.
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


