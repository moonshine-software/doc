# Quick filters (tags)

- [Basics](#basics)
- [Icon](#icon)
- [Active item](#active-item)
- [Display condition](#display-condition)
- [Alias](#alias)

---

<a name="basics"></a>
## Basics

Sometimes there is a need to create filters (results a selection) a set and display it on the listing. Tags have been created for such situations.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\QueryTags\QueryTag;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function queryTags(): array
    {
        return [
            QueryTag::make(
                'Post with author', // Tag Title
                fn(Builder $query) => $query->whereNotNull('author_id') // Query builder
            )
        ];
    }

    //...
}

```

![query_tags](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/query_tags.png)
![query_tags_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/query_tags_dark.png)

<a name="icon"></a>
## Icon

You can add an icon to a tag using the `icon()` method.

```php
use Illuminate\Database\Eloquent\Builder;
use MoonShine\QueryTags\QueryTag;

//...

QueryTag::make(
    'Post without an author',
    fn(Builder $query) => $query->whereNull('author_id')
)
    ->icon('heroicons.users')
```

> [!NOTE]
> For more detailed information, please refer to the section [Icons](https://moonshine-laravel.com/docs/resource/appearance/icons)

<a name="active-item"></a>
## Active item

You can make *QueryTag* active by default. To do this, you need to use the `default()` method.

```php
default(Closure|bool|null $condition = null)
```

```php
use Illuminate\Database\Eloquent\Builder;
use MoonShine\QueryTags\QueryTag;

//...

QueryTag::make(
    'All posts',
    fn(Builder $query) => $query
)
    ->default()
```

<a name="display-condition"></a>
## Display condition

You may want to display tags only under certain conditions, To do this, you can use the `canSee()` method, which needs to pass a callback function that returns `TRUE` or `FALSE`.

```php
use Illuminate\Database\Eloquent\Builder;
use MoonShine\QueryTags\QueryTag;

//...

QueryTag::make(
    'Post with author', // Tag title
    fn(Builder $query) => $query->whereNotNull('author_id')
)
    ->canSee(fn() => auth()->user()->moonshine_user_role_id === 1)
```

<a name="alias"></a>
## Alias

By default, the value for the URL is generated automatically from the `label` parameter. In this case, all non-Latin alphabet characters are replaced with the corresponding transliteration `'Заголовок' => 'zagolovok'`.

The `alias()` method allows you to set your own value for the URL.

```php
use Illuminate\Database\Eloquent\Builder;
use MoonShine\QueryTags\QueryTag;

//...

QueryTag::make(
    'Archived Posts',
    fn(Builder $query) => $query->where('is_archived', true)
)
    ->alias('archive')
```
