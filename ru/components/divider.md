# Divider

- [Основы](#basics)
- [Метка](#label)
- [Центрирование](#сentering)

---

<a name="basics"></a>
## Основы

Для разделения html-контента на зоны можно использовать `Divider`.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Layout\Divider;

Divider::make()
```
tab: Blade
```blade
<x-moonshine::layout.divider/>
```
~~~

<a name="label"></a>
## Метка

Вы можете использовать текст в качестве разделителя, для этого нужно передать его в метод `make()`.

```php
Divider::make('Separator')
```

<a name="centering"></a>
## Центрирование

Метод `centered()` позволяет центрировать текст.

```php
Divider::make('Separator')
    ->centered()
```
