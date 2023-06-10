<x-page title="Search" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#global', 'label' => 'Global search'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Everything is simple here! For a full-text search, you need to specify which fields will be included into the search.
    To do this, you need to list them in the return array in the <code>search()</code> method
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    If the method is missing or returns an empty array, the search string will not be displayed
</x-moonshine::alert>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Models\MoonshineUser;

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
    If a fulltext search is required, you must use the <code>MoonShine\Attributes\SearchUsingFullText</code>
</x-p>

<x-code language="php">
    namespace MoonShine\Resources;

    use MoonShine\Attributes\SearchUsingFullText; // [tl! focus]

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
    Don't forget to add the fulltext index
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/search.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/search_dark.png') }}"></x-image>

<x-sub-title id="global">Global search</x-sub-title>

<x-p>
    To organize a global search, you can use the package
    <x-link link="https://github.com/lee-to/moonshine-algolia-search" target="_blank">Algolias search for MoonShine</x-link>
</x-p>

<x-p>
    This package uses the <code>Algolia</code> search engine, which takes context and query type into account,
    possible typos, synonyms and word forms, entering a query in different languages and much more.
</x-p>

</x-page>
