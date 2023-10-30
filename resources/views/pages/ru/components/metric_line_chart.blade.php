<x-page
    title="Метрика LineChart"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#keys-sort', 'label' => 'Сортировка ключей'],
            ['url' => '#column-span', 'label' => 'Ширина блока'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Метрика <em>LineChartMetric</em> предназначена для отображения линейных графиков.
</x-p>

<x-p>
    Создать <em>LineChartMetric</em> можно воспользовавшись статическим методом <code>make()</code>.
</x-p>

<x-code language="php">
make(Closure|string $label)
</x-code>

<x-p>
    Метод <code>line()</code> позволяет добавить линию значений в метрику.
    В <em>ValueMetric</em> можно добавить несколько линий.
</x-p>

<x-code language="php">
line(
    array|Closure $line,
    string|array|Closure $color = '#7843E9'
)
</x-code>

<x-p>
    <code>$line</code> - значения для построения графика,<br>
    <code>$color</code> - цвет линии.
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
    Можно задать несколько линий через один метод <code>line</code>.
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

<x-sub-title id="keys-sort">Сортировка ключей</x-sub-title>

<x-p>
    По умолчанию у графика <em>LineChart</em> ключи сортируются по возрастанию.
    Эту особенность можно отключить, используя метод <code>withoutSortKeys()</code>.
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

<x-sub-title id="column-span">Ширина блока</x-sub-title>

@include('pages.ru.components.shared.metric_column_span', ['metric' => 'LineChartMetric'])

</x-page>
