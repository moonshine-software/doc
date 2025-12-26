# BottomBar

@include('_includes/note-about-appearance-layout')

Компонент `BottomBar` предназначен для создания нижней панели навигации, которая может содержать меню и другие элементы управления.

```php
make(iterable $components = [])
```

- `$components` - массив компонентов.

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

@preview('bottom-bar')
