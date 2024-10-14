# Switcher

Наследует [Checkbox](/docs/{{version}}/fields/checkbox).

* имеет те же возможности

Поле *Switcher* является расширением *Checkbox* с другим визуальным оформлением.

~~~tabs
tab: Class
```php
use MoonShine\UI\Fields\Switcher;

Switcher::make('Publish', 'is_publish')
```
tab: Blade
```blade
<x-moonshine::form.wrapper label="Publish">
    <x-moonshine::form.switcher
        name="is_publish"
        :onValue="1"
        :offValue="0"
    />
</x-moonshine::form.wrapper>
```
~~~

![switcher](https://moonshine-laravel.com/screenshots/switcher.png)

![switcher_dark](https://moonshine-laravel.com/screenshots/switcher_dark.png)
