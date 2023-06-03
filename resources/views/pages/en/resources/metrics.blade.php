<x-page title="Metrics" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Same as the <x-link link="{{ route('moonshine.custom_page', 'advanced-dashboard') }}">control panel</x-link> you can
    display <x-link link="{{ route('moonshine.custom_page', 'metrics-index') }}">metrics</x-link> in every resource
</x-p>

<x-code language="php">
namespace MoonShine\Resources;


use MoonShine\Metrics\ValueMetric;

class PostResource extends Resource
{
    //...

    public function metrics(): array // [tl! focus:start]
    {
        return [
            ValueMetric::make('Completed orders')
                ->value(Orders::completed()->count())
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/metrics.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/metrics_dark.png') }}"></x-image>

</x-page>
