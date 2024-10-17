# System component Sidebar

  - [Make](#make)
  - [Hide logo](#hide-logo)
  - [Hide theme switcher](#hide-switcher)

---

<a name="make"></a>
## Make

The *Sidebar* system component is used to create a side menu in **MoonShine**.

You can create a *Sidebar* using the static method `make()` class `Sidebar`.

```php
make(array $components = [])
```

The `make()` method takes an array of components as a parameter.

```php
namespace App\MoonShine;

use MoonShine\Components\Layout\LayoutBlock;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Menu;
use MoonShine\Components\Layout\Profile;
use MoonShine\Components\Layout\Sidebar;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            Sidebar::make([
                Menu::make()->customAttributes(['class' => 'mt-2']),
                Profile::make(withBorder: true)
            ]),

            //...
        ]);
    }
}
```

![sidebar](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/sidebar.png)
![sidebar_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/sidebar_dark.png)

<a name="hide-logo"></a>
## Hide logo

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
use MoonShine\Components\Layout\Sidebar;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            Sidebar::make([
                Menu::make(),
                Profile::make(withBorder: true)
            ])
                ->hideLogo(),

            //...
        ]);
    }
}
```

<a name="hide-switcher"></a>
## Hide theme switcher

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
use MoonShine\Components\Layout\Sidebar;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            Sidebar::make([
                Menu::make(),
                Profile::make(withBorder: true)
            ])
                ->hideSwitcher(),

            //...
        ]);
    }
}
```
