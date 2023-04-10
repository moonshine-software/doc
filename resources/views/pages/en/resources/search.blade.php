<x-page title="Search" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Everything is simple here! For a full-text search, you need to specify which fields will participate in the search.
    To do this, you need to list them in the returned array in the search method
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
    If fulltext searching is required, you must use the <code>MoonShine\Attributes\SearchUsingFullText</code>
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

</x-page>
