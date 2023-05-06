<x-page title="Метрики" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Как и в <x-link link="{{ route('moonshine.custom_page', 'advanced-dashboard') }}">панели управления</x-link> в каждом ресурсе можно
    отобразить <x-link link="{{ route('moonshine.custom_page', 'metrics-index') }}">метрики</x-link>
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
