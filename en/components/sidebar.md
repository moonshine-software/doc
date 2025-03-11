# Sidebar

- [Basics](#basics)
- [Collapsible Option](#collapsed)

---

<a name="basics"></a>
## Basics

@include('_includes/note-about-appearance-layout')

The `Sidebar` component is designed to create a side menu.

```php
make(iterable $components = [])
```

- `$components` - array of components.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Menu;
use MoonShine\UI\Components\Layout\Sidebar;

Sidebar::make([
    Menu::make(),
])
```
tab: Blade
```blade
<x-moonshine::layout.sidebar :collapsed="true">
    <x-moonshine::layout.menu
        :elements="[
            ['label' => 'Dashboard', 'url' => '/'],
            ['label' => 'Section', 'url' => '/section'],
        ]"
    />
</x-moonshine::layput.sidebar>
```
~~~

<a name="collapsed"></a>
## Collapsible Option

By default, the `Sidebar` is always open, but using the `collapsed()` method, you can add the option to hide the `Sidebar`.

```php
Sidebar::make([
    Menu::make(),
])->collapsed()
```
