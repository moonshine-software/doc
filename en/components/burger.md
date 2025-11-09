# Burger

The `Burger` component displays a button-icon for showing the mobile menu.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Burger;

Burger::make()
```
tab: Blade
```blade
<x-moonshine::layout.burger />
```
~~~

By default, the burger button opens and closes the menu from the Sidebar.

If you need the burger to control the menu from the Topbar, use the `topbar()` method:

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Burger;

Burger::make()->topbar()
```
tab: Blade
```blade
<x-moonshine::layout.burger topbar />
```
~~~

If you need the burger to control the menu from the MobileBar, use the `mobileBar()` method:

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Burger;

Burger::make()->mobileBar()
```
tab: Blade
```blade
<x-moonshine::layout.burger mobile-bar />
```
~~~
