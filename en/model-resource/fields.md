---
video: https://youtu.be/5o8qSf94Bf0?si=9dLj_SiXA1-w6hFo&t=391
---

# Fields

[Fields](/docs/{{version}}/fields/index) in **MoonShine** are used not only for entering data, but also for outputting it.
In most cases, they refer to table fields from the database.

In **MoonShine**, there are many types of fields that cover all possible requirements!
They also encompass all possible relationships in **Laravel** and are conveniently named after the relationship methods
`BelongsTo`, `BelongsToMany`, `HasOne`, `HasMany`, `HasOneThrough`, `HasManyThrough`, `MorphOne`, `MorphMany`.

Adding fields to resource pages is easy!
To do this, you need to declare the fields in the `fields()` method on the appropriate pages.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

class PostIndexPage extends IndexPage
{
    protected function fields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Title'),
        ];
    }
}
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

class PostFormPage extends FormPage
{
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Title')
                    ->required(),
                Text::make('Subtitle')
                    ->nullable(),
            ]),
        ];
    }
}
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

class PostDetailPage extends DetailPage
{
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Title'),
            Text::make('Subtitle'),
        ];
    }
}
```
