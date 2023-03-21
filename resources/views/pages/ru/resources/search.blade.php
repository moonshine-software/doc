<x-page title="Поиск" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Здесь все просто! Для полнотекстового поиска необходимо указать какие поля будут участвовать в поиске.
    Для этого необходимо их перечислить в возвращаемом массиве в методе search
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если метод отсутствует, либо возвращает пустой массив то поисковая строка не будет отображаться
</x-moonshine::alert>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;

class PostResource extends Resource
{
    //...

    public function search(): array // [tl! focus:start]
    {
        return ['id', 'title'];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-p>
    Если требуется fulltext поиск, то необходимо воспользоваться аттрибутом <code>Leeto\MoonShine\Attributes\SearchUsingFullText</code>
</x-p>

<x-code language="php">
    namespace Leeto\MoonShine\Resources;

    use Leeto\MoonShine\Attributes\SearchUsingFullText; // [tl! focus]

    class PostResource extends Resource
    {
    //...

    #[SearchUsingFullText(['title', 'text'])] // [tl! focus]
    public function search(): array
    {
        return ['id'];
    }

    //...
    }
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Не забудьте добавить fulltext индекс
</x-moonshine::alert>

<x-image src="{{ asset('screenshots/search.png') }}"></x-image>

</x-page>
