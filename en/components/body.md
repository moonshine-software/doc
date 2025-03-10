# Body

@include('_includes/note-about-appearance-layout')

The `Body` component is designed to create a `<body>` tag.

```php
make(iterable $components = [])
```

- `$components` - array of components.

~~~tabs
tab: Class
```php
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
