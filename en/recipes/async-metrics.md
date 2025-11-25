# Asynchronous Metrics

Metrics with form parameters

```php
protected function components(): iterable
{
    $startDate = request()->date('_data.start_date');
    $endDate = request()->date('_data.end_date');

    return [
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
                        ->selectRaw('AVG(price) as avg, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
                        ->whereBetween('created_at', [$startDate, $endDate])
                        ->groupBy('date')
                        ->pluck('avg', 'date')
                        ->toArray(),
                ], '#EC4176'),
        ])->name('metrics'),
    ];
}
```
