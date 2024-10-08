https://moonshine-laravel.com/docs/resource/fields/fields-belongs_to_many?change-moonshine-locale=en

------

# BelongsToMany

  - [Basics](#basics)
  - [Column header](#label-column)
  - [Pivot](#pivot)
  - [Creating a Relationship Object](#creatable)
  - [Select](#select)
  - [Options](#options)
  - [Placeholder](#placeholder)
  - [Tree](#tree)
  - [Preview](#preview)
  - [Link only](#only-link)
  - [Query for values](#values-query)
  - [Asynchronous search](#async-search)
  - [Related fields](#associated)
  - [Values with picture](#with-image)
  - [Buttons](#buttons)

---

<a name="basics"></a> 
### Basics

The *BelongsToMany* field is designed to work with the relation of the same name in Laravel and includes all the basic methods.

To create this field, use the static `make()` method.

```php
BelongsToMany::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null,
    ?ModelResource $resource = null
)
```

- `$label` - label, field header,
- `$relationName` - name of the relationship,
- `$formatted` - a closure or field in a related table to display values,
- `$resource` - the model resource referenced by the relation.

> [!WARNING]
> The presence of the model resource referenced by the relation is mandatory! The resource also needs to be [registered](https://moonshine-laravel.com/docs/resource/models-resources/resources-index#define) with the service provider *MoonShineServiceProvider* in the method `menu()` or `resources()`. Otherwise, there will be a 404 error.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', 'categories', resource: new CategoryResource())
    ];
}
```

![belongs_to_many](https://moonshine-laravel.com/screenshots/belongs_to_many.png)
![belongs_to_many_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_dark.png)

> [!NOTE]
> If you do not specify `$relationName`, then the relation name will be determined automatically based on `$label`.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
    ];
}

//...
```

> [!NOTE]
> You can omit `$resource` if the model resource matches the name of the relationship.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', 'categories')
    ];
}

//...
```
> [!NOTE]
> By default, a field in the related table is used to display the value. which is specified by the `$column` property in the model resource.
The `$formatted` argument allows you to override this..

```php
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class CategoryResource extends ModelResource
{
    //...

    public string $column = 'title';

    //...
}
```

If you need to specify a more complex value to display, then the `$formatted` argument can be passed a callback function.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make(
            'Categories',
            'categories',
            fn($item) => "$item->id. $item->title"
        )
    ];
}

//...
```

<a name="label-column"></a> 
### Column header 

By default, the table column header uses the property `$title` of the relationship model resource.
The `columnLabel()` method allows you to override the title.

```php
columnLabel(string $label)
```

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->columnLabel('Title')
    ];
}

//...
```

<a name="pivot"></a> 
### Pivot

The `fields()` method is used to implement *pivot* fields in the BelongsToMany relationship.

```php
fields(Fields|Closure|array $fields)
```

```php
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Contacts', resource: new ContactResource())
            ->fields([
                Text::make('Contact', 'text'),
            ])
    ];
}

//...
```

![belongs_to_many_pivot](https://moonshine-laravel.com/screenshots/belongs_to_many_pivot.png)
![belongs_to_many_pivot_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_pivot_dark.png)

> [!WARNING]
> The relationship must specify which *pivot* fields are used in the staging table!
More details in the official documentation [Laravel](https://laravel.com/docs/eloquent-relationships#retieving-intermediate-table-columns).

<a name="creatable"></a> 
### Creating a Relationship Object 

The `creatable()` method allows you to create a new relation object through a modal window.

```php
creatable(
    Closure|bool|null $condition = null,
    ?ActionButton $button = null,
)
```

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->creatable()
    ];
}

//...
```

![belongs_to_many_creatable](https://moonshine-laravel.com/screenshots/belongs_to_many_creatable.png)
![belongs_to_many_creatable_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_creatable_dark.png)

You can customize the create button by passing the *button* parameter to the method.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->creatable(
                button: ActionButton::make('Custom button', '')
            )
    ];
}

//...
```

<a name="select"></a> 
### Select

The *BelongsToMany* field can be displayed as a drop-down list, To do this, you need to use the `selectMode()` method.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->selectMode()
    ];
}

//...
```

![belongs_to_many_select](https://moonshine-laravel.com/screenshots/belongs_to_many_select.png)
![belongs_to_many_select_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_select_dark.png)

<a name="options"></a> 
### Options

All choices options are available to change via *data attributes*:

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Countries', resource: new CountryResource())
            ->selectMode()
            ->customAttributes([
                'data-max-item-count' => 2
            ])
    ];
}
```

> [!NOTE]
> For more details please contact [Choices](https://choices-js.github.io/Choices/).

<a name="placeholder"></a> 
### Placeholder

The `placeholder()` method allows you to set *placeholder* attribute on the field.

```php
placeholder(string $value)
```

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Countries', 'countries')
            ->nullable()
            ->placeholder('Countries')
    ];
}

//...
```

> [!NOTE]
> The `placeholder()` method is only used if the field is displayed as a dropdown list `selectMode()`!

<a name="tree"></a> 
### Tree

The `tree()` method allows you to display values as a tree with checkboxes, for example, for categories that have nesting. The method must be passed a column in the database on which the tree will be built.

```php
tree(string $parentColumn)
```

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->tree('parent_id')
    ];
}

//...
```

![belongs_to_many_tree](https://moonshine-laravel.com/screenshots/belongs_to_many_tree.png)
![belongs_to_many_tree_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_tree_dark.png)


<a name="preview"></a> 
### Preview

By default, *preview* will display the field as a table.

![belongs_to_many_preview](https://moonshine-laravel.com/screenshots/belongs_to_many_preview.png)
![belongs_to_many_preview_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_preview_dark.png)

To change the display in *preview* you can use the following methods.

### onlyCount

The `onlyCount()` method allows you to display only the number of selected values in *preview*.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->onlyCount()
    ];
}

//...
```

![belongs_to_many_preview_count](https://moonshine-laravel.com/screenshots/belongs_to_many_preview_count.png)
![belongs_to_many_preview_count_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_preview_count_dark.png)

### inLine

The `inLine()` method allows you to display field values as a line. 

```php
inLine(string $separator = '', Closure|bool $badge = false, ?Closure $link = null)
```
You can pass optional parameters to the method:

- `separator` - separator between elements;
- `badge` - closure or boolean value, responsible for displaying elements as badge;
- `$link` - a closure that should return url links or components.

When passing the boolean value true to the `badge` parameter, the color will be used Primary . To change the color displayed by `badge`, use closure and return the `Badge::make()` component.

```php
use MoonShine\Components\Link;
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->inLine(
                separator: ' ',
                badge: fn($model, $value) => Badge::make($value, 'color'),
                link: fn(Category $category, $value, $field) => Link::make(
                    (new CategoryResource())->detailPageUrl($category),
                    $value
                )
            )
    ];
}

//...
```

![belongs_to_many_preview_in_line](https://moonshine-laravel.com/screenshots/belongs_to_many_preview_in_line.png)
![belongs_to_many_preview_in_line_dark](https://moonshine-laravel.com/screenshots/belongs_to_many_preview_in_line_dark.png)

<a name="only-link"></a> 
### Link only

The `onlyLink()` method will allow you to display the relationship as a link with the number of elements.

```php
onlyLink(?string $linkRelation = null, Closure|bool $condition = null)
```

You can pass optional parameters to the method:
- `linkRelation` - link to the relationship;
- `condition` - closure or boolean value, responsible for displaying the relationship as a link.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->onlyLink('category')
    ];
}
```

### linkRelation

The `linkRelation` parameter allows you to create a link to a relation with a parent resource binding.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->onlyLink('category')
    ];
}

//...
```

### condition

The `condition` parameter via a closure will allow you to change the display method depending on the conditions.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->onlyLink(condition: function (int $count, Field $field): bool {
                return $count > 10;
            })
    ];
}

//...
```

<a name="values-query"></a> 
### Query for values

The `valuesQuery()` method allows you to change the query for obtaining values.

```php
valuesQuery(Closure $callback)
```

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Countries', 'countries', resource: new CountryResource())
            ->valuesQuery(fn(Builder $query, Field $field) => $query->where('active', true))
    ];
}
```

<a name="async-search"></a> 
### Asynchronous search

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
use MoonShine\Fields\Relationships\BelongsToMany;
 
//...
 
public function fields(): array
{
    return [
        BelongsToMany::make('Countries', 'countries', resource: new CountryResource())
            ->asyncSearch() 
    ];
}
 
//...
```

> [!TIP]
> The search will be carried out using the resource relationship field `column`. By default `column=id`

You can pass parameters to the `asyncSearch()` method:

- `$asyncSearchColumn` - the field in which the search takes place;
- `$asyncSearchCount` - number of elements in the search results;
- `$asyncSearchQuery` - callback-function for filtering values;
- `$asyncSearchValueCallback` - callback-function for customizing output;
- `$associatedWith` - the field with which to establish a connection;
- `$url` - url to process the asynchronous request,
- `$replaceQuery` - replace query.

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Countries', 'countries', resource: new CountryResource())
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

> [!TIP]
> When building a query in `asyncSearchQuery()`, you can use the current form values. To do this, you need to pass `Request` to the callback function.

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id'),
        BelongsToMany::make('Cities', 'cities',  resource: new CityResource())
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

> [!TIP]
> When building a query in `asyncSearchQuery()`, the original state of the builder is preserved.
If you need to replace it with your builder, then use the `replaceQuery` flag.

```php
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id'),
        BelongsToMany::make('Cities', 'cities',  resource: new CityResource())
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

> [!TIP]
> Requests must be customized using the `asyncSearch()` method. Don't use `valuesQuery()`!

<a name="associated"></a> 
### Related fields

To associate select values between fields, you can use the `associatedWith()` method.

```php
associatedWith(string $column, ?Closure $asyncSearchQuery = null)
```

- `$column` - the field with which the connection is established;
- `$asyncSearchQuery` - callback function for filtering values.

```php
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Cities', 'cities', resource: new CityResource())
            ->associatedWith('country_id')
    ];
}
```

> [TIP]
> For more complex setup, you can use `asyncSearch()`.

<a name="with-image"></a> 
### Values with picture

The `withImage()` method allows you to add an image to a value.

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
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make(Countries, resource: new CountryResource())
            ->withImage('thumb', 'public', 'countries')->selectMode()
    ];
}

//...
```

![with_image](https://moonshine-laravel.com/screenshots/belongs_to_image.png)
![belongs_to_image_dark](https://moonshine-laravel.com/screenshots/belongs_to_image_dark.png)

<a name="buttons"></a> 
### Buttons

The `buttons()` method allows you to add additional buttons to the *BelongsToMany* field.

```php
buttons(array $buttons)
```

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->buttons([
                ActionButton::make('Check all', '')
                    ->onClick(fn() => 'checkAll', 'prevent'),

                ActionButton::make('Uncheck all', '')
                    ->onClick(fn() => 'uncheckAll', 'prevent')
            ])
    ];
}
```

### withCheckAll

The `withCheckAll()` method allows you to add checkAll/uncheckAll buttons to the *BelongsToMany* field similar to the previous example.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Fields\Relationships\BelongsToMany;

//...

public function fields(): array
{
    return [
        BelongsToMany::make('Categories', resource: new CategoryResource())
            ->withCheckAll()
    ];
}

//...
```
