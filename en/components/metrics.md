# Metrics

- [Value](#value)
- [Line/Donut](#line-donut)

---

<a name="value"></a>
## Value

The `ValueMetric` is designed to display a value. For example, how many records are in a table.

```php
make(Closure|string $label)
```

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;

ValueMetric::make('Completed orders')
    ->value(fn() => Order::completed()->count())
```
tab: Blade
```blade
<x-moonshine::metrics.value
    title="Completed orders"
    icon="shopping-bag"
    :value="$count"
    :progress="false"
/>
```
~~~

The `value()` method allows you to specify the value for the metric.

```php
value(int|string|float|Closure $value)
```

```php
use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;

// ...

protected function components(): iterable
{
    return [
        ValueMetric::make('Completed orders')
            ->value(fn(): int => Order::completed()->count())
    ];
}
```

<a name="progress"></a>
### Progress

The `progress()` method allows you to display a progress indicator for goal achievement in the metric.

```php
progress(int|float|Closure $target)
```

```php
ValueMetric::make('Open tasks')
    ->value(fn(): int => Task::opened()->count())
    ->progress(fn(): int => Task::count())
```

> [!NOTE]
> When using the progress bar, the `value()` method must receive a numeric value or a closure that returns a number.

<a name="value-format"></a>
### Value Format

The `valueFormat()` method allows you to format the metric value and add a prefix and suffix.

```php
valueFormat(string|Closure $value)
```

```php
ValueMetric::make('Profit')
    ->value(fn(): int => Order::completed()->sum('price'))
    ->valueFormat(fn(int $value): string => \Illuminate\Support\Number::forHumans($value))
```

<a name="icon"></a>
### Icon

The `icon()` method allows you to add an icon to the metric.

```php
ValueMetric::make('Orders')
    ->value(fn(): int => Order::count())
    ->icon('shopping-bag')
```

> [!NOTE]
> For more detailed information, refer to the [Icons](/docs/{{version}}/appearance/icons) section.

<a name="column-span"></a>
### Column width

The `columnSpan()` method allows you to set the width of the block in the *Grid* layout.

```php
columnSpan(
    int $columnSpan,
    int $adaptiveColumnSpan = 12
)
```

- `$columnSpan` - relevant for the desktop version,
- `$adaptiveColumnSpan` - relevant for the mobile version.

<a name="line-donut"></a>
## Line/Donut

The package is installed separately and is based on the [ApexCharts library](https://apexcharts.com/).

```shell
composer require moonshine/apexcharts
```

For more details, refer to the official [ApexCharts repository](https://github.com/moonshine-software/apexcharts).
