<x-page title="Поиск" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Здесь все просто! Для полнотекстового поиска необходимо указать какие поля будут участвовать в поиске.
    Для этого необходимо их перечислить в возвращаемом массиве в методе search
</x-p>

<x-alert>
    Если метод отсутствует, либо возвращает пустой массив то поисковая строка не будет отображаться
</x-alert>

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

<x-image src="{{ asset('screenshots/search.png') }}"></x-image>

<x-next href="{{ route('section', 'resources-scopes') }}">Scopes</x-next>

</x-page>