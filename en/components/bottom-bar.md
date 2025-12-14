# BottomBar

@include('_includes/note-about-appearance-layout')

The `BottomBar` component is designed to create a bottom navigation panel that can contain menus and other control elements.

```php
make(iterable $components = [])
```

- `$components` - array of components.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\MenuManager\MenuItem;
use MoonShine\UI\Components\Layout\BottomBar;
use MoonShine\UI\Components\Layout\Menu;

BottomBar::make([
    Menu::make([
        MenuItem::make('/', 'Item')
    ]);
])
```
tab: Blade
```blade
<x-moonshine::layout.bottom-bar>
    <x-moonshine::layout.menu :elements="[['label' => 'Item', 'url' => '/']]"/>
</x-moonshine::layout.bottom-bar>
```
~~~
