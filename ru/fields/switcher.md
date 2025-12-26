# Switcher

Наследует [Checkbox](/docs/{{version}}/fields/checkbox).

\* имеет те же возможности

Поле `Switcher` является расширением `Checkbox` с другим визуальным оформлением.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Switcher;

Switcher::make('Publish', 'is_publish')
```
tab: Blade
```blade
<x-moonshine::form.wrapper label="Publish">
    <x-moonshine::form.switcher
        name="is_publish"
        value="1"
        :onValue="1"
        :offValue="0"
    />
</x-moonshine::form.wrapper>
```
~~~

@preview('fields.switcher')
