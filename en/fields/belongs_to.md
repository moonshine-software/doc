# BelongsTo

- [Basics](#basics)
- [Default value](#default)
- [Nullable](#nullable)
- [Placeholder](#placeholder)
- [Creating a Relationship Object](#creatable)
- [Finding values](#searchable)
- [Query for values](#values-query)
- [Asynchronous search](#async-search)
- [Related fields](#associated)
- [Values with picture](#with-image)
- [Options](#options)
- [Native mode](#native)

---

<a name="basics"></a>
## Basics

The _BelongsTo_ field is designed to work with the relation of the same name in Laravel and includes all the basic methods.

To create this field, use the static `make()` method.

```php
BelongsTo::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null,
    ?ModelResource $resource = null
)
```

- `$label` - label, field header,*   `$relationName` - name of the relationship,
- `$formatted` - a closure or field in a related table to display values,
- `$resource` - the model resource referenced by the relation.

> [!WARNING]
> The presence of the model resource referenced by the relation is mandatory!
> The resource also needs to be [registered](https://moonshine-laravel.com/docs/resource/models-resources/resources-index#define) with the service provider _MoonShineServiceProvider_ in the method `menu()` or `resources()`. Otherwise, there will be a 404 error.


```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country', resource: new CountryResource())
    ];
}

//...
```

![belongs_to](https://moonshine-laravel.com/screenshots/belongs_to.png) ![belongs_to_dark](https://moonshine-laravel.com/screenshots/belongs_to_dark.png)

> [!NOTE]
> If you do not specify `$relationName`, then the relation name will be determined automatically based on `$label`.

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', resource: new CountryResource())
    ];
}

//...
```

> [!NOTE]
> You can omit `$resource` if the model resource matches the name of the relationship.

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country')
    ];
}

//...
```

> [!NOTE]
> By default, a field in the related table is used to display the value. which is specified by the `$column` property in the model resource.  
> The `$formatted` argument allows you to override this.

```php
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class CountryResource extends ModelResource
{
    //...

    public string $column = 'title';

    //...
}
```

If you need to specify a more complex value to display, then the `$formatted` argument can be passed a callback function.

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make(
            'Country',
            'country',
            fn($item) => "$item->id. $item->title"
        )
    ];
}

//...
```

> [!WARNING]
> When using the _BelongsTo_ field to sort or filter positions, you must use the method `setColumn()` set a field in a database table or override a method [sorting](https://moonshine-laravel.com/docs/resource/models-resources/resources-query#order) at the model resource.

If you need to change column when working with models, use the `onAfterFill` method

```php
BelongsTo::make(
    'Category',
    resource: new CategoryResource()
)->afterFill(fn($field) => $field->setColumn('changed_category_id'))
```

<a name="default"></a>
## Default value

You can use the `default()` method if you need to specify a default value for a field.

```php
default(mixed $default)
```

You must pass a model object as the default value.

```
use App\Models\Country;
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', resource: new CountryResource())
            ->default(Country::find(1))
    ];
}

//...
```

<a name="nullable"></a>
## Nullable

Like all fields, if you need to store NULL, you need to add the `nullable()` method

```php
nullable(Closure|bool|null $condition = null)
```

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', resource: new CountryResource())
            ->nullable()
    ];
}

//...
```

![select_nullable](https://moonshine-laravel.com/screenshots/select_nullable.png) ![select_nullable_dark](https://moonshine-laravel.com/screenshots/select_nullable_dark.png)

> [!TIP]
> MoonShine is a very handy and functional tool. However, to use it, you need to be confident in the basics of Laravel.

Don't forget to indicate in the database table that the field can take the value `Null`.

<a name="placeholder"></a>
## Placeholder

The `placeholder()` method allows you to set _placeholder_ attribute on the field.

```php
placeholder(string $value)
```

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country')
            ->nullable()
            ->placeholder('Country')
    ];
}

//...
```

<a name="searchable"></a>
## Finding values

If you need to search among values, you need to add the `searchable()` method.

```php
use MoonShine\Fields\BelongsTo;
use App\MoonShine\Resources\CountryResource;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country', new CountryResource())
            ->searchable()
    ];
}

//...
```

<a name="creatable"></a>
## Creating a Relationship Object

The `creatable()` method allows you to create a new relation object through a modal window.

```php
creatable(
    Closure|bool|null $condition = null,
    ?ActionButton $button = null,
)
```

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Author', resource: new AuthorResource())
            ->creatable()
    ];
}

//...
```

![belongs_to_creatable](https://moonshine-laravel.com/screenshots/belongs_to_creatable.png) ![belongs_to_creatable_dark](https://moonshine-laravel.com/screenshots/belongs_to_creatable_dark.png)

You can customize the create button by passing the _button_ parameter to the method.

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Author', resource: new AuthorResource())
            ->creatable(
                button: ActionButton::make('Custom button', '')
            )
    ];
}

//...
```

<a name="values-query"></a>
## Query for values

The `valuesQuery()` method allows you to change the query for obtaining values.

```php
valuesQuery(Closure $callback)
```

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Category', 'category', resource: new CategoryResource())
            ->valuesQuery(fn(Builder $query, Field $field) => $query->where('active', true))
    ];
}

//...
```

<a name="async-search"></a>
## Asynchronous search

To implement asynchronous search for values, use the `asyncSearch()` method.

```php
asyncSearch(
    string $asyncSearchColumn = null,
    int $asyncSearchCount = 15,
    ?Closure $asyncSearchQuery = null,
    ?Closure $asyncSearchValueCallback = null,
    ?string $associatedWith = null,
    ?string $url = null,
    bool $replaceQuery = false,
)
```

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country', resource: new CountryResource())
            ->asyncSearch()
    ];
}

//...
```

> [!TIP]
> The search will be carried out using the resource relationship field `column`. By default `column=id`.

You can pass parameters to the `asyncSearch()` method:

*   `$asyncSearchColumn` - the field in which the search takes place;
*   `$asyncSearchCount` - number of elements in the search results;
*   `$asyncSearchQuery` - callback-function for filtering values;
*   `$asyncSearchValueCallback` - callback-function for customizing output;
*   `$associatedWith` - the field with which to establish a connection;
*   `$url` - url to process the asynchronous request,
*   `$replaceQuery` - replace query.

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country', resource: new CountryResource())
            ->asyncSearch(
                'title',
                10,
                asyncSearchQuery: function (Builder $query, Request $request, Field $field) {
                    return $query->where('id', '!=', 2);
                },
                asyncSearchValueCallback: function ($country, Field $field) {
                    return $country->id . ' | ' . $country->title;
                },
                'https://moonshine-laravel.com/async'
            )
    ];
}

//...
```

> [!NOTE]
> When building a query in `asyncSearchQuery()`, you can use the current form values. To do this, you need to pass `Request` to the callback function.

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id'),
        BelongsTo::make('City', 'city',  resource: new CityResource())
            ->asyncSearch(
                'title',
                asyncSearchQuery: function (Builder $query, Request $request, Field $field): Builder {
                    return $query->where('country_id', $request->get('country_id'));
                }
            )
    ];
}

//...
```

> [!NOTE]
> When building a query in `asyncSearchQuery()`, the original state of the builder is preserved.  
If you need to replace it with your builder, then use the `replaceQuery` flag.

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id'),
        BelongsTo::make('City', 'city',  resource: new CityResource())
            ->asyncSearch(
                'title',
                asyncSearchQuery: function (Builder $query, Request $request, Field $field): Builder {
                    return $query->where('country_id', $request->get('country_id'));
                },
                replaceQuery: true
            )
    ];
}

//...
```

<a name="associated"></a>
## Related fields

To associate select values between fields, you can use the `associatedWith()` method.

```php
associatedWith(string $column, ?Closure $asyncSearchQuery = null)
```

- `$column` - the field with which the connection is established;
- `$asyncSearchQuery` - callback function for filtering values.

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('City', 'city', resource: new CityResource())
            ->associatedWith('country_id')
    ];
}

//...
```

> [!NOTE]
> For more complex setup, you can use `asyncSearch()`.

<a name="with-image"></a>
## Values with picture

> [!NOTE]
> The `withImage()` method allows you to add an image to a value.

```php
withImage(
    string $column,
    string $disk = 'public',
    string $dir = ''
)
```

- `$column` - field with an image;
- `$disk` - file system disk;
- `$dir` - directory relative to the root of the disk.

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make(Country, resource: new CountryResource())
            ->withImage('thumb', 'public', 'countries')
    ];
}

//...
```

![belongs_to_image](https://moonshine-laravel.com/screenshots/belongs_to_image.png) ![belongs_to_image_dark](https://moonshine-laravel.com/screenshots/belongs_to_image_dark.png)

<a name="options"></a>
## Options

All choices options are available to change via _data attributes_:

```php
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', resource: new CountryResource())
            ->searchable()
            ->customAttributes([
                'data-search-result-limit' => 5
            ])
    ];
}

//...
```

> [!NOTE]
> For more details please contact [Choices](https://choices-js.github.io/Choices/) .

<a name="native"></a>
## Native mode

The `native()` method disables the Choices.js library and displays select in native mode

```php
BelongsTo::make('Type')->native()
```
