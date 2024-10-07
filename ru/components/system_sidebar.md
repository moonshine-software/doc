# Системный компонент Sidebar

  - [Создание](#make)
  - [Скрытие логотипа](#hide-logo)
  - [Скрытие переключателя темы](#hide-switcher)

---

<a name="make"></a>
## Создание

Системный компонент *Sidebar* используется для создания бокового меню в **MoonShine**.

Вы можете создать *Sidebar*, используя статический метод `make()` класса `Sidebar`.

```php
make(array $components = [])
```

Метод `make()` принимает в качестве параметра массив компонентов.

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

<a name="hide-logo"></a>
## Скрытие логотипа

Метод `hideLogo()` позволяет скрыть логотип.

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
## Скрытие переключателя темы

Метод `hideSwitcher()` позволяет скрыть переключатель темы.

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
