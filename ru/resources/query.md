# Запрос

- [Запрос](#request)
- [Получение записи](#receiving-a-record)
- [Поиск](#search)
- [Сортировка](#sorting)

---

<a name="request"></a>
## Запрос

Часто необходимо изначально изменить все запросы ресурса к базе данных.
Вы можете легко переопределить *query builder* в ресурсе.

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
## Получение записи

Метод `resolveItemQuery()` используется, если вам нужно изменить запрос для получения записи из базы данных.

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
## Поиск

Метод `searchQuery()` позволяет изменить запрос при поиске записей.

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
## Сортировка

Переопределив метод `resolveOrder()`, вы можете настроить сортировку записей.

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
