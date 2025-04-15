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

Here is a [recipe](/docs/3.x/recipes/reorderable-resource) for implementing drag-and-drop sorting in a resource.

## How can I customize the appearance of the admin panel?

There are many ways to change the appearance of layouts in **MoonShine**. Read the “Appearance” sections in documentation.

## How do I save the authorized user's ID when creating an entry?

In the following example, the current authenticated user is assigned as the author by default.

```php
public function formFields(): array
{
    return [
        // ...
        BelongsTo::make('Author', resource: UserResource::class)
            ->default( request()->user() ),
    ];
}
```

You can also add a hidden field and fill it in with the user ID value from the request.

```php
Hidden::make('Author')
    ->fill( auth()->id() )
```

Also in the [Model Resource > Events](/docs/{{version}}/model-resource/events) section shows an example of adding a field to a request via events.

## What is the correct way to work with fractional numbers in the Number field?

It is enough to specify the required step using the [step()](/docs/{{version}}/fields/number#step) method, for example "0.01".

## How can I set up asynchronous search in Select fields?

See the [Select](/docs/{{version}}/fields/select#async) section.

## How can I change or hide the menu items depending on the user's rights?

See the [recipe](/docs/{{version}}/recipes/menu-authorization).

## How can I change the date format in the Date fields?

See the [Date](/docs/{{version}}/fields/date#format) field section.

## How do I change the logo and favicon in the admin panel?

The logo can be changed in [configuration](/docs/{{version}}/configuration#logo).

The favicon can be replaced in the `Layout` in the [Favicon](/docs/{{version}}/components/favicon#assets) component.

## How to implement multiple file uploads?

See [File](/docs/{{version}}/fields/file#multiple) field section.

## How do I set up data import/export to CSV or Excel?

See [Import /Export](/docs/{{version}}/model-resource/import-export) section.

## How to work with Markdown fields in MoonShine?

You can use [moonshine-software/easymde](https://github.com/moonshine-software/easymde) package.

## How to customize breadcrumbs in MoonShine?

Breadcrumbs can be redefined on individual [pages](/docs/{{version}}/page/index#breadcrumbs).

[Recipe](/docs/{{version}}/recipes/custom-breadcrumbs), how to change breadcrumbs from a resource for individual pages.

## How do I remove mass actions and checkboxes from the index page?

[ModelResource > Basics](/docs/{{version}}/model-resource/index#active-actions).

## How do I set up a global search in MoonShine?

[model-resource/search#global](/docs/{{version}}/model-resource/search#global).

## How to implement custom input fields in MoonShine?

It is enough to extend the base class `Field` or the class of any of the available fields and add/redefine the functionality you need.
For example, connect another **view**.

## How to use QueryTags in MoonShine?

[model-resource/query-tags](/docs/{{version}}/model-resource/query-tags).

## How do I make or replace buttons in FormBuilder?

[components/form-builder#buttons](/docs/{{version}}/components/form-builder#buttons).

## How can I adjust the display of fields depending on the value of another field?

[fields/basic-methods#show-when](/docs/{{version}}/fields/basic-methods#show-when).

[Recipe with examples](/docs/{{version}}/recipes/select).

## How can I change or delete the standard action buttons in a resource?

[model-resource/buttons](/docs/{{version}}/model-resource/buttons).

## How to work with Enum fields in MoonShine?

[fields/enum](/docs/{{version}}/fields/enum).

## How do I add custom pages to MoonShine?

[page/index#create](/docs/{{version}}/page/index#create).

## How to work with soft delete in MoonShine?

[recipes/soft-deletes](/docs/{{version}}/recipes/soft-deletes).

There is also an [article](https://cutcode.dev/articles/softdeleting-v-moonshine-v3) with a more detailed description.

## How do I set up custom routes in MoonShine?

[advanced/routes](/docs/{{version}}/advanced/routes).

## How to work with the Switcher field in forms and filters?

`Switcher` is the same `Checkbox`, only in a different visual design.

## How to implement custom authentication in MoonShine?

[security/authentication#customization](/docs/{{version}}/security/authentication#customization).

## How can I adjust the Badge display depending on the value?

Fields have a `badge()` method that can accept a closure that returns a color code: [fields/basic-methods#badge](/docs/{{version}}/fields/basic-methods#badge).

Also see the [Enum](/docs/{{version}}/fields/enum#color) section.
