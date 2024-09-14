https://moonshine-laravel.com/docs/resource/models-resources/resources-search?change-moonshine-locale=en

------

# Search

  - [Basics](#basics)
  - [Full text search](#fulltext)
  - [Search by json keys](#json)
  - [Search by relationship](#relation)
  - [Global search](#global)

<a name="basics"></a>
## Basics

To search, you must specify which model fields will participate in the search. To do this, you need to list them in the returned array in the `search()` method.

>[!TIP] 
>If the method returns an empty array, then the search string will not be displayed.

```php
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
        return ['id', 'title', 'text'];
    }

    //...
}
```

![MoonShine Search Dark](https://moonshine-laravel.com/screenshots/search_dark.png)

<a name="fulltext"></a>
## Full text search

If a fulltext search is required, then you must use the `MoonShine\Attributes\SearchUsingFullText` attribute.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Attributes\SearchUsingFullText;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    #[SearchUsingFullText(['title', 'text'])]
    public function search(): array
    {
        return ['id'];
    }

    //...
}
```

>[!TIP] 
>Don't forget to add fulltext index

<a name="json"></a>
## Search by json keys

For Json fields that are used as a key-value `keyValue()`, you can specify which field key is involved in the search.

```php
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
        return ['data->title'];
    }

    //...
}
```

For multidimensional Json, which are formed through fields `fields()`, The search key must be specified as follows:

```php
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
        return ['data->[*]->title'];
    }

    //...
}
```

<a name="relation"></a>
## Search by relationship

You can search by relationships; to do this, you need to specify which the relationship field to search.

```php
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
        return ['category.title'];
    }

    //...
}
```

<a name="global"></a>
## Global search

In the MoonShine admin panel, global search can be implemented based on integration
[Laravel Scout](https://laravel.com/docs/scout).

To implement a global search you must:

1. Specify the list of models to search in the configuration file `config/moonshine.php`.

```php
'global_search' => [
    Article::class,
    User::class
],
```

2 Implement the interface in models.

```php
use MoonShine\Scout\HasGlobalSearch;
use MoonShine\Scout\SearchableResponse;
use Laravel\Scout\Searchable;
use Laravel\Scout\Builder;

class Article extends Model implements HasGlobalSearch
{
    use Searchable;

    public function searchableQuery(Builder $builder): Builder
    {
        return $builder->take(4);
    }

    public function toSearchableResponse(): SearchableResponse
    {
        return new SearchableResponse(
            group: 'Articles',
            title: $this->title,
            url: '/',
            preview: $this->text,
            image: $this->thumbnail
        );
    }
}
```

