# Системный компонент TopBar

- [Создание](#make)
- [Действия](#actions)
- [Скрытие логотипа](#hide-logo)
- [Скрытие переключателя темы](#hide-theme-switcher)

---

## Создание

Системный компонент *TopBar* используется для создания верхней панели навигации в **MoonShine**.

Вы можете создать *TopBar*, используя статический метод `make()` класса `TopBar`.

```php
make(array $components = [])
```

В качестве параметра метод `make()` принимает массив с компонентами.

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

## Действия

Метод `actions()` компонента *TopBar* позволяет добавлять дополнительные элементы в
области *actions*. Метод принимает массив компонентов в качестве параметра.

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
