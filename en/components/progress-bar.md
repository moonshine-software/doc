# ProgressBar

- [Basics](#basics)
- [Size](#size)
- [Color](#color)

---

<a name="basics"></a>
## Basics

The `ProgressBar` component allows you to create a progress indicator.

```php
make(
    float|int $value,
    string $size = 'sm',
    string|Color $color = '',
    bool $radial = false,
)
```

 - `$value` - value of the indicator,
 - `$size` - size,
 - `$color` - color,
 - `$radial` - radial progress indicator.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\ProgressBar;

ProgressBar::make(10)
```
tab: Blade
```blade
<x-moonshine::progress-bar
    color="primary"
    :value="10"
>
    10%
</x-moonshine::progress-bar>
```
~~~

<a name="size"></a>
## Size

Available sizes:

- sm
- md
- lg
- xl

```php
<x-moonshine::spinner size="sm" />
<x-moonshine::spinner size="md" />
<x-moonshine::spinner size="lg" />
<x-moonshine::spinner size="xl" />
```

<a name="color"></a>
## Color

Available colors:

```php
<x-moonshine::spinner color="primary" />
<x-moonshine::spinner color="secondary" />
<x-moonshine::spinner color="success" />
<x-moonshine::spinner color="warning" />
<x-moonshine::spinner color="error" />
<x-moonshine::spinner color="info" />
```
