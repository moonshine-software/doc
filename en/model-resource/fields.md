# Fields

Fields usually refer to database table fields.
Within the `CRUD`, they will be displayed on the main page of the section (resource) with the list and on the page for creating and editing records.

In **MoonShine**, there are many types of fields that cover all possible requirements!
They also encompass all possible relationships in **Laravel** and are conveniently named after the relationship methods
`BelongsTo`, `BelongsToMany`, `HasOne`, `HasMany`, `HasOneThrough`, `HasManyThrough`, `MorphOne`, `MorphMany`.

Adding fields to `ModelResource` is very simple!
You can use methods that allow you to declare fields for the corresponding pages: `indexFields()`, `formFields()`, or `detailFields()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:6]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

class PostResource extends ModelResource
{
    // ...

    protected function indexFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Title'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Title'),
                Text::make('Subtitle'),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            Text::make('Title', 'title'),
            Text::make('Subtitle'),
        ];
    }
}
```
