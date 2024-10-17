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
![switcher](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/switcher.png)
![switcher_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/switcher_dark.png)
