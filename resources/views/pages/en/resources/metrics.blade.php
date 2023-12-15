<x-page title="Metrics" :sectionMenu="$sectionMenu ?? null">

<x-p>
    On the resource model index page, you can display information blocks with statistics - metrics.<br />
    To do this, in the <code>metrics()</code> method, return an array from <code>ValueMetric</code>.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Metrics\ValueMetric; // [tl! focus]
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function metrics(): array // [tl! focus:start]
    {
        return [
            ValueMetric::make('Articles')
                ->value(Post::count()),
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/metrics.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/metrics_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more detailed information, please refer to the sections
    <x-link link="{{ route('moonshine.page', 'components-metric_donut_chart') }}">Donut Chart</x-link>,
    <x-link link="{{ route('moonshine.page', 'components-metric_line_chart') }}">Line Chart</x-link> and
    <x-link link="{{ route('moonshine.page', 'components-metric_value') }}">Value</x-link>.
</x-moonshine::alert>

</x-page>
