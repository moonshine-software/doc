# Queries

- [Queries](#query)
- [Receiving a Record](#receiving-a-record)
- [Eager Load](#eager-load)
- [Search](#search)
- [Sorting](#sorting)

---

<a name="query"></a>
## Queries

It is often necessary to initially modify all resource queries to the database.
You can easily override the `QueryBuilder` in the resource.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
namespace App\MoonShine\Resources;

use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    protected function modifyQueryBuilder(Builder $builder): Builder
    {
        return $builder->where('active', true);
    }
}
```

> [!NOTE]
> If you need to completely override the `Builder`, you can override the resource method `newQuery()`.

<a name="receiving-a-record"></a>
## Receiving a Record

The `modifyItemQueryBuilder()` method is used if you need to modify the query for retrieving a record from the database.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
namespace App\MoonShine\Resources;

use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    protected function modifyItemQueryBuilder(Builder $builder): Builder
    {
        return $builder->withTrashed();
    }
}
```

> [!NOTE]
> If you need to completely override the `Builder` for retrieving a record, you can override the resource method `findItem()`.

<a name="eager-load"></a>
## Eager Load

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected array $with = ['user', 'categories'];

    // ...
}
```

<a name="search"></a>
## Search

The `searchQuery()` method allows you to override the query when searching for records.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    protected function searchQuery(string $terms): void
    {
        $this->newQuery()->where(function (Builder $builder) use ($terms): void {
            // Your logic
        });
    }
}
```

If you only want to expand the query, you need to call the parent method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    protected function searchQuery(string $terms): void
    {
        parent::searchQuery($terms);

        $this->newQuery()->where(function (Builder $builder) use ($terms): void {
            // Your logic
        });
    }
}

You can also completely override the logic, including full-text search.

```php
protected function resolveSearch(string $terms, ?iterable $fullTextColumns = null): static
{
  // Your logic

  return $this;
}
```

<a name="sorting"></a>
## Sorting

By overriding the `resolveOrder()` method, you can customize the sorting of records.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    protected function resolveOrder(string $column, string $direction, ?Closure $callback): static
    {
        if ($callback instanceof Closure) {
            $callback($this->newQuery(), $column, $direction);
        } else {
            $this->newQuery()->orderBy($column, $direction);
        }

        return $this;
    }
}
```
