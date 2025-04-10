# Search

- [Basics](#basics)
- [Full-Text Search](#fulltext)
- [JSON Key Search](#json)
- [Relation Search](#relation)
- [Global Search](#global)

---

<a name="basics"></a>
## Basics

To perform a search, you need to specify which fields of the model will participate in the search.
For this, you need to list them in the returned array in the `search()` method.

> [!NOTE]
> If the method returns an empty array, the search string will not be displayed.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    protected function search(): array
    {
        return ['id', 'title', 'text'];
    }
}
```

![MoonShine Search](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/search.png#light)
![MoonShine Search](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/search_dark.png#dark)

<a name="fulltext"></a>
## Full-Text Search

If full-text search is required, you need to use the attribute `SearchUsingFullText`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Attributes\SearchUsingFullText;

class PostResource extends ModelResource
{
    // ...

    #[SearchUsingFullText(['title', 'text'])]
    protected function search(): array
    {
        return ['id'];
    }
}
```

> [!TIP]
> Don't forget to add a full-text index.

<a name="json"></a>
## JSON Key Search

For `Json` fields that are used as key-value `keyValue()`, you can specify which field key participates in the search.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    protected function search(): array
    {
        return ['data->title'];
    }
}
```

For multidimensional `Json`, which are formed through `fields()`, the search key should be specified as follows:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    protected function search(): array
    {
        return ['data->[*]->title'];
    }
}
```

<a name="relation"></a>
## Relation Search

You can perform a search on relations. For this, you need to specify which relation field to search by.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    protected function search(): array
    {
        return ['category.title'];
    }
}
```

<a name="global"></a>
## Global Search

In **MoonShine**, you can implement global search based on integration with [Laravel Scout](https://laravel.com/docs/scout).

To implement global search, you need to:

1. Install the `moonshine/scout` package.

```shell
composer require moonshine/scout
```

```shell
php artisan vendor:publish --provider="MoonShine\Scout\Providers\ScoutServiceProvider"
```

2. Specify the list of models for searching in the configuration file `config/moonshine-scout.php`.

```php
'models' => [
    Article::class,
    User::class,
],
```

3. Implement the interface in the models.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:6]
namespace App\Models;

use Laravel\Scout\Builder;
use Laravel\Scout\Searchable;
use MoonShine\Scout\HasGlobalSearch;
use MoonShine\Scout\SearchableResponse;

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
            image: $this->thumbnail,
        );
    }
}
```

4. Replace the `Search` component in `Layout`.

```php
protected function getSearchComponent(): ComponentContract
{
    return MoonShine\Scout\Components\Search::make();
}
```
