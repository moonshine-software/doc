# SecondBar

- [Basics](#basics)
- [Collapsible](#collapsed)
- [Usage Example](#usage-example)

---

<a name="basics"></a>
## Basics

@include('_includes/note-about-appearance-layout')

The `SecondBar` component is designed to create an additional sidebar with a menu for a specific page.

```php
make(iterable $components = [])
```

- `$components` - array of components.

`SecondBar` is displayed between the main `Sidebar` and the page content, allowing you to create a secondary navigation menu for the current page.

> [!NOTE]
> `SecondBar` is automatically hidden on mobile devices (screens smaller than `lg`).

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
## Collapsible

By default, `SecondBar` is always open, but with the `collapsed()` method, you can add the ability to collapse `SecondBar`.

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
## Usage Example

To use `SecondBar` on a page, you need to override the `menu()` method in the page class, which returns an array of menu elements.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\MoonShine\Pages;

use MoonShine\Laravel\Pages\Page;
use MoonShine\MenuManager\MenuItem; // [tl! collapse:end]

class CustomPage extends Page
{
    // ...

    protected function menu(): array
    {
        return [
            MenuItem::make('Section 1', '/section1'),
            MenuItem::make('Section 2', '/section2'),
            MenuItem::make('Section 3', '/section3'),
        ];
    }
}
```

Then, in your custom `Layout`, you need to add the `SecondBar` component, which will display the page menu:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\UI\Components\Layout\SecondBar;
use MoonShine\UI\Components\Layout\Menu;
use MoonShine\UI\Components\When; // [tl! collapse:end]

class CustomLayout extends AppLayout
{
    protected bool $secondBar = true;

    // ...
}
```

> [!TIP]
> The base `AppLayout` already implements support for `SecondBar`.
> Simply set the `$secondBar = true` property in your custom layout,
> and `SecondBar` will be automatically displayed with the menu from the current page's `menu()` method.
