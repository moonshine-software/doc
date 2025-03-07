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

## How to work with JSON fields?

See [Json](/docs/{{version}}/fields/json) field section.

## How do I add styles or classes to fields or components?

[Adding class](/docs/{{version}}/components/attributes#class).

[Adding style](/docs/{{version}}/components/attributes#style).

## How to use field reactivity?

General information about [field reactivity](/docs/{{version}}/fields/basic-methods#reactive).

The option of using reactivity as an example of [Slug](/docs/{{version}}/fields/slug#live) field.

## How do I set up access rights for different user roles?

On the topic of authorization, read the relevant [section of documentation](/docs/{{version}}/model-resource/authorization).

To integrate role-based access control in **MoonShine**,
you can use the third-party package [moonshine-roles-permissions](https://getmoonshine.app/plugins/moonshine-roles-permissions).

## How to properly use resource events (beforeCreating, afterCreated etc.)?

See [ModelResource > Events](/docs/{{version}}/model-resource/events).

## How do I set up filtering in a resource?

See [ModelResource > Filters](/docs/{{version}}/model-resource/filters).

## How to implement drag and drop sorting records?

**TableBuilder** component has [reorderable()](/docs/{{version}}/components/table-builder#drag-and-drop-sorting) method,
which adds the ability to sort rows by dragging.
