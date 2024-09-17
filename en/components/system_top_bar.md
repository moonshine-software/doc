https://moonshine-laravel.com/docs/resource/components/components-system_top_bar?change-moonshine-locale=en

------

# System component TopBar

- [Make](#make)
- [Actions](#actions)
- [Hide logo](#hide-logo)
- [Hide theme switcher](#hide-theme-switcher)

### Make

The *TopBar* system component is used to create the top navigation bar in **MoonShine**.

You can create a *TopBar* using the static method `make()` class `TopBar`.

```php
make(array $components = [])
```

As a parameter, method `make()` takes an array with components.

```php
namespace App\MoonShine;

use MoonShine\Components\Layout\LayoutBlock;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Menu;
use MoonShine\Components\Layout\Profile;
use MoonShine\Components\Layout\TopBar;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            TopBar::make([
                Menu::make()->top()
            ]),

            //...
        ]);
    }
}
```

![topbar](https://moonshine-laravel.com/screenshots/topbar.png)
![topbar_dark](https://moonshine-laravel.com/screenshots/topbar_dark.png)

### Actions

Method `actions()` of the *TopBar* component allows you to add additional elements to the
*actions* areas. The method takes an array of components as a parameter.

```php
namespace App\MoonShine;

use MoonShine\Components\Layout\LayoutBlock;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Menu;
use MoonShine\Components\Layout\Profile;
use MoonShine\Components\Layout\TopBar;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            TopBar::make([
                Menu::make()->top(),
            ])
                ->actions([
                    When::make(
                        static fn() => config('moonshine.auth.enable', true),
                        static fn() => [Profile::make()]
                    )
                ]),

            //...
        ]);
    }
}
```

![topbar_actions](https://moonshine-laravel.com/screenshots/topbar_actions.png)
![topbar_actions_dark](https://moonshine-laravel.com/screenshots/topbar_actions_dark.png)

### Hide logo

The `hideLogo()` method allows you to hide the logo.

```php
hideLogo()
```

```php
namespace App\MoonShine;

use MoonShine\Components\Layout\LayoutBlock;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Menu;
use MoonShine\Components\Layout\Profile;
use MoonShine\Components\Layout\TopBar;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            TopBar::make([
                Menu::make()->top(),
            ])
                ->hideLogo(),

            //...
        ]);
    }
}
```

### Hide theme switcher

The `hideSwitcher()` method allows you to hide the theme switcher.

```php
hideSwitcher()
```

```php
namespace App\MoonShine;

use MoonShine\Components\Layout\LayoutBlock;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Menu;
use MoonShine\Components\Layout\Profile;
use MoonShine\Components\Layout\TopBar;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            TopBar::make([
                Menu::make()->top(),
            ])
                ->hideSwitcher(),

            //...
        ]);
    }
}
```
