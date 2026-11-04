# Json

- [Basics](#basics)
- [Field Set](#fields)
- [Vertical Mode](#vertical)
- [Key/Value Mode](#key-value)
- [Only Value Mode](#only-value)
- [Object Mode](#object)
- [Nested Json](#nested)
- [Table Preview](#table-preview)
- [Adding/Removing](#creatable-removable)
- [Buttons](#buttons)
- [Modifiers](#modify)
- [Drag-and-Drop Sorting](#reorderable)
- [Empty Message](#empty-message)
- [Using in Filters](#filter)
- [Filtering "Empty" Values](#filter-empty)
- [Default Value](#default)
- [Blade Usage](#blade-usage)

---

<a name="basics"></a>

## Basics

Contains all [Basic methods](/docs/{{version}}/fields/basic-methods).

The `Json` field is designed for columns that store an array of objects.
The object schema is defined with the `fields()` method, and each UI row corresponds to one object in the array.

@include('_includes/note-about-multiple-cast')

<a name="fields"></a>

## Field Set

The `fields()` method defines the fields that will be displayed in each `Json` row.

```php
fields(FieldsContract|Closure|iterable $fields, string $orientation = 'horizontal')
```

- `$fields` - a set of fields.
- `$orientation` - field layout inside the row: `horizontal` or `vertical`.

Example:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
```

For the field above, data is stored as an array of objects:

```json
[
    {
        "title": "Title 1",
        "value": "Value 1"
    },
    {
        "title": "Title 2",
        "value": "Value 2"
    }
]
```

<a name="vertical"></a>

## Vertical Mode

Vertical mode changes the layout of fields inside each `Json` row: fields are displayed one below another instead of in one line.
This is useful for long values, Textarea, Select with many options, and nested components.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ], orientation: 'vertical')
```

You can also use the `vertical()` method:

```php
vertical(bool $condition = true)
```

When called without arguments, the method enables vertical mode. If `false` is passed, the field returns to horizontal layout.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Json;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
    ->vertical()
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Json;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ], orientation: 'vertical')
    ->vertical(false)
```

<a name="key-value"></a>

## Key/Value Mode

The `keyValue()` method is used for JSON objects where the key is stored as a property name and the value is stored as that property's value.

```php
keyValue(
    string|FieldContract $key = 'Key',
    string|FieldContract $value = 'Value',
    ?FieldContract $keyField = null,
    ?FieldContract $valueField = null,
    string $orientation = 'horizontal',
)
```

By default, text fields are created for the key and value:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Json;

Json::make('Contacts', 'contacts')
    ->keyValue()
```

If you need to replace the key or value fields, pass your own fields:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;

Json::make('Contacts', 'contacts')
    ->keyValue(
        keyField: Select::make('Key')
            ->options([
                'vk' => 'VK',
                'email' => 'E-mail',
            ]),
        valueField: Text::make('Value'),
    )
```

<a name="only-value"></a>

## Only Value Mode

The `onlyValue()` method is used for JSON arrays where each row is stored as a separate value without an object.

```php
onlyValue(string $value = 'Value', ?FieldContract $valueField = null)
```

- `$value` - the field label. Used for the default `Text` field.
- `$valueField` - the value field, if you need to replace `Text` with another field.

Example:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Json;

Json::make('Tags', 'tags')
    ->onlyValue()
```

Data will be stored as a JSON array of values:

```json
[
    "lorem",
    "ipsum"
]
```

If you need to replace the value field, pass `$valueField`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Select;

Json::make('Contacts', 'contacts')
    ->onlyValue(
        valueField: Select::make('Type')
            ->options([
                'vk' => 'VK',
                'email' => 'E-mail',
            ]),
    )
```

<a name="object"></a>

## Object Mode

By default, `Json` works with an array of objects. The `object()` method is used when the column should store a single JSON object, for example `{"title": "Title", "active": false}`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

Json::make('Settings', 'settings')
    ->fields([
        Text::make('Title'),
        Switcher::make('Active'),
    ])
    ->object()
```

When `object()` is used, rows cannot be added or removed. The UI displays only the values defined through `fields()`.

<a name="nested"></a>

## Nested Json

You can use another `Json` field inside `Json` when you need to describe a more complex data structure.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;

Json::make('Products', 'products')
    ->fields([
        Text::make('Name', 'name'),
        Json::make('Prices', 'prices')
            ->fields([
                Number::make('Wholesale price', 'wholesale_price'),
                Number::make('Retail price', 'retail_price'),
            ])
            ->object(),
    ])
```

Data will be stored with a nested object:

```json
[
    {
        "name": "product 1",
        "prices": {
            "wholesale_price": 1000,
            "retail_price": 1200
        }
    }
]
```

<a name="table-preview"></a>

## Table Preview

By default, the `Json` field preview is displayed as a read-only list where each field label is shown next to its value.
The `table()` method switches the field to `preview` mode and displays the value as a read-only table.

```php
table(bool $condition = true)
```

Example:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Products', 'products')
    ->fields([
        Text::make('Name'),
        Json::make('Links')
            ->fields([
                Text::make('Label'),
                Text::make('Url'),
            ]),
    ])
    ->table()
```

The field will be displayed as a table where `Name` and `Links` are table headers.

You can also enable table preview only for a nested `Json` field:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Products', 'products')
    ->fields([
        Text::make('Name'),
        Json::make('Links')
            ->fields([
                Text::make('Label'),
                Text::make('Url'),
            ])
            ->table(),
    ])
```

<a name="creatable-removable"></a>

## Adding/Removing

Rows can be added and removed by default.
The `creatable()` method controls adding new rows, and `removable()` controls removing existing rows.

```php
creatable(
    Closure|bool|null $condition = null,
    ?int $limit = null,
    ?ActionButtonContract $button = null,
    bool $hideButton = false,
)
```

- `$condition` - the condition under which adding rows is available.
- `$limit` - the maximum number of rows.
- `$button` - a custom add button.
- `$hideButton` - hides the add button without disabling the ability to add rows at the field level.

If `$limit` is specified, the add button remains visible but becomes disabled when the limit is reached.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
    ->creatable(limit: 6)
```

Customizing the add button:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->keyValue()
    ->creatable(
        button: ActionButton::make('New')->primary()
    )
```

Hiding the add button:

```php
Json::make('Data')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
    ->creatable(hideButton: true)
```

The `removable()` method controls displaying the row remove button.

```php
removable(
    Closure|bool|null $condition = null,
    array $attributes = [],
)
```

- `$condition` - the condition under which removing rows is available.
- `$attributes` - HTML attributes for the remove button.

With `removable(false)`, users can add new rows but cannot remove existing rows.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
    ->removable(false)
```

HTML attributes for the remove button:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Data', 'data.content')
    ->fields([
        Text::make('Title'),
        Image::make('Image'),
        Text::make('Value'),
    ])
    ->removable(attributes: ['@click.prevent' => 'customAsyncRemove'])
    ->creatable()
```

<a name="buttons"></a>

## Buttons

The `buttons()` method allows you to override the buttons used in field rows.
By default, only the remove button is available.

```php
buttons(array $buttons)
```

Example:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:5]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Data', 'data.content')
    ->fields([
        Text::make('Title'),
        Image::make('Image'),
        Text::make('Value'),
    ])
    ->buttons([
        ActionButton::make('')
            ->icon('trash')
            ->onClick(fn() => 'remove()', 'prevent')
            ->secondary()
            ->showInLine(),
    ])
```

<a name="modify"></a>

## Modifiers

The `Json` field allows you to modify buttons in `preview` or `default` modes without replacing them completely.
For table preview, a table modifier is also available.

### Add Button Modifier

The `modifyCreateButton()` method allows you to modify the add button.

```php
/**
 * @param Closure(ActionButton $button, self $field): ActionButton $callback
 */
modifyCreateButton(Closure $callback)
```

Example:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->creatable()
    ->modifyCreateButton(
        fn(ActionButton $button): ActionButton => $button->customAttributes([
            'class' => 'btn-primary',
        ])
    )
```

### Remove Button Modifier

The `modifyRemoveButton()` method allows you to modify the remove button.

```php
/**
 * @param Closure(ActionButton $button, self $field): ActionButton $callback
 */
modifyRemoveButton(Closure $callback)
```

Example:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->modifyRemoveButton(
        fn(ActionButton $button): ActionButton => $button->customAttributes([
            'class' => 'btn-secondary',
        ])
    )
```

### Table Modifier

The `modifyTable()` method allows you to modify the `TableBuilder` table when the `Json` field is displayed in preview mode.
The method is applied only for table preview, meaning when the field is rendered through `preview()` or `previewMode()` and the `table()` method is enabled.

```php
/**
 * @param Closure(TableBuilder $table, bool $preview): TableBuilder $callback
 */
modifyTable(Closure $callback)
```

Example:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->table()
    ->modifyTable(
        fn(TableBuilder $table, bool $preview): TableBuilder => $table->customAttributes([
            'style' => 'width: 20%;',
        ])
    )
```

You can also use compatible `TableBuilder` settings supported by the current table template:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->table()
    ->modifyTable(
        fn(TableBuilder $table): TableBuilder => $table
            ->simple()
            ->sticky()
    )
```

`trAttributes()` and `tdAttributes()` are available for rows and cells:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->table()
    ->modifyTable(
        fn(TableBuilder $table): TableBuilder => $table
            ->trAttributes(fn(): array => ['style' => 'background: red'])
            ->tdAttributes(fn(): array => ['style' => 'background: blue'])
    )
```

<a name="reorderable"></a>

## Drag-and-Drop Sorting

Drag-and-drop row sorting is disabled by default.

The `reorderable()` method controls displaying the row drag handle.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
    ->reorderable()
```

To explicitly disable drag-and-drop sorting, pass `false`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
    ->reorderable(false)
```

<a name="empty-message"></a>

## Empty Message

When the `Json` field has no rows, an empty block is displayed in the interface.
The `emptyMessage()` method controls the text inside this block.

```php
emptyMessage(string $message)
```

Example:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
    ->emptyMessage('No options added')
```

Nested `Json` fields can have a separate message:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Products', 'products')
    ->fields([
        Text::make('Name'),
        Json::make('Links')
            ->fields([
                Text::make('Label'),
                Text::make('Url'),
            ])
            ->emptyMessage('No links added'),
    ])
```

<a name="filter"></a>

## Using in Filters

If the field is used in filters, enable filter mode with the `filterMode()` method.
It adapts the field behavior for filters and disables adding new rows.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Data')
    ->fields([
        Text::make('Title', 'title'),
        Text::make('Value', 'value'),
    ])
    ->filterMode()
```

For nested `Json`, filter mode is set separately:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Data')
    ->fields([
        Text::make('Title', 'title'),
        Json::make('Links', 'links')
            ->fields([
                Text::make('Label', 'label'),
                Text::make('Url', 'url'),
            ])
            ->filterMode(),
    ])
```

<a name="filter-empty"></a>

## Filtering "Empty" Values

By default, the `Json` field filters all empty values, but this behavior can be disabled.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Json;

Json::make('Data', 'data')
    ->stopFilteringEmpty()
```

<a name="default"></a>

## Default Value

As with other fields, the default value is set with the `default()` method.
For `Json`, pass an array of objects.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
    ->default([
        [
            'title' => 'Default title',
            'value' => 'Default value',
        ],
    ])
```

<a name="blade-usage"></a>

## Blade Usage

The field component can be used directly in Blade templates:

```bladehtml
<x-moonshine::json
    input-name="options"
    empty-message="No options added"
    :rows="[
        [
            'title' => 'Title 1',
            'value' => 'Value 1',
        ],
    ]"
    :fields="[
        [
            'column' => 'title',
            'label' => 'Title',
            'type' => 'text',
            'placeholder' => 'Title',
        ],
        [
            'column' => 'value',
            'label' => 'Value',
            'type' => 'text',
            'placeholder' => 'Value',
        ],
    ]"
/>
```

Available attributes:

```bladehtml
<x-moonshine::json
    :rows="$rows"
    :fields="$fields"
    :controls="$controls"
    :input-name="$inputName"
    :removable="$removable"
    :creatable="$creatable"
    :creatable-limit="$creatableLimit"
    :hide-create-button="$hideCreateButton"
    :create-button="$createButton"
    :buttons="$buttons"
    :remove-button="$removeButton"
    :remove-button-attributes="$removeButtonAttributes"
    :reorderable="$reorderable"
    :orientation="$orientation"
    :key-value="$keyValue"
    :only-value="$onlyValue"
    :object-mode="$objectMode"
    :filter-empty="$filterEmpty"
    :empty-message="$emptyMessage"
/>
```
