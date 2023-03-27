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
                        ->groupBy('created_at')
                        ->selectRaw('SUM(price) as sum, created_at')
                        ->pluck('sum','created_at')
                        ->mapWithKeys(fn($value, $key) => [date('d.m.Y', strtotime($key)) => $value])
                        ->toArray()
                ]),
        ];
    } // [tl! focus:end]

    //...
    }
</x-code>

<x-image src="{{ asset('screenshots/metrics_line_chart.png') }}"></x-image>
</x-page>
