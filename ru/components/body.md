# Body

@include('_includes/note-about-appearance-layout')

Компонент `Body` предназначен для создания тега `<body>`.

```php
make(iterable $components = [])
```

- `$components` - массив компонентов.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Layout\Body;

Body::make([
    // ...
])
```
tab: Blade
```blade
<x-moonshine::layout.body>
    Any content
</x-moonshine::layout.body>
```
~~~
