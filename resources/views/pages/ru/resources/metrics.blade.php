<x-page title="Метрики" :sectionMenu="$sectionMenu ?? null">

<x-p>
    На индексной странице модель ресурса можно отобразить информационные блоки со статистикой - метрики.<br />
    Для это в методе <code>metrics()</code> вернуть массив из <code>ValueMetric</code>.
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
    За более подробной информацией обратитесь к разделу <x-link link="{{ route('moonshine.custom_page', 'metrics-index') }}">Метрики</x-link>.
</x-moonshine::alert>

</x-page>
