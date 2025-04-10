# Menu

- [Basics](#basics)
- [Horizontal Menu Mode](#top)
- [Scroll to Active Item](#scroll-to)

---

<a name="basics"></a>
## Basics

The `Menu` component creates a menu based on `MenuManager` or the provided menu items.

```php
make(?iterable $elements = [])
```

- `$elements` - set of menu items; if it is empty, it will take `MenuManager` as the basis.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\MenuManager\MenuItem;
use MoonShine\UI\Components\Layout\Menu;

Menu::make([
    MenuItem::make('Item', '/')
]);
```
tab: Blade
```blade
<x-moonshine::layout.menu
    :elements="[['label' => 'Dashboard', 'url' => '/'], ['label' => 'Section', 'url' => '/section']]"
    :top="false"
    :scroll-to="false" />
```
~~~

You can also initialize the menu through a primitive array.

```php
Menu::make([
    ['label' => 'Dashboard', 'url' => '/'],
    ['label' => 'Section', 'url' => '/section'],
])
```

<a name="top"></a>
## Horizontal Menu Mode

If you decide to place the menu in a horizontal mode in the `TopBar`, use the `top()` method.

```php
Menu::make()->top()
```

<a name="scroll-to"></a>
## Scroll to Active Item

By default, if the menu is not in *top* mode, it scrolls to the active menu item.
This behavior can be disabled using the `withoutScrollTo()` method.

```php
Menu::make()->withoutScrollTo()
```

To enable it back:

```php
Menu::make()->scrollTo()
```
