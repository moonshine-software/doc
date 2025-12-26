# Loader

- [Основы](#basics)
- [Смена view](#change-view)

---

<a name="basics"></a>
## Основы

Компонент `Loader` позволяет создать стилизованный индикатор загрузки.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Loader;

Loader::make()
```
tab: Blade
```blade
<x-moonshine::loader />
```
~~~

@preview('loader')

<a name="change-view"></a>
## Смена view

Если вам не нравится базовый индикатор загрузки, тогда вы можете глобально изменить его blade view через `ServiceProvider`.

```php
Loader::changeView('my-custom-view-path');
```
