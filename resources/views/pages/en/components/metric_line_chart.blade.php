<x-page
    title="Metrics LineChart"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#keys-sort', 'label' => 'Sorting keys'],
            ['url' => '#column-span', 'label' => 'Block width'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>LineChartMetric</em> metric is designed to display line charts.
</x-p>

<x-p>
    You can create a <em>LineChartMetric</em> using the static <code>make()</code> method.
</x-p>

<x-code language="php">
make(Closure|string $label)
</x-code>

<x-p>
    The <code>line()</code> method allows you to add a value line to the metric.
    You can add multiple lines to <em>ValueMetric</em>.
</x-p>

<x-code language="php">
line(
    array|Closure $line,
    string|array|Closure $color = '#7843E9'
)
</x-code>

<x-p>
    <code>$line</code> - values for charting,<br>
    <code>$color</code> - line color.
</x-p>

<x-code language="php">
use MoonShine\Metrics\LineChartMetric; // [tl! focus]

//...

public function components(): array
{
    return [
        LineChartMetric::make('Orders') // [tl! focus:start]
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
            ], '#EC4176') // [tl! focus:end]
    ];
}

//...
</x-code>

<x-p>
    You can define multiple lines through one <code>line</code> method.
</x-p>

<x-code language="php">
use MoonShine\Metrics\LineChartMetric; // [tl! focus]

//...

public function components(): array
{
    return [
        LineChartMetric::make('Orders') // [tl! focus:start]
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
            ]) // [tl! focus:end]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/line_chart_metrics.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/line_chart_metric_dark.png') }}"></x-image>

<x-sub-title id="keys-sort">Sorting keys</x-sub-title>

<x-p>
    By default, the <em>LineChart</em> chart has its keys sorted in ascending order.
     This feature can be disabled using the <code>withoutSortKeys()</code> method.
</x-p>

<x-code language="php">
LineChartMetric::make('Orders')
    ->line([
        'Profit' => Order::query()
            ->selectRaw('SUM(price) as sum, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
            ->groupBy('date')
            ->pluck('sum','date')
            ->toArray()
    ])
    ->withoutSortKeys(), // [tl! focus]
</x-code>

<x-sub-title id="column-span">Block width</x-sub-title>

@include('pages.en.components.shared.metric_column_span', ['metric' => 'LineChartMetric'])

</x-page>
