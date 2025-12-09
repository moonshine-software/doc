# SecondBar

- [Основы](#basics)
- [Возможность скрыть](#collapsed)
- [Пример использования](#usage-example)

---

<a name="basics"></a>
## Основы

@include('_includes/note-about-appearance-layout')

Компонент `SecondBar` предназначен для создания дополнительной боковой панели с меню для конкретной страницы.

```php
make(iterable $components = [])
```

- `$components` - массив компонентов.

`SecondBar` отображается между основным `Sidebar` и содержимым страницы и позволяет создавать вторичное навигационное меню для текущей страницы.

> [!NOTE]
> `SecondBar` автоматически скрывается на мобильных устройствах (экраны меньше `lg`).

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\Layout\Menu;
use MoonShine\UI\Components\Layout\SecondBar;

SecondBar::make([
    Menu::make($this->getPage()->getMenu())
])->collapsed()
```
tab: Blade
```blade
<x-moonshine::layout.second-bar :collapsed="true">
    <x-moonshine::layout.menu
        :elements="[
            ['label' => 'Section 1', 'url' => '/section1'],
            ['label' => 'Section 2', 'url' => '/section2'],
        ]"
    />
</x-moonshine::layout.second-bar>
```
~~~

<a name="collapsed"></a>
## Возможность скрыть

По умолчанию `SecondBar` всегда открыт, но с помощью метода `collapsed()`, вы можете добавить возможность скрыть `SecondBar`.

```php
collapsed(Closure|bool $condition = true)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\Layout\Menu;
use MoonShine\UI\Components\Layout\SecondBar;

SecondBar::make([
    Menu::make(),
])->collapsed()
```

<a name="usage-example"></a>
## Пример использования

Для использования `SecondBar` на странице, необходимо переопределить метод `menu()` в классе страницы, который возвращает массив элементов меню.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:5]
namespace App\MoonShine\Pages;

use MoonShine\Laravel\Pages\Page;
use MoonShine\MenuManager\MenuItem;

class CustomPage extends Page
{
    // ...

    protected function menu(): array
    {
        return [
            MenuItem::make('Раздел 1', '/section1'),
            MenuItem::make('Раздел 2', '/section2'),
            MenuItem::make('Раздел 3', '/section3'),
        ];
    }
}
```

Затем в вашем кастомном `Layout` нужно добавить `SecondBar` компонент, который будет отображать меню страницы:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:7]
namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\UI\Components\Layout\SecondBar;
use MoonShine\UI\Components\Layout\Menu;
use MoonShine\UI\Components\When;

class CustomLayout extends AppLayout
{
    protected bool $secondBar = true;

    // ...
}
```

> [!TIP]
> В базовом `AppLayout` уже реализована поддержка `SecondBar`. Достаточно установить свойство `$secondBar = true` в вашем кастомном лейауте, и `SecondBar` будет автоматически отображаться с меню из метода `menu()` текущей страницы.
