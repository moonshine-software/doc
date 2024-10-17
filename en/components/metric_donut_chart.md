# Metric Donut Chart

  - [Make](#make)
  - [Colors](#colors)
  - [Decimal places](#decimals)
  - [Block width](#column-span)

---

<a name="make"></a>
## Make

The *DonutChartMetric* metric is designed for creating Donut charts.

You can create *DonutChartMetric* using the static `make()` method.

```php
make(Closure|string $label)
```

Method `values()` allows you to specify the relevance for a metric.

```php
values(array|Closure $values)
```

```php
use MoonShine\Metrics\DonutChartMetric;

//...

public function components(): array
{
    return [
        DonutChartMetric::make('Subscribers')
            ->values(['CutCode' => 10000, 'Apple' => 9999])
    ];
}

//...
```

<a name="colors"></a> 
## Colors

The `colors()` method allows you to specify colors for the metric.

```php
colors(array|Closure $values)
```

```php
use MoonShine\Metrics\DonutChartMetric;

//...

public function components(): array
{
    return [
        DonutChartMetric::make('Subscribers')
            ->values(['CutCode' => 10000, 'Apple' => 9999])
            ->colors(['#ffcc00', '#00bb00'])
    ];
}

//...
```

<a name="decimals"></a> 
## Decimal places

The `decimals()` method allows you to specify the maximum number of decimal places for the total value.

> [!NOTE]  
> By default, up to three decimal places are displayed.


```php
use MoonShine\Metrics\DonutChartMetric;

//...

public function components(): array
{
    return [
        DonutChartMetric::make('Subscribers')
            ->values(['CutCode' => 10000.12, 'Apple' => 9999.32])
            ->decimals(0)
    ];
}

//...
```

<a name="column-span"></a> 
## Block width

Method `columnSpan()` allows you to set the block width in the *Grid* grid.

```php
columnSpan(
    int $columnSpan,
    int $adaptiveColumnSpan = 12
)
```

- `$columnSpan` - relevant for desktop,
- `$adaptiveColumnSpan` - relevant for mobile version.

```php
use App\Models\Article;
use MoonShine\Decorations\Grid;
use MoonShine\Metrics\DonutChartMetric;

//...

public function components(): array
{
    return [
        Grid::make([
            DonutChartMetric::make('Subscribers')
                ->values(['CutCode' => 10000, 'Apple' => 9999])
                ->columnSpan(6),
            DonutChartMetric::make('Tasks')
                ->values(['New' => 234, 'Done' => 421])
                ->columnSpan(6)
        ])
    ];
}

//...
```

> [!NOTE]  
> See the [Decoration Layout](https://moonshine-laravel.com/docs/resource/components/components-decoration_layout) section for more details.

![donut_chart_metric_column_span](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/donut_chart_metric_column_span.png)
![donut_chart_metric_column_span_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/donut_chart_metric_column_span_dark.png)
