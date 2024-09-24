https://moonshine-laravel.com/docs/resource/components/components-metric_value?change-moonshine-locale=en

------
# Metric Value

  - [Make](#make)
  - [Progress](#progress)
  - [Value Format](#value-format)
  - [Icon](#icon)
  - [Block width](#column-span)

<a name="make"></a>
### Make
The `ValueMetric` metric is designed to display a value. For example, how many records are in the table.

You can create a `ValueMetric` using the static `make()` method.

```php
make(Closure|string $label)
```

The `value()` method allows you to specify a value for a metric.

```php
value(int|string|float|Closure $value)
```

```php
use MoonShine\Metrics\ValueMetric;

//...

public function components(): array
{
    return [
        ValueMetric::make('Completed orders')
            ->value(Order::completed()->count())
    ];
}

//...
```

![value_metric](https://moonshine-laravel.com/screenshots/value_metric.png)
![value_metric_dark](https://moonshine-laravel.com/screenshots/value_metric_dark.png)

<a name="progress"></a>
### Progress


The `progress()` method allows you to display a progress indicator for achieving a goal in a metric.

```php
progress(int|float|Closure $target)
```

```php
use MoonShine\Metrics\ValueMetric;

//...

public function components(): array
{
    return [
        ValueMetric::make('Open tasks')
            ->value(Task::opened()->count())
            ->progress(Task::count())
    ];
}

//...
```


> [!NOTE]
> When using a progress bar, the `value()` method must be passed a numeric value or a closure that will return a number.

![value_metric_progress](https://moonshine-laravel.com/screenshots/value_metric_progress.png)
![value_metric_progress_dark](https://moonshine-laravel.com/screenshots/value_metric_progress_dark.png)

<a name="value-format"></a>
### Value Format

The `valueFormat()` method allows you to format the metric value and add a prefix and suffix.

```php
valueFormat(string|Closure $value)
```

```php
use MoonShine\Metrics\ValueMetric;

//...

public function components(): array
{
    return [
        ValueMetric::make('Profit')
            ->value(Order::completed()->sum('price'))
            ->valueFormat(fn($value) => \Illuminate\Support\Number::forHumans($value))
    ];
}

//...
```

![value_metric_format](https://moonshine-laravel.com/screenshots/value_metric_format.png)
![value_metric_format_dark](https://moonshine-laravel.com/screenshots/value_metric_format_dark.png)

<a name="icon"></a>
### Icon

The `icon()` method allows you to add an icon to the metric.

```php
use MoonShine\Metrics\ValueMetric;

//...

public function components(): array
{
    return [
        ValueMetric::make('Orders')
            ->value(Order::count())
            ->icon('heroicons.shopping-bag')
    ];
}

//...
```

> [!NOTE]
> For more detailed information, please refer to the section [Icons](https://moonshine-laravel.com/docs/resource/appearance/icons).

![value_metric_icon](https://moonshine-laravel.com/screenshots/value_metric_icon.png)
![value_metric_icon_dark](https://moonshine-laravel.com/screenshots/value_metric_icon_dark.png)

<a name="column-span"></a>
### Block width

Method `columnSpan()` allows you to set the block width in the *Grid* grid.

```php
columnSpan(
    int $columnSpan,
    int $adaptiveColumnSpan = 12
)
```

- `$columnSpan` - relevant for desktop
- `$adaptiveColumnSpan` - relevant for mobile version.

```php
use App\Models\Article;
use MoonShine\Decorations\Grid;
use MoonShine\Metrics\ValueMetric;

//...

public function components(): array
{
    return [
        Grid::make([
            ValueMetric::make('Articles')
                ->value(Article::count())
                ->columnSpan(6),
            ValueMetric::make('Comments')
                ->value(Comment::count())
                ->columnSpan(6)
        ])
    ];
}

//...
```

> [!NOTE]
> See the [Decoration Layout](https://moonshine-laravel.com/docs/resource/components/components-decoration_layout) section for more details.

![value_metric_column_span](https://moonshine-laravel.com/screenshots/value_metric_column_span.png)
![value_metric_column_span_dark](https://moonshine-laravel.com/screenshots/value_metric_column_span_dark.png)
