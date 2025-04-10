# ProgressBar

- [Основы](#basics)
- [Размер](#size)
- [Цвет](#color)

---

<a name="basics"></a>
## Основы

Компонент `ProgressBar` позволяет создать индикатор прогресса.

```php
make(
    float|int $value,
    string $size = 'sm',
    string|Color $color = '',
    bool $radial = false,
)
```

 - `$value` - значение индикатора,
 - `$size` - размер,
 - `$color` - цвет,
 - `$radial` - радиальный индикатор прогресса.

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
## Размер

Доступные размеры:

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
## Цвет

Доступные цвета:

```php
<x-moonshine::spinner color="primary" />
<x-moonshine::spinner color="secondary" />
<x-moonshine::spinner color="success" />
<x-moonshine::spinner color="warning" />
<x-moonshine::spinner color="error" />
<x-moonshine::spinner color="info" />
```
