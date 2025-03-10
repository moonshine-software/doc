# TopBar

@include('_includes/note-about-appearance-layout')

The `TopBar` component is designed to create a top navigation panel.

```php
make(iterable $components = [])
```

- `$components` - array of components.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Menu;
use MoonShine\UI\Components\Layout\TopBar;

TopBar::make([
    Menu::make()->top()
])
```
tab: Blade
```blade
<x-moonshine::layout.top-bar>
    <x-moonshine::layout.menu
        :elements="[
            ['label' => 'Dashboard', 'url' => '/'],
            ['label' => 'Section', 'url' => '/section'],
        ]
    "/>
</x-moonshine::layout.top-bar>
```
~~~

![topbar](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/topbar.png#light)
![topbar_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/topbar_dark.png#dark)
