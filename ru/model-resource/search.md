# Поиск

- [Основы](#basics)
- [Полнотекстовый поиск](#fulltext)
- [Поиск по ключам json](#json)
- [Поиск по связям](#relation)
- [Глобальный поиск](#global)

---

<a name="basics"></a>
## Основы

Для поиска необходимо указать, какие поля модели будут участвовать в поиске.
Для этого нужно перечислить их в возвращаемом массиве в методе `search()`.

> [!NOTE]
> Если метод возвращает пустой массив, то строка поиска не будет отображаться.

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
## Полнотекстовый поиск

Если требуется полнотекстовый поиск, то необходимо использовать атрибут `SearchUsingFullText`.

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
> Не забудьте добавить полнотекстовый индекс.

<a name="json"></a>
## Поиск по ключам json

Для `Json` полей, которые используются в качестве ключ-значение `keyValue()`, можно указать, какой ключ поля участвует в поиске.

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

Для многомерных `Json`, которые формируются через поля `fields()`, ключ поиска нужно указывать следующим образом:

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
## Поиск по связям

Вы можете осуществлять поиск по связям. Для этого нужно указать, по какому полю связи осуществлять поиск.

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
## Глобальный поиск

В **MoonShine** можно реализовать глобальный поиск на основе интеграции [Laravel Scout](https://laravel.com/docs/scout).

Для реализации глобального поиска необходимо:

1. Установить пакет `moonshine/scout`.

```shell
composer require moonshine/scout
```

```shell
php artisan vendor:publish --provider="MoonShine\Scout\Providers\ScoutServiceProvider"
```

2. Указать список моделей для поиска в конфигурационном файле `config/moonshine-scout.php`.

```php
'models' => [
    Article::class,
    User::class,
],
```

3. Реализовать интерфейс в моделях.

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

4. Заменить компонент `Search` в `Layout`.

```php
protected function getSearchComponent(): ComponentContract
{
    return MoonShine\Scout\Components\Search::make();
}
```
