<x-page title="Quick filters (tags)" :sectionMenu="[]">

<x-p>
    Sometimes you may need to create a set of filters (collection of results)
    and display it in the listing. Tags have been created for these cases.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Models\MoonshineUser;
use MoonShine\QueryTags\QueryTag; // [tl! focus]
use Illuminate\Contracts\Database\Eloquent\Builder;

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Articles';
    //...

    public function queryTags(): array // [tl! focus:start]
    {
        return [
            QueryTag::make(
                'Post with author', // Tag Title
                fn(Builder $query) => $query->whereNotNull('author_id') // Query builder
            ),

            QueryTag::make(
                'Post without an author',
                fn(Builder $query) => $query->whereNull('author_id')
            )->icon('users')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/query_tags.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/query_tags_dark.png') }}"></x-image>

</x-page>
