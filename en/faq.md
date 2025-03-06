# FAQ

## How to use relationships in MoonShine?

**Eloquent** relationships in **MoonShine** are implemented through the corresponding fields of the same name.

**MoonShine** supports all possible relationships: `BelongsTo`, `BelongsToMany`, `HasOne`, `HasMany` and others.

Consider using relationship fields using the example of `BelongsTo`. For example, you have the `Post` and `Author` models, where each post belongs to one author.

```php
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// In Post model
public function author(): BelongsTo
{
    return $this->belongsTo(Author::class);
}
```

```php
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

// In MoonShine PostResource
public function formFields(): array
{
    return [
        // ...
        BelongsTo::make('Author', 'author', AuthorResource::class),
    ];
}
```

For more information about each type of connection, see the relevant fields in the documentation.

## How to work with JSON fields in MoonShine?

See [Json](/docs/{{version}}/fields/json) field section.

## How do I add styles or classes to fields or components?

[Adding class](/docs/{{version}}/components/attributes#class).

[Adding style](/docs/{{version}}/components/attributes#style).
