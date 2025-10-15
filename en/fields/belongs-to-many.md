# BelongsToMany

- [Basics](#basics)
- [Column Label](#label-column)
- [Pivot](#pivot)
- [Deduplication](#deduplication)
- [Creating Relationship Object](#creatable)
- [Select](#select)
- [Options](#options)
- [Placeholder](#placeholder)
- [Tree](#tree)
- [Horizontal mode](#horizontal)
- [Preview](#preview)
- [Only Link](#only-link)
- [Values Query](#values-query)
- [Async Search](#async-search)
- [Associated Fields](#associated)
- [Values with Image](#with-image)
- [Buttons](#buttons)

---

<a name="basics"></a>
## Basics

The `BelongsToMany` field is designed to work with the same-name relationship in **Laravel** and includes all [Basic Methods](/docs/{{version}}/fields/basic-methods).

```php
BelongsToMany::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null,
    ModelResource|string|null $resource = null,
)
```

- `$label` - label, field title,
- `$relationName` - name of the relationship,
- `$formatted` - closure or field in the related table to display values,
- `$resource` - `ModelResource` that the relationship references.

> [!WARNING]
> Having a `ModelResource` that the relationship refers to is mandatory.
> The resource must also be [registered](/docs/{{version}}/model-resource/index#declaring-in-the-system) in the `MoonShineServiceProvider` service provider in the `$core->resources()` method.
> Otherwise, there will be a 500 error.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make(
    'Categories',
    'categories',
    resource: CategoryResource::class
)
```

![belongs_to_many](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many.png#light)
![belongs_to_many_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_dark.png#dark)

You can omit `$resource` if the `ModelResource` matches the relationship name.

```php
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', 'categories')
```

If `$relationName` is not specified, then the relationship name will be determined automatically based on `$label` (following camelCase rules).

```php
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories')
```

> [!NOTE]
> By default, the value is displayed using the field in the related table specified by the `$column` property in the model resource.
> The `$formatted` argument allows overriding this.

```php
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make(
    'Categories',
    'categories',
    formatted: 'name'
)
```

If you need to specify a more complex value for display, then you can pass a callback function in the `$formatted` argument.

```php
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make(
    'Categories',
    'categories',
    fn($item) => "$item->id. $item->title"
)
```

<a name="label-column"></a>
## Column Label

By default, the table column header uses the `$title` property specified in the `ModelResource` relationship.
The `columnLabel()` method allows overriding the header.

```php
columnLabel(string $label)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->columnLabel('Title')
```

<a name="pivot"></a>
## Pivot

The `fields()` method is used to implement *pivot* fields in the `BelongsToMany` relationship.

```php
fields(FieldsContract|Closure|iterable $fields)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\ContactResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Fields\Text;

BelongsToMany::make(
    'Contacts',
    resource: ContactResource::class
)
->fields([
    Text::make('Contact', 'text'),
])
```

![belongs_to_many_pivot](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_pivot.png#light)
![belongs_to_many_pivot_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_pivot_dark.png#dark)

> [!WARNING]
> In the relationship, you must specify which *pivot* fields are used in the intermediate table!
> For more details, see the official documentation [Laravel](https://laravel.com/docs/eloquent-relationships#retieving-intermediate-table-columns).

<a name="deduplication"></a>
## Deduplication

By default, `BelongsToMany` prevents duplicate selections by key so the same related model cannot be added twice, even if different *pivot* values are provided. 
For use cases where you need multiple rows with the same related key (for example, the same category paired with different pivot data), disable the check:

```php
deduplication(
    Closure|bool|null $condition = null
)
```

```php
BelongsToMany::make('Categories')
    ->fields([
        Text::make('pivot_field'),
    ])
    ->deduplication(false)
```

- The method accepts a `bool` or `Closure`, making it possible to toggle the behaviour dynamically.
- With deduplication disabled, each row is saved separately and pivot data is applied in the order it was submitted.

<a name="creatable"></a>
## Creating Relationship Object

The `creatable()` method allows you to create a new relationship object via a modal window.

```php
creatable(
    Closure|bool|null $condition = null,
    ?ActionButton $button = null,
)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->creatable()
```

![belongs_to_many_creatable](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_creatable.png#light)
![belongs_to_many_creatable_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_creatable_dark.png#dark)

You can customize the creation button by passing the *button* parameter to the method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Components\ActionButton;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->creatable(
        button: ActionButton::make('Custom button', '')
    )
```

<a name="select"></a>
## Select

The `BelongsToMany` field can be displayed as a dropdown list.
To do this, you need to use the `selectMode()` method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->selectMode()
```

![belongs_to_many_select](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_select.png#light)
![belongs_to_many_select_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_select_dark.png#dark)

<a name="options"></a>
## Options

All select options are available for modification via *data attributes*:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->selectMode()
    ->customAttributes([
        'data-max-item-count' => 2
    ])
```

> [!NOTE]
> For more detailed information, please refer to [Choices](https://choices-js.github.io/Choices/).

<a name="placeholder"></a>
## Placeholder

The `placeholder()` method allows you to set the *placeholder* attribute for the field.

```php
placeholder(string $value)
```

```php
BelongsToMany::make('Countries', 'countries')
    ->nullable()
    ->placeholder('Countries')
```

> [!NOTE]
> The `placeholder()` method is only used if the field is displayed as a dropdown list `selectMode()`!

<a name="tree"></a>
## Tree

The `tree()` method allows values to be displayed in a tree format with checkboxes, for example, for categories that have nesting.
The method requires you to pass the column in the database by which the tree will be built.

```php
tree(string $parentColumn)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->tree('parent_id')
```

![belongs_to_many_tree](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_tree.png#light)
![belongs_to_many_tree_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_tree_dark.png#dark)

<a name="horizontal"></a>
## Horizontal mode

The `horizontalMode()` method allows you to display values as a horizontal list.

```php
horizontalMode(
    Closure|bool|null $condition = null,
    string $minColWidth = '200px',
    string $maxColWidth = '1fr'
)
```

- `$condition` - (optional) condition for setting the field to horizontal mode,
- `$minColWidth` - (optional) min column width,
- `$maxColWidth` - (optional) max column width.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->horizontalMode(true, minColWidth: '100px', maxColWidth: '33%')
```

![belongs_to_many_horizontal](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_horizontal.png#light)
![belongs_to_many_horizontal_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_horizontal_dark.png#dark)

<a name="preview"></a>
## Preview

By default, in *preview*, the field will be displayed in a table.

![belongs_to_many_preview](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_preview.png#light)
![belongs_to_many_preview_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_preview_dark.png#dark)

To change the display in *preview*, you can use the following methods.

### onlyCount

The `onlyCount()` method allows you to display only the number of selected values in *preview*.

```php
BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->onlyCount()
```

![belongs_to_many_preview_count](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_preview_count.png#light)
![belongs_to_many_preview_count_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_preview_count_dark.png#dark)

### inLine

The `inLine()` method allows displaying the field values in a single line.

```php
inLine(string $separator = '', Closure|bool $badge = false, ?Closure $link = null)
```

You can pass optional parameters to the method:

- `separator` - separator between items,
- `badge` - closure or boolean value responsible for displaying items as badges,
- `$link` - closure that should return url links or Link component.

When passing a boolean value true to the `badge` parameter, the Primary color will be used.
To change the color of the displayed `badge`, use a closure and return the `Badge::make()` component.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Components\Badge;
use MoonShine\UI\Components\Link;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->inLine(
        separator: ' ',
        badge: fn($model, $value) => Badge::make((string) $value, 'primary'),
        link: fn(Property $property, $value, $field): string|Link => Link::make(
            app(CategoryResource::class)->getDetailPageUrl($property->id),
            $value
        )
    )
```

![belongs_to_many_preview_in_line](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_preview_in_line.png#light)
![belongs_to_many_preview_in_line_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_many_preview_in_line_dark.png#dark)

<a name="only-link"></a>
## Only Link

The `relatedLink()` method will display the relationship as a link with a count of elements.
The link will lead to the IndexPage of the child resource from the `HasMany` relationship, which will show only those data elements.

```php
relatedLink(?string $linkRelation = null, Closure|bool $condition = null)
```

You can pass optional parameters to the method:

- `linkRelation` - link to the relationship,
- `condition` - closure or boolean value responsible for displaying the relationship as a link.

The `linkRelation` parameter allows you to create a link to the relationship with the parent resource binding.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->relatedLink('category')
```

The `condition` parameter through a closure will allow changing the display method depending on conditions.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Fields\Field;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->relatedLink(condition: function (int $count, Field $field): bool {
        return $count > 10;
    })
```

<a name="values-query"></a>
## Values Query

The `valuesQuery()` method allows you to modify the query for retrieving values.

```php
valuesQuery(Closure $callback)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use App\MoonShine\Resources\CategoryResource;
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Fields\Field;

BelongsToMany::make('Categories', 'categories', resource: CategoryResource::class)
    ->valuesQuery(fn(Builder $query, Field $field) => $query->where('active', true))
```

<a name="async-search"></a>
## Async Search

To implement asynchronous search for values, use the `asyncSearch()` method.

```php
asyncSearch(
    string $column = null,
    ?Closure $searchQuery = null,
    ?Closure $formatted = null,
    ?string $associatedWith = null,
    int $limit = 15,
    ?string $url = null,
)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', 'categories', resource: CategoryResource::class)
    ->asyncSearch()
```

> [!NOTE]
> The search will be performed by the relationship resource `column`.
> By default, `column=id`.

You can pass parameters to the `asyncSearch()` method:

- `$column` - the field to search by,
- `$searchQuery` - callback function for filtering values,
- `$formatted` - callback function for customizing the output,
- `$associatedWith` - field to establish a relationship,
- `$limit` - number of elements in the search results,
- `$url` - url for processing the asynchronous request.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:5]
use App\MoonShine\Resources\CountryResource;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Fields\Field;

BelongsToMany::make('Countries', 'countries', resource: CountryResource::class)
    ->asyncSearch(
        'title',
        10,
        searchQuery: function (Builder $query, string $term, Request $request, Field $field) {
            return $query->where('id', '!=', 2);
        },
        formatted: function ($country, Field $field) {
            return $country->id . ' | ' . $country->title;
        },
        'https://moonshine-laravel.com/async'
    )
```

> [!TIP]
> When constructing the query in `searchQuery()`, you can use the current form values.
> To do this, pass `Request` to the callback function.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:6]
use App\MoonShine\Resources\CityResource;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Fields\Field;
use MoonShine\UI\Fields\Select;

Select::make('Country', 'country_id'),

BelongsToMany::make('Cities', 'cities', resource: CityResource::class)
    ->asyncSearch(
        'title',
        searchQuery: function (Builder $query, string $term, Request $request, Field $field): Builder {
            return $query->where('country_id', $request->get('country_id'));
        }
    )
```

> [!TIP]
> Queries should be set up using the `asyncSearch()` method.
> Do not use `valuesQuery()`!

<a name="associated"></a>
## Associated Fields

To establish a relationship of select values between fields, you can use the `associatedWith()` method.

```php
associatedWith(string $column, ?Closure $searchQuery = null)
```

- `$column` - the field with which the relationship is established,
- `searchQuery` - callback function for filtering values.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CityResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

BelongsToMany::make('Cities', 'cities', resource: CityResource::class)
    ->associatedWith('country_id')
```

> [!TIP]
> For more complex configurations, you can use `asyncSearch()`.

<a name="with-image"></a>
## Values with Image

The `withImage()` method allows you to add an image to the value.

```php
withImage(
    string $column,
    string $disk = 'public',
    string $dir = ''
)
```

- `$column` - field with the image,
- `$disk` - filesystem disk,
- `$dir` - directory relative to the root of the disk.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CityResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

BelongsToMany::make('Cities', resource: CityResource::class)
    ->withImage('thumb', 'public', 'countries')->selectMode()
```

![with_image](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_image.png#light)
![belongs_to_image_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/belongs_to_image_dark.png#dark)

<a name="buttons"></a>
## Buttons

The `buttons()` method allows you to add additional buttons to the `BelongsToMany` field.

```php
buttons(array $buttons)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\UI\Components\ActionButton;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->buttons([
        ActionButton::make('Check all', '')
            ->onClick(fn() => 'checkAll', 'prevent'),

        ActionButton::make('Uncheck all', '')
            ->onClick(fn() => 'uncheckAll', 'prevent')
    ])
```

### withCheckAll

The `withCheckAll()` method allows you to add a checkAll button to the `BelongsToMany` field, similar to the previous example.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;

BelongsToMany::make('Categories', resource: CategoryResource::class)
    ->withCheckAll()
```
