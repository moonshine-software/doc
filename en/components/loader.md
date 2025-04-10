# Loader

- [Basics](#basics)
- [Change view](#change-view)

---

<a name="basics"></a>
## Basics

The `Loader` component allows you to create a styled loading indicator.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Loader;

Loader::make()
```
tab: Blade
```blade
<x-moonshine::loader />
```
~~~

<a name="change-view"></a>
## Change view

If you do not like the basic loading indicator, then you can globally change its blade view through the `ServiceProvider`.

```php
Loader::changeView('my-custom-view-path');
```
