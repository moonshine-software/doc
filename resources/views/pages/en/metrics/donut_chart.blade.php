<x-page title="DonutChart">

<x-p>
   Donut Timeline
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Metrics\DonutChartMetric;

class PostResource extends Resource
{
//...

public function metrics(): array // [tl! focus:start]
{
    return [
        DonutChartMetric::make('Subscribers')
            ->values(['CutCode' => 10000, 'Apple' => 9999]),
    ];
} // [tl! focus:end]

//...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/metrics_donut_chart.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/metrics_donut_chart_dark.png') }}"></x-image>

</x-page>
