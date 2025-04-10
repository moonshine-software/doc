# Html

@include('_includes/note-about-appearance-layout')

The `Html` component serves as the foundation for building html page.
The component is a wrapper for the `<html>` tag and already includes `<!DOCTYPE html>`.

```php
make(array|iterable $components = [])
```

- `$components` - array of components.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Html;

Html::make([
    Head::make([]),
    Body::make([]),
]);
```
tab: Blade
```blade
<x-moonshine::layout.html>
    <x-moonshine::layout.head />
    <x-moonshine::layout.body>
        // ...
    </x-moonshine::layout.body>
</x-moonshine::layout.html>
```
~~~

> [!NOTE]
> Child components: [Head](/docs/{{version}}/components/head), [Body](/docs/{{version}}/components/body).
