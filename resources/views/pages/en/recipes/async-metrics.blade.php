<x-recipe id="async-metrics" title="{{ $title ?? 'Recipe' }}">

<x-p>
    Metrics with form parameters
</x-p>

<x-code language="php">
$startDate = request()->date('_form.start_date');
$endDate = request()->date('_form.end_date');

FormBuilder::make()
    ->dispatchEvent(AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'metrics'))
    ->fields([
        Flex::make([
            Date::make('Start date'),
            Date::make('End date'),
        ]),
    ]),

Fragment::make([
    FlexibleRender::make("$startDate - $endDate"),

    LineChartMetric::make('Orders')
        ->line([
            'Profit' => Order::query()
                ->selectRaw('SUM(price) as sum, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->pluck('sum', 'date')
                ->toArray(),
        ])
        ->line([
            'Avg' => Order::query()
                ->selectRaw('AVG(price) as average, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                -> pluck('avg', 'date')
                ->toArray(),
        ], '#EC4176'),
])->name('metrics'),
</x-code>
</x-recipe>
