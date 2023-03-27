<x-page title="Метрики" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Как и в <x-link link="{{ route('moonshine.custom_page', 'dashboard-index') }}">панели управления</x-link> в каждом ресурсе можно
    отобразить <x-link link="{{ route('moonshine.custom_page', 'metrics-index') }}">метрики</x-link>
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;


use Leeto\MoonShine\Metrics\ValueMetric;

class PostResource extends Resource
{
    //...

    public function metrics(): array // [tl! focus:start]
    {
        return [
            ValueMetric::make('Завершенных заказов')
                ->value(Orders::completed()->count())
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

</x-page>
