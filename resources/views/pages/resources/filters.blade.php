<x-page title="Фильтры" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Фильтры не многим отличаются от полей и наследуют их свойства и методы!
    Отображаются на главной странице раздела для фильтрации списка данных.
</x-p>

<x-p>
    Добавлять новые фильтры просто! Досточно в методе <code>filters</code>, который возвращает массив,
    вернуть все необходимые фильтры, а как устроенны фильтры мы рассмотрим в разделе <x-link link="{{ route('section', 'filters-index') }}">"Фильтры"</x-link>.
</x-p>

<x-alert>
    Если метод отсутствует, либо возвращает пустой массив, то фильтры не будут отображаться
</x-alert>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;
use Leeto\MoonShine\Filters\TextFilter; // [tl! focus]

class PostResource extends BaseResource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Статьи';
    //...

    public function filters(): array // [tl! focus:start]
    {
        return [
            TextFilter::make('Заголовок', 'title')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image src="{{ asset('screenshots/filters.png') }}"></x-image>

<x-next href="{{ route('section', 'resources-actions') }}">Действия</x-next>

</x-page>