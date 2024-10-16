# Fields

- [Basics](#basics)
- [Default](#default)
- [Field separation](#separate)

---

<a name="basics"></a>
## Basics

Fields in most cases refer to table fields from the database. Within **CRUD** will be displayed on the main page of the section (resource) with a list and on the page for creating and editing records. There are many types of fields in the MoonShine admin panel that cover all possible requirements! Also covers all possible relationships in Laravel and for convenience are called the same as relationship methods `BelongsTo`, `BelongsToMany`, `HasOne`, `HasMany`, `HasOneThrough`, `HasManyThrough`, `MorphOne`, `MorphMany`.

Adding fields to _ModelResource_ is easy!

<a name="default"></a>
## Default

In _ModelResource_ by default it is necessary in the `fields()` method return an array with all [Fields](https://moonshine-laravel.com/docs/resource/fields/fields-index) .

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
## Field separation

Sometimes there is a need to exclude or change the order of some fields order in an index or detail page. To do this, you can use methods that allow you to redefine fields for the corresponding pages: `indexFields()`, `formFields()` or `detailFields()`.

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