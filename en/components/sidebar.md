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
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Layout\Sidebar;

Sidebar::make([
    Fragment::make([
        Div::make([
            Logo::make(
                '/',
                '/vendor/moonshine/logo-small.svg',
            )->minimized(),
        ])->class('menu-logo'),
        Div::make([
            Notifications::make(),
            ThemeSwitcher::make(),
        ])->class('menu-actions'),
        Div::make([
            Burger::make()->sidebar(),
        ])->class('menu-burger'),
    ])->class('menu-header')->name('sidebar-top'),

    Fragment::make([
        Menu::make(),
    ])->customAttributes([
        'class' => 'menu menu--vertical',
    ])->name('sidebar-content'),
])->collapsed()
```
tab: Blade
```blade
<x-moonshine::layout.sidebar :collapsed="true">
    <x-moonshine::layout.div class="menu-header">
        <x-moonshine::layout.div class="menu-logo">
            <x-moonshine::layout.logo href="/" logo="/vendor/moonshine/logo-small.svg" logo-small="/vendor/moonshine/logo-small.svg" :minimized="true"/>
        </x-moonshine::layout.div>

        <x-moonshine::layout.div class="menu-actions">
            <x-moonshine::layout.theme-switcher/>
        </x-moonshine::layout.div>

        <x-moonshine::layout.div class="menu-burger">
            <x-moonshine::layout.burger sidebar />
        </x-moonshine::layout.div>
    </x-moonshine::layout.div>

    <x-moonshine::layout.div class="menu menu--vertical">
        <x-moonshine::layout.menu
            :elements="[
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Section', 'url' => '/section'],
            ]"
        />
    </x-moonshine::layout.div>
</x-moonshine::layout.sidebar>
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
