<x-page
    title="Metrics DonutChart"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#column-span', 'label' => 'Block width'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>DonutChartMetric</em> metric is designed for creating Donut charts.
</x-p>

<x-p>
    You can create <em>DonutChartMetric</em> using the static <code>make()</code> method.
</x-p>

<x-code language="php">
make(Closure|string $label)
</x-code>

<x-p>
    Method <code>values()</code> allows you to specify the relevance for a metric.
</x-p>

<x-code language="php">
values(array|Closure $values)
</x-code>

<x-code language="php">
use MoonShine\Metrics\DonutChartMetric; // [tl! focus]

//...

public function components(): array
{
    return [
        DonutChartMetric::make('Subscribers') // [tl! focus]
            ->values(['CutCode' => 10000, 'Apple' => 9999]) // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/donut_chart_metric.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/donut_chart_metric_dark.png') }}"></x-image>

<x-sub-title id="column-span">Block width</x-sub-title>

@include('pages.en.components.shared.metric_column_span', ['metric' => 'DonutChartMetric'])

</x-page>
