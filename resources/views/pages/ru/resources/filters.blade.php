<x-page title="Фильтры" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Фильтры не многим отличаются от полей и наследуют их свойства и методы!
    Отображаются на главной странице раздела для фильтрации списка данных.
</x-p>

<x-p>
    Добавлять новые фильтры просто! Достаточно в методе <code>filters</code>, который возвращает массив,
    вернуть все необходимые фильтры, а как устроенны фильтры мы рассмотрим в разделе <x-link link="{{ route('moonshine.custom_page', 'filters-index') }}">"Фильтры"</x-link>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если метод отсутствует, либо возвращает пустой массив, то фильтры не будут отображаться
</x-moonshine::alert>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Models\MoonshineUser;
use MoonShine\Filters\TextFilter; // [tl! focus]

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Статьи';
    //...

    // [tl! focus:start]
    public function filters(): array
    {
        return [
            TextFilter::make('Заголовок', 'title')
        ];
    }

    // Не забудьте подключить фильтры к ресурсу
    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }

    // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filters.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filters_dark.png') }}"></x-image>

</x-page>
