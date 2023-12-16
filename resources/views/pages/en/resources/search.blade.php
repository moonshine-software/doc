<x-page title="Search" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#fulltext', 'label' => 'Full text search'],
        ['url' => '#json', 'label' => 'Search by json keys'],
        ['url' => '#relation', 'label' => 'Search by relationship'],
        ['url' => '#global', 'label' => 'Global search'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    To search, you must specify which model fields will participate in the search.
    To do this, you need to list them in the returned array in the <code>search()</code> method.
</x-p>

<x-moonshine::alert type="info" icon="heroicons.information-circle">
    If the method returns an empty array, then the search string will not be displayed.
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

<x-image theme="light" src="{{ asset('screenshots/search.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/search_dark.png') }}"></x-image>

<x-sub-title id="fulltext">Full text search</x-sub-title>

<x-p>
    If a fulltext search is required, then you must use the <code>MoonShine\Attributes\SearchUsingFullText</code> attribute.
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
        return ['id'];
    }

    //...
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Don't forget to add fulltext index
</x-moonshine::alert>

<x-sub-title id="json">Search by json keys</x-sub-title>

<x-p>
    For <em>Json</em> fields that are used as a key-value <code>keyValue()</code>,
    you can specify which field key is involved in the search.
</x-p>

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

    public function search(): array
    {
        return ['data->title']; // [tl! focus]
    }

    //...
}
</x-code>

<x-p>
    For multidimensional <em>Json</em>, which are formed through fields <code>fields()</code>,
    The search key must be specified as follows:
</x-p>

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

    public function search(): array
    {
        return ['data->[*]->title']; // [tl! focus]
    }

    //...
}
</x-code>

<x-sub-title id="relation">Search by relationship</x-sub-title>

<x-p>
    You can search by relationships; to do this, you need to specify which the relationship field to search.
</x-p>

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

    public function search(): array
    {
        return ['category.title']; // [tl! focus]
    }

    //...
}
</x-code>

<x-sub-title id="global">Global search</x-sub-title>

<x-p>
    To organize a global search, you can use the package
    <x-link link="https://github.com/lee-to/moonshine-algolia-search" target="_blank">Algolias search for MoonShine</x-link>.
</x-p>

<x-p>
    This package uses the <code>Algolia</code> search engine, which takes into account the context, and request type,
    possible typos, synonyms and word forms, entering queries in different languages and much more.
</x-p>

</x-page>
