# Div

Компонент `Div` просто отображает тег `<div>` с возможностью указания вложенных компонентов и добавления атрибутов.

```php
make(iterable $components)
```

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Layout\Div;

Div::make([])
```
tab: Blade
```blade
<x-moonshine::layout.div></x-moonshine::layout.div>
```
~~~
