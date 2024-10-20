# Loader

- [Основы](#basics)
- [Смена view](#change-view)

<a name="basics"></a>
## Основы

Компонент `Loader` позволяет создать стилизованный индикатор загрузки.

~~~tabs
tab: Tab 1
```php
use MoonShine\UI\Components\Loader;

Loader::make()
```
tab: Tab 2
```blade
<x-moonshine::loader />
```
~~~

<a name="change-view"></a>
## Смена view

Если вам не нравится базовый индикатор загрузки, тогда вы можете глобально изменить его blade view через `ServiceProvider`

```php
Loader::changeView('my-custom-view-path');
```


