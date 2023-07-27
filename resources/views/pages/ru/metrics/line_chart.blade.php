<x-page title="LineChart">

<x-p>
   Позволяет создавать линейный график для метрик
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Metrics\LineChartMetric;

class PostResource extends Resource
{
    //...

    public function metrics(): array // [tl! focus:start]
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
                ], '#EC4176'),
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-p>
    или используя один метод <code>line</code>
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Metrics\LineChartMetric;

class PostResource extends Resource
{
    //...

    public function metrics(): array // [tl! focus:start]
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
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/metrics_line_chart.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/metrics_line_chart_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    По умолчанию у графика LineChart ключи сортируются по возрастанию.
    Эту особенность можно отключить используя метод <code>withoutSortKeys()</code>.
</x-moonshine::alert>

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

</x-page>
