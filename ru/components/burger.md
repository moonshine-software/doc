# Burger

Компонент `Burger` отображает кнопку-иконку для отображения мобильного меню.

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

По умолчанию кнопка `Burger` открывает и закрывает меню из Sidebar.

Если нужно, чтобы `Burger` управлял меню из Topbar, используйте метод `topbar()`:

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

Если нужно, чтобы `Burger` управлял меню из MobileBar, используйте метод `mobileBar()`:

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
