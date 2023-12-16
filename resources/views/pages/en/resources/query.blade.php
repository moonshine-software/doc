<x-page title="Query" :sectionMenu="[
    'Sections' => [
        ['url' => '#query', 'label' => 'Request'],
        ['url' => '#item-query', 'label' => 'Receiving a record'],
        ['url' => '#search', 'label' => 'Search'],
        ['url' => '#order', 'label' => 'Sorting'],
    ]
]">


<x-sub-title id="filter">Request</x-sub-title>

<x-p>
    It is often necessary to initially change the resource's queries all to the database.<br />
    You can easily override <em>query builder</em> in a resource.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function query(): Builder // [tl! focus:start]
    {
        return parent::query()
            ->where('active', true);
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="item-query">Receiving a record</x-sub-title>

<x-p>
    The <code>resolveItemQuery()</code> method is used,
    if you need to change the query to get a record from the database.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function resolveItemQuery(): Builder // [tl! focus:start]
    {
        return parent::resolveItemQuery()
            ->withTrashed();
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="search">Search</x-sub-title>

<x-p>
    The <code>searchQuery()</code> method allows you to change the query when searching for records.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function searchQuery(): Builder // [tl! focus:start]
    {
        return parent::searchQuery()
            ->withTrashed();
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="order">Sorting</x-sub-title>

<x-p>
    By overriding the <code>resolveOrder()</code> method, you can customize the records sorting.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    protected function resolveOrder(): static // [tl! focus:start]
    {
        if (($sort = request('sort')) && is_string($sort)) {
            $column = ltrim($sort, '-');
            $direction = str_starts_with($sort, '-') ? 'desc' : 'asc';

            if ($column === 'author') {
                $this->query()
                    ->select('posts.*')
                    ->leftJoin('users', 'users.id', '=', 'posts.author_id')
                    ->orderBy('users.name', $direction);

                return $this;
            }
        }

        return parent::resolveOrder();
    } // [tl! focus:end]

    //...
}
</x-code>

</x-page>
