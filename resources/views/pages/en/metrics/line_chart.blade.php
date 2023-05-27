<x-page title="LineChart">

<x-p>
    Provides the ability to create a line chart for metric
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
    or using one <code>line</code> method
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

</x-page>
