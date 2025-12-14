# MobileBar

@include('_includes/note-about-appearance-layout')

The `MobileBar` component is necessary if you want to customize the mobile dropdown panel according to your needs,
as by default it duplicates the content of the `TopBar` or `Sidebar`.

> [!WARNING]
> MobileBar should be placed above the Sidebar and Topbar

```php
make(iterable $components = [])
```

- `$components` - array of components.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Layout\MobileBar;

MobileBar::make([
    Fragment::make([
        Logo::make(
            '/',
            '/vendor/moonshine/logo-small.svg',
        )->minimized(),
    ])->class('menu-logo'),

    Fragment::make([
        Divider::make('Mobile bar'),
        Menu::make()->top(),
    ])->class('menu menu--horizontal'),

    Fragment::make([
        Profile::make(),
        Div::make()->class('menu-divider menu-divider--vertical'),
        ThemeSwitcher::make(),
        Div::make([
            Burger::make()->mobileBar(),
        ])->class('menu-burger'),
    ])->class('menu-actions'),
]),
```
tab: Blade
```blade
<x-moonshine::layout.mobile-bar>
    <x-moonshine::layout.div class="menu-logo">
        <x-moonshine::layout.logo
            href="/"
            logo="/vendor/moonshine/logo-small.svg"
            logo-small="/vendor/moonshine/logo-small.svg"
            :minimized="true"
        />
    </x-moonshine::layout.div>

    <x-moonshine::layout.div class="menu menu--horizontal">
        <x-moonshine::layout.divider label="Mobile bar" />

        <x-moonshine::layout.menu
            :top="true"
            :elements="[['label' => 'Dashboard', 'url' => '/'], ['label' => 'Section', 'url' => '/section']]"
        />
    </x-moonshine::layout.div>

    <x-moonshine::layout.div class="menu-actions">
        <div class="menu-divider menu-divider--vertical"></div>
        <x-moonshine::layout.theme-switcher/>
        <x-moonshine::layout.div class="menu-burger">
            <x-moonshine::layout.burger mobile-bar />
        </x-moonshine::layout.div>
    </x-moonshine::layout.div>
</x-moonshine::layout.mobile-bar>
```
~~~
