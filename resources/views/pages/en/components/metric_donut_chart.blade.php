<x-page
    title="Metrics DonutChart"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#colors', 'label' => 'Colors'],
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

<x-moonshine::grid>
{!!
    \MoonShine\Metrics\DonutChartMetric::make('Subscribers')
        ->values(['CutCode' => 10000, 'Apple' => 9999])
        ->columnSpan(4)
!!}
</x-moonshine::grid>

<x-sub-title id="colors">Colors</x-sub-title>

<x-p>
    The <code>colors()</code> method allows you to specify colors for the metric.
</x-p>

<x-code language="php">
colors(array|Closure $values)
</x-code>

<x-code language="php">
use MoonShine\Metrics\DonutChartMetric;

//...

public function components(): array
{
    return [
        DonutChartMetric::make('Subscribers')
            ->values(['CutCode' => 10000, 'Apple' => 9999])
            ->colors(['#ffcc00', '#00bb00']) // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::grid>
{!!
    \MoonShine\Metrics\DonutChartMetric::make('Subscribers')
        ->values(['CutCode' => 10000, 'Apple' => 9999])
        ->colors(['#ffcc00', '#00bb00'])
        ->columnSpan(4)
!!}
</x-moonshine::grid>

<x-sub-title id="column-span">Block width</x-sub-title>

@include('pages.en.components.shared.metric_column_span', ['metric' => 'DonutChartMetric'])

</x-page>
