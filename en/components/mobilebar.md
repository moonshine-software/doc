# MobileBar

@include('_includes/note-about-appearance-layout')

The `MobileBar` component is necessary if you want to customize the mobile dropdown panel according to your needs,
as by default it duplicates the content of the `TopBar` or `Sidebar`.

```php
make(iterable $components = [])
```

- `$components` - array of components.

```php
use MoonShine\UI\Components\Layout\MobileBar;

MobileBar::make([
    Div::make([
        Div::make([
            $this->getLogoComponent(),
        ])->class('menu-heading-logo'),

        Div::make([
            ThemeSwitcher::make(),

            Div::make([
                Burger::make(),
            ])->class('menu-heading-burger'),
        ])->class('menu-heading-actions'),
    ])->class('menu-heading'),

    Div::make([
        Menu::make(),
        When::make(
            fn (): bool => $this->isAuthEnabled(),
            static fn (): array => [Profile::make(withBorder: true)],
        ),
    ])->customAttributes([
        'class' => 'menu',
        ':class' => "asideMenuOpen && '_is-opened'",
    ]),
])
```
