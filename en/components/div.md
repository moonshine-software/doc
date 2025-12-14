# Div

The `Div` component simply displays a `<div>` tag with the ability to specify nested components and add attributes.

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
