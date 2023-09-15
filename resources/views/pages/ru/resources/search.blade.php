<x-page title="Поиск" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#global', 'label' => 'Глобальный поиск'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Для поиска необходимо указать, какие поля модели будут участвовать в поиске.
    Для этого необходимо их перечислить в возвращаемом массиве в методе <code>search()</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если метод отсутствует, либо возвращает пустой массив, то поисковая строка не будет отображаться.
</x-moonshine::alert>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function search(): array // [tl! focus:start]
    {
        return ['id', 'title', 'text'];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-p>
    Если требуется fulltext поиск, то необходимо воспользоваться аттрибутом <code>MoonShine\Attributes\SearchUsingFullText</code>.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Attributes\SearchUsingFullText; // [tl! focus]
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    #[SearchUsingFullText(['title', 'text'])] // [tl! focus]
    public function search(): array
    {
        return ['id', 'title', 'text'];
    }

    //...
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Не забудьте добавить fulltext индекс
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/search.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/search_dark.png') }}"></x-image>

<x-sub-title id="global">Глобальный поиск</x-sub-title>

<x-p>
    Для организации глобального поиска можно воспользоваться пакетом
    <x-link link="https://github.com/lee-to/moonshine-algolia-search" target="_blank">Algolias search for MoonShine</x-link>.
</x-p>

<x-p>
    Данный пакет использует поисковый движок <code>Algolia</code>, который учитывает контекст и тип запроса,
    возможные опечатки, синонимы и словоформы, ввод запроса на разных языках и многое другое.
</x-p>

</x-page>
