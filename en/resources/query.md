https://moonshine-laravel.com/docs/resource/models-resources/resources-query?change-moonshine-locale=en

------
# Query

- [Request](#request)
- [Receiving a record](#receiving-a-record)
- [Search](#search)
- [Sorting](#sorting)

<a name="request"></a>
### Request

It is often necessary to initially change the resource's queries all to the database.
You can easily override *query builder* in a resource.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function query(): Builder
    {
        return parent::query()
            ->where('active', true);
    }

    //...
}
```

<a name="receiving-a-record"></a>
### Receiving a record

The `resolveItemQuery()` method is used, if you need to change the query to get a record from the database.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function resolveItemQuery(): Builder
    {
        return parent::resolveItemQuery()
            ->withTrashed();
    }

    //...
}
```

<a name="search"></a>
### Search

The `searchQuery()` method allows you to change the query when searching for records.


```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function searchQuery(): Builder
    {
        return parent::searchQuery()
            ->withTrashed();
    }

    //...
}
```

<a name="sorting"></a>
### Sorting

By overriding the `resolveOrder()` method, you can customize the records sorting.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    protected function resolveOrder(): static
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
    }

    //...
}
```
