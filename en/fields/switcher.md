# Switcher

Extends [Checkbox](https://moonshine-laravel.com/docs/resource/fields/fields-checkbox)
* has the same features  

The *Switcher* field is an extension of *Checkbox* with a different visual design.

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
