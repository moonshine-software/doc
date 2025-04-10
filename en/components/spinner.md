# Spinner

- [Basics](#basics)
- [Size](#size)
- [Color](#color)
- [Positioning](#position)

---

<a name="basics"></a>
## Basics

The `Spinner` component allows you to create a loading indicator.

```php
make(
    string $size = 'sm',
    string|Color $color = '',
    bool $fixed = false,
    bool $absolute = false,
)
```

- `$size` - size,
- `$color` - color,
- `$fixed` - fixed position,
- `$absolute` - absolute position.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Spinner;

Spinner::make()
```
tab: Blade
```blade
<x-moonshine::spinner size="md" />
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

- primary
- secondary
- success
- warning
- error
- info

```php
<x-moonshine::spinner color="primary" />
<x-moonshine::spinner color="secondary" />
<x-moonshine::spinner color="success" />
<x-moonshine::spinner color="warning" />
<x-moonshine::spinner color="error" />
<x-moonshine::spinner color="info" />
```

<a name="position"></a>
## Positioning

The parameter `absolute="true"` sets the absolute positioning of the loading indicator.

```php
<x-moonshine::spinner :absolute="true" />
```

The parameter `fixed="true"` sets the fixed positioning of the loading indicator.

```php
<x-moonshine::spinner :fixed="true" />
```
