# Metric Line Chart  

- [Make](#make)  
- [Sorting keys](#sorting-keys)  
- [Block width](#column-span)  

---

<a name="make"></a>  
## Make  

The *LineChartMetric* metric is designed to display line charts.

You can create a *LineChartMetric* using the static `make()` method.

```php
make(Closure|string $label)
```

The `line()` method allows you to add a value line to the metric.  
You can add multiple lines to *ValueMetric*.

```php
line(
    array|Closure $line,
    string|array|Closure $color = '#7843E9'
)
```

- `$line` - values for charting,  
- `$color` - line color.  

```php
use MoonShine\Metrics\LineChartMetric;

//...

public function components(): array
{
    return [
        LineChartMetric::make('Orders')
            ->line([
                'Profit' => Order::query()
                    ->selectRaw('SUM(price) as sum, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
                    ->groupBy('date')
                    ->pluck('sum','date')
                    ->toArray()
            ])
            ->line([
                'Avg' => Order::query()
                    ->selectRaw('AVG(price) as avg, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
                    ->groupBy('date')
                    ->pluck('avg','date')
                    ->toArray()
            ], '#EC4176')
    ];
}

//...
```

You can define multiple lines through one `line` method.

```php
use MoonShine\Metrics\LineChartMetric;

//...

public function components(): array
{
    return [
        LineChartMetric::make('Orders')
            ->line([
                'Profit' => Order::query()
                    ->selectRaw('SUM(price) as sum, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
                    ->groupBy('date')
                    ->pluck('sum','date')
                    ->toArray(),
                'Avg' => Order::query()
                    ->selectRaw('AVG(price) as avg, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
                    ->groupBy('date')
                    ->pluck('avg','date')
                    ->toArray()
            ],[
                'red', 'blue'
            ])
    ];
}

//...
```

<a name="keys-sort"></a>  
## Sorting keys  

By default, the *LineChart* chart has its keys sorted in ascending order.  
This feature can be disabled using the `withoutSortKeys()` method.

```php
LineChartMetric::make('Orders')
    ->line([
        'Profit' => Order::query()
            ->selectRaw('SUM(price) as sum, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
            ->groupBy('date')
            ->pluck('sum','date')
            ->toArray()
    ])
    ->withoutSortKeys(),
```

<a name="column-span"></a>  
## Block width  

Method `columnSpan()` allows you to set the block width in the `Grid` grid.

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
use MoonShine\Metrics\LineChartMetric;

//...

public function components(): array
{
    return [
        Grid::make([
            LineChartMetric::make('Articles')
                ->line([
                    'Count' => [
                        now()->subDays()->format('Y-m-d') =>
                            Article::whereDate(
                                'created_at',
                                now()->subDays()->format('Y-m-d')
                            )->count(),
                        now()->format('Y-m-d') =>
                            Article::whereDate(
                                'created_at',
                                now()->subDays()->format('Y-m-d')
                            )->count()
                    ]
                ])
                ->columnSpan(6),
            LineChartMetric::make('Comments')
                ->line([
                    'Count' => [
                        now()->subDays()->format('Y-m-d') =>
                            Comment::whereDate(
                                'created_at',
                                now()->subDays()->format('Y-m-d')
                            )->count(),
                        now()->format('Y-m-d') =>
                            Comment::whereDate(
                                'created_at',
                                now()->subDays()->format('Y-m-d')
                            )->count()
                    ]
                ])
                ->columnSpan(6)
        ])
    ];
}

//...
```

> [!NOTE]
> See the [Decoration Layout](https://moonshine-laravel.com/docs/resource/components/components-decoration_layout) section for more details.

![line_chart_metric_column_span](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/line_chart_metric_column_span.png)
![line_chart_metric_column_span_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/line_chart_metric_column_span_dark.png)
