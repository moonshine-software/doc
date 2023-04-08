<x-page title="Quick Filters/Tags" :sectionMenu="[]">

<x-p>
    Sometimes there is a need to create a set of filters, let's say a selection of results and display it on the listing. For such situations there are created tags
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;
use Leeto\MoonShine\QueryTags\QueryTag; // [tl! focus]

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
                fn() => Post::query()->whereNotNull('author_id') // Query builder
            ),

            QueryTag::make(
                'Post without an author',
                fn() => Post::query()->whereNull('author_id')
            )->icon('users')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/query_tags.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/query_tags_dark.png') }}"></x-image>

</x-page>
