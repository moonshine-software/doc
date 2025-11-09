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
    Fragment::make([
        Logo::make(
            '/',
            '/vendor/moonshine/logo-small.svg',
        )->minimized(),
    ])->class('menu-logo')->name('topbar-logo'),

    Fragment::make([
        Menu::make()->top(),
    ])->class('menu menu--horizontal')->name('topbar-menu'),

    Fragment::make([
        Profile::make(),

        Div::make()->class('menu-divider menu-divider--vertical'),
        ThemeSwitcher::make(),

        Div::make([
            Burger::make()->topbar(),
        ])->class('menu-burger'),
    ])->class('menu-actions')->name('topbar-actions'),
])
```
tab: Blade
```blade
<x-moonshine::layout.top-bar>
    <x-moonshine::layout.div class="menu-logo">
        <x-moonshine::layout.logo
            href="/"
            logo="/vendor/moonshine/logo-small.svg"
            logo-small="/vendor/moonshine/logo-small.svg"
            :minimized="true"
        />
    </x-moonshine::layout.div>

    <x-moonshine::layout.div class="menu menu--horizontal">
        <x-moonshine::layout.menu
            :top="true"
            :elements="[
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Section', 'url' => '/section'],
            ]
        />
    </x-moonshine::layout.div>

    <x-moonshine::layout.div class="menu-actions">
        <div class="menu-divider menu-divider--vertical"></div>
        <x-moonshine::layout.theme-switcher/>
        <x-moonshine::layout.div class="menu-burger">
            <x-moonshine::layout.burger topbar />
        </x-moonshine::layout.div>
    </x-moonshine::layout.div>
</x-moonshine::layout.top-bar>
```
~~~

![topbar](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/topbar.png#light)
![topbar_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/topbar_dark.png#dark)
