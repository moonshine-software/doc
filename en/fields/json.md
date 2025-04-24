# Json

- [Basics](#basics)
- [Field Set](#fields)
- [Key/Value Mode](#key-value)
- [Only Value Mode](#only-value)
- [Object Mode](#object-mode)
- [Nested Json](#nested)
- [Default Value](#default)
- [Filtering Empty](#filtering-empty)
- [Creatable/Removable](#creatable-removable)
- [Vertical Mode](#vertical)
- [Applying in Filters](#filter)
- [Buttons](#buttons)
- [Modifiers](#modify)

---

<a name="basics"></a>
## Basics

Contains all [Basic methods](/docs/{{version}}/fields/basic-methods).

The `Json` field is designed for convenient work with the json data type.
In most cases, it is used with arrays of objects via `TableBuilder`, but it also supports a mode for working with a single object.

@include('_includes/note-about-multiple-cast')

<a name="fields"></a>
## Field Set

Assume that the structure of your json looks like this:

```json
[{"title": "title", "value": "value", "active": true}]
```

This is a set of objects with fields "title", "value" and "active".
To specify such a set of fields, the `fields()` method is used.

```php
fields(FieldsContract|Closure|iterable $fields)
```

Example:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Position;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Position::make(),
        Text::make('Title'),
        Text::make('Value'),
        Switcher::make('Active'),
    ])
```

![json_fields](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_fields.png#light)
![json_fields_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_fields_dark.png#dark)

Fields can also be passed through a closure, allowing access to the field's context and its data.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Position;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields(
        static fn(Json $ctx) => $ctx->getData()->getOriginal()->is_active ? [
            Position::make(),
            Text::make('Title'),
            Text::make('Value'),
            Switcher::make('Active')
        ] : [
            Text::make('Title')
        ]
    )
```

<a name="key-value"></a>
## Key/Value Mode

When your data has a key/value structure, like in the following example `{"key": "value"}`, the `keyValue()` method is used.

```php
keyValue(
    string $key = 'Key',
    string $value = 'Value',
    ?FieldContract $keyField = null,
    ?FieldContract $valueField = null,
)
```

- `$key` — the label for the "key" field,
- `$value` — the label for the "value" field,
- `$keyField` — the option to replace the "key" field with your own (default is `Text`),
- `$valueField` — the option to replace the "value" field with your own (default is `Text`).

Example:

```php
Json::make('Data')
    ->keyValue()
```

![json_key_value](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_key_value.png#light)
![json_key_value_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_key_value_dark.png#dark)

Example with changing field types:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;

Json::make('Label', 'data')
    ->keyValue(
        keyField: Select::make('Key')
            ->options(['vk' => 'VK', 'email' => 'E-mail']),
        valueField: Text::make('Value'),
    )
```

<a name="only-value"></a>
## Only Value Mode

If you need to store only values, like in the example `["value_1", "value_2"]`, the `onlyValue()` method is used.

```php
onlyValue(
    string $value = 'Value',
    ?FieldContract $valueField = null,
)
```

- `$value` - the label for the "value" field,
- `$valueField` - the option to replace the "value" field with your own (default is `Text`).

Example:

```php
Json::make('Data')
    ->onlyValue()
```

![json_only_value](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_only_value.png#light)
![json_only_value_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_only_value_dark.png#dark)

<a name="object-mode"></a>
## Object Mode

In most cases, the `Json` field works with an array of objects via `TableBuilder`.
However, it is also possible to work with an object, for example, `{"title": "Title", "active": false}`.
For this, the `object()` method is used.

Example:

```php
Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Switcher::make('Active'),
    ])
    ->object()
```

<a name="nested"></a>
## Nested Json

To create more complex structures, you may need to use the nested fields `Json` and **MoonShine** this allows.

Example:

```php
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

Result:

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

<a name="default"></a>
## Default Value

As in other fields, there is an option to specify a default value using the `default()` method.
In this case, an array must be provided.

```php
default(mixed $default)
```

Example:

```php
Json::make('Data')
    ->keyValue('Key', 'Value')
    ->default([
        [
            'key' => 'Default key',
            'value' => 'Default value',
        ]
    ]),

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
        Switcher::make('Active'),
    ])
    ->default([
        [
            'title' => 'Default title',
            'value' => 'Default value',
            'active' => true,
        ]
    ]),

Json::make('Values')
    ->onlyValue()
    ->default([
        ['value' => 'Default value']
    ])
```

<a name="filtering-empty"></a>
## Filtering Empty

By default, `Json` field filters all empty values, but this behavior can be disabled.

```php
Json::make('data')->stopFilteringEmpty()
```

<a name="creatable-removable"></a>
## Creatable/Removable

By default, the `Json` field contains only one element.
The `creatable()` method allows adding new elements, while `removable()` enables their removal.

```php
creatable(
    Closure|bool|null $condition = null,
    ?int $limit = null,
    ?ActionButtonContract $button = null,
)
```

- `$condition` - condition under which the method should be applied,
- `$limit` - limit on the number of possible elements,
- `$button` - option to replace the add button with your own.

```php
removable(
    Closure|bool|null $condition = null,
    array $attributes = [],
)
```

- `$condition` - condition under which the method should be applied,
- `$attributes` - HTML attributes for the remove button.

Example:

```php
Json::make('Data')
    ->keyValue()
    ->creatable(limit: 6)
    ->removable()
```

![json_removable](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_removable.png#light)
![json_removable_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_removable_dark.png#dark)

### Customizing the Add Button

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->keyValue()
    ->creatable(
        button: ActionButton::make('New')->primary()
    )
```

### HTML Attributes for the Remove Button

```php
Json::make('Data', 'data.content')
    ->fields([
        Text::make('Title'),
        Image::make('Image'),
        Text::make('Value'),
    ])
    ->removable(attributes: ['@click.prevent' => 'customAsyncRemove'])
    ->creatable()
```

<a name="vertical"></a>
## Vertical Mode

The `vertical()` method allows changing the display of the table from horizontal mode to vertical.

Example:

```php
Json::make('Data')
    ->vertical()
```

![json_vertical](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_vertical.png#light)
![json_vertical_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_vertical_dark.png#dark)

<a name="filter"></a>
## Application in Filters

If the field is used in filters, the filtering mode must be enabled using the `filterMode()` method.
This method adapts the field's behavior for filtering and disables the ability to add new elements.

```php
Json::make('Data')
    ->fields([
        Text::make('Title', 'title'),
        Text::make('Value', 'value')
    ])
    ->filterMode()
```

<a name="buttons"></a>
## Buttons

The `buttons()` method allows overriding the buttons used in the field.
By default, only the remove button is available.

```php
buttons(array $buttons)
```

Example:

```php
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
            ->showInLine()
    ])
```

<a name="modify"></a>
## Modifiers

The `Json` field provides the ability to modify buttons or the table in "preview" or "default" modes, instead of completely replacing them.

### Remove Button Modifier

The `modifyRemoveButton()` method allows changing the remove button.

```php
/**
 * @param  Closure(ActionButton $button, self $field): ActionButton  $callback
 */
modifyRemoveButton(Closure $callback)
```

Example:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->modifyRemoveButton(
        fn(ActionButton $button) => $button->customAttributes([
            'class' => 'btn-secondary'
        ])
    )
```

### Create Button Modifier

The `modifyCreateButton()` method allows changing the create button.

```php
/**
 * @param  Closure(ActionButton $button, self $field): ActionButton  $callback
 */
modifyCreateButton(Closure $callback)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->creatable()
    ->modifyCreateButton(
        fn(ActionButton $button) => $button->customAttributes([
            'class' => 'btn-primary'
        ])
    )
```

### Table Modifier

The `modifyTable()` method allows modifying the table (`TableBuilder`) for all visual modes of the field.

```php
/**
 * @param  Closure(TableBuilder $table, bool $preview): TableBuilder $callback
 */
modifyTable(Closure $callback)
```

Example:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->modifyTable(
        fn(TableBuilder $table, bool $preview) => $table->customAttributes([
            'style' => 'width: 50%;'
        ])
    )
```
