# Divider

- [Basics](#basics)
- [Label](#label)
- [Centering](#centering)

---

<a name="basics"></a>
## Basics

To divide HTML content into areas, you can use `Divider`.

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
## Label

You can use text as a separator; to do this, you need to pass it to the `make()` method.

```php
Divider::make('Separator')
```

<a name="centering"></a>
## Centering

The `centered()` method allows you to center the text.

```php
Divider::make('Separator')
    ->centered()
```
