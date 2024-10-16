# Switcher

Расширяет [Checkbox](/docs/{{version}}/fields/checkbox)
* имеет те же функции  

Поле *Switcher* является расширением *Checkbox* с другим визуальным дизайном.

```php
use MoonShine\Fields\Switcher;

//...

public function fields(): array
{
    return [
        Switcher::make('Publish', 'is_publish')
    ];
}

//...
```
![switcher](https://moonshine-laravel.com/screenshots/switcher.png)
![switcher_dark](https://moonshine-laravel.com/screenshots/switcher_dark.png)
