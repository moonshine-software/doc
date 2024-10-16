# Поля

- [Основы](#basics)
- [По умолчанию](#default)
- [Разделение полей](#separate)

---

<a name="basics"></a>
## Основы

Поля в большинстве случаев относятся к полям таблиц из базы данных. В рамках **CRUD** они будут отображаться на главной странице раздела (ресурса) со списком и на странице для создания и редактирования записей. В админ-панели MoonShine есть множество типов полей, которые охватывают все возможные требования! Также охватываются все возможные отношения в Laravel и для удобства называются так же, как методы отношений: `BelongsTo`, `BelongsToMany`, `HasOne`, `HasMany`, `HasOneThrough`, `HasManyThrough`, `MorphOne`, `MorphMany`.

Добавлять поля в _ModelResource_ легко!

<a name="default"></a>
## По умолчанию

В _ModelResource_ по умолчанию необходимо в методе `fields()` вернуть массив со всеми [Полями](https://moonshine-laravel.com/docs/resource/fields/fields-index).

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function fields(): array
    {
        return [
            ID::make(),
            Text::make('Title'),
        ];
    }

    //...
}
```

<a name="separate"></a>
## Разделение полей

Иногда возникает необходимость исключить или изменить порядок некоторых полей на странице индекса или детальной странице. Для этого можно использовать методы, которые позволяют переопределить поля для соответствующих страниц: `indexFields()`, `formFields()` или `detailFields()`.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function indexFields(): array
    {
        return [
            ID::make(),
            Text::make('Title'),
        ];
    }

    public function formFields(): array
    {
        return [
            ID::make(),
            Text::make('Title'),
            Text::make('Subtitle'),
        ];
    }

    public function detailFields(): array
    {
        return [
            Text::make('Title', 'title'),
            Text::make('Subtitle'),
        ];
    }

    //...
}
```
