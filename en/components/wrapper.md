# Wrapper

@include('_includes/note-about-appearance-layout')

The `Wrapper` component is used as a wrapper to ensure that the sidebar and content part are displayed correctly.
It is used immediately after the `Body`.

```php
make(iterable $components = [])
```

- `$components` - array of components.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Body;
use MoonShine\UI\Components\Layout\Wrapper;

Body::make([
    Wrapper::make([
        // ...
    ])
])
```
tab: Blade
```blade
<x-moonshine::layout.body>
    <x-moonshine::layout.wrapper>
        Content
    </x-moonshine::layout.wrapper>
</x-moonshine::layout.body>
```
~~~
