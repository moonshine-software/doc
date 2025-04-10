# Layout

@include('_includes/note-about-appearance-layout')

Системный компонент `Layout` является стартовой точкой при создании шаблонов и используется единожды в методе `build()`.

```php
make(iterable $components = [])
```

- `$components` - массив компонентов.

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
