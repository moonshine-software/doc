# Layout

@include('_includes/note-about-appearance-layout')

The system component `Layout` is the starting point when creating layouts and is used once in the `build()` method.

```php
make(iterable $components = [])
```

- `$components` - array of components.

~~~tabs
tab: Class
```php
namespace App\MoonShine\Layouts;

use MoonShine\UI\Components\Layout\Layout;

final class MoonShineLayout extends AppLayout
{
    public function build(): Layout
    {
        return Layout::make([
            // ...
        ]);
    }
}
```
tab: Blade
```blade
<x-moonshine::layout>
    Any content
</x-moonshine::layout>
```
~~~
