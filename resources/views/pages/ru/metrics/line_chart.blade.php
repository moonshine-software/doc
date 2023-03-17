<x-page title="LineChart">

<x-p>
   Линейный график
</x-p>

<x-code language="php">
    namespace Leeto\MoonShine\Resources;


    use Leeto\MoonShine\Metrics\LineChartMetric;

    class PostResource extends Resource
    {
    //...

    public function metrics(): array // [tl! focus:start]
    {
        return [
            LineChartMetric::make('Заказы')
                ->line([
                    'Выручка' => Order::query()
                        ->selectRaw('SUM(price) as sum, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
                        ->groupBy('date')
                        ->get()
                        ->pluck('sum', 'date')
                        ->toArray()
                ]),
        ];
    } // [tl! focus:end]

    //...
    }
</x-code>

<x-image src="{{ asset('screenshots/metrics_line_chart.png') }}"></x-image>
</x-page>
