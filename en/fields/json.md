https://moonshine-laravel.com/docs/resource/fields/fields-json?change-moonshine-locale=en

------
## Json
  - [Basics](#basics)
  - [Key/Value](#key-value)
  - [With a set of fields](#fields)
  - [Meaning only](#value-only)
  - [Default value](#default)
  - [Add/Remove](#creatable-removable)
  - [Nested values](#nesting)
  - [Relationships via Json](#relation)
  - [Filter](#filter)
  - [Buttons](#buttons)
  - [Modify](#modify)

<a name="basics"></a>
### Basics
The *Json* field includes all the base methods.

*Json* has several methods to set the field structure:  
`keyValue()`, `onlyValue()` and `fields()`.

> [!NOTE]
> In the database, the field must be of text or json type. Also cast eloquent of an array or json or collection model.

<a name="key-value"></a>
### Key/Value

The easiest way to work with a *Json* field is to use the `keyValue()` method.
The result will be a simple json `{key: value}`.

```php
keyValue(
    string $key = 'Key',
    string $value = 'Value'
)
```

```php
use MoonShine\Fields\Json; 
 
//...
 
public function fields(): array
{
    return [
        Json::make('Data') 
            ->keyValue() 
    ];
}
 
//...
```

![json_key_value](https://moonshine-laravel.com/screenshots/json_key_value.png)
![json_key_value_dark](https://moonshine-laravel.com/screenshots/json_key_value_dark.png)

The default keys and values are the *Text* field, but you can use other fields for primitive data.

```php
use MoonShine\Fields\Json; 
use MoonShine\Fields\Select;
 
//...
 
public function fields(): array
{
    return [
        Json::make('Label', 'data')->keyValue(
            keyField: Select::make('Key')->options(['vk' => 'VK', 'email' => 'E-mail']),
            valueField: Select::make('Value')->options(['1' => '1', '2' => '2']),
        ), 
    ];
}
 
//...
```

<a name="fields"></a>
### With a set of fields

For more advanced use, use the `fields()` method and pass the required set of fields.
As a result, the following json will be generated:  
`[{title: 'title', value: 'value', active: 'active'}]`

```php
fields(Fields|Closure|array $fields)
```

```php
use MoonShine\Fields\Json; 
use MoonShine\Fields\Position; 
use MoonShine\Fields\Switcher; 
use MoonShine\Fields\Text; 
 
//...
 
public function fields(): array
{
    return [
        Json::make('Product Options', 'options') 
            ->fields([
                Position::make(),
                Text::make('Title'),
                Text::make('Value'),
                Switcher::make('Active')
            ]) 
    ];
}
 
//...
```

![json_fields](https://moonshine-laravel.com/screenshots/json_fields.png)
![json_fields_dark](https://moonshine-laravel.com/screenshots/json_fields_dark.png)

<a name="value-only"></a>
### Meaning only

Sometimes you only need to store values in the database. To do this, you can use the `onlyValue()` method. The result will be json `['value']`.

```php
onlyValue(string $value = 'Value')
```

```php
use MoonShine\Fields\Json; 
 
//...
 
public function fields(): array
{
    return [
        Json::make('Data') 
            ->onlyValue() 
    ];
}
 
//...
```

![json_only_value](https://moonshine-laravel.com/screenshots/json_only_value.png)
![json_only_value_dark](https://moonshine-laravel.com/screenshots/json_only_value_dark.png)

<a name="default"></a>
### Default value
You can use the `default()` method if you need to specify a default value for a field.

```php
default(mixed $default)
```

```php
use MoonShine\Fields\Json;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Json::make('Data')
            ->keyValue('Key', 'Value')
            ->default([
                [
                    'key' => 'Default key',
                    'value' => 'Default value'
                ]
            ]),

        Json::make('Product Options', 'options')
            ->fields([
                Text::make('Title'),
                Text::make('Value'),
                Switcher::make('Active')
            ])
            ->default([
                [
                    'title' => 'Default title',
                    'value' => 'Default value',
                    'active' => true
                ]
            ]),

        Json::make('Values')
            ->onlyValue()
            ->default([
                ['value' => 'Default value']
            ])
    ];
}

//...
```

<a name="creatable-removable"></a>
### Add/Remove

By default, the *Json* field contains only one entry. The `creatable()` method allows you to add entries, and the `removable()` method allows you to remove existing ones.

```php
creatable(
    Closure|bool|null $condition = null,
    ?int $limit = null,
    ?ActionButton $button = null
)
```

-`$condition` - method execution condition,
-`$limit` - number of records that can be added,
-`$button` - custom add button.

```php
removable(
    Closure|bool|null $condition = null,
    array $attributes = []
)
```

-`$condition` - condition for executing the method,
-`$attributes` - additional button attributes.

```php
use MoonShine\Fields\Json;
 
//...
 
public function fields(): array
{
    return [
        Json::make('Data')
            ->keyValue()
            ->creatable(limit: 6) 
            ->removable() 
    ];
}
 
//...
```

![json_removable](https://moonshine-laravel.com/screenshots/json_removable.png)
![json_removable_dark](https://moonshine-laravel.com/screenshots/json_removable_dark.png)

###Custom add button

```php
use MoonShine\Fields\Json;
 
//...
 
public function fields(): array
{
    return [
        Json::make('Data')
            ->keyValue()
            ->creatable(
                button: ActionButton::make('New', '#')->primary()
            ) 
    ];
}
 
//...
```

###Attributes for the delete button

```php
use MoonShine\Fields\Json;
 
//...
 
public function fields(): array
{
    return [
        Json::make('Data', 'data.content')->fields([
            Text::make('Title'),
            Image::make('Image'),
            Text::make('Value'),
        ])
            ->removable(attributes: ['@click.prevent' => 'customAsyncRemove']) 
            ->creatable()
    ];
}
 
//...
```

<a name="nesting"></a>
### Nested values

You can get nested values of *JSON* fields using `.`.
Values can be edited, but the changes will not affect other keys.

 ```php
 {"info": [{"title": "Info title", "value": "Info value"}], "content": [{"title": "Content title", "value": "Content value"}]}
 ```
 
 ```php
 use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data', 'data.content')
            ->fields([
                Text::make('Title'),
                Text::make('Value'),
            ])->removable()
    ];
}

//...
 ```

<a name="vertical"></a>
### Vertical display

The `vertical()` method allows you to change the horizontal layout of the fields to vertical.

```php
vertical()
```

```php
use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data')
            ->keyValue()
            ->vertical()
    ];
}

//...
```
![json_vertical](https://moonshine-laravel.com/screenshots/json_vertical.png)
![json_vertical_dark](https://moonshine-laravel.com/screenshots/json_vertical_dark.png)

<a name="relation"></a>
### Relationships via Json

The *Json* field can work with relationships; the `asRelation()` method is used for this, to which you need to assign *ModelResource* relationships and specify an array of editable fields.

```php
asRelation(ModelResource $resource)
```

```php
use MoonShine\Fields\ID;
use MoonShine\Fields\Json;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Json::make('Comments', 'comments')
            ->asRelation(new CommentResource())
            ->fields([
                ID::make(),
                BelongsTo::make('Article')
                    ->setColumn('article_id')
                    ->searchable(),
                BelongsTo::make('User')
                    ->setColumn('user_id'),
                Text::make('Text')->required(),
            ])
            ->creatable()
            ->removable()
    ];
}
//...
```
>[!WARNING]
>For relationships, the presence of the ID field in the fields method is mandatory!

>[!WARNING]
>When using *BelongsTo* it is necessary to use the method `setColumn()` set a field in a database table!

![json_relation](https://moonshine-laravel.com/screenshots/json_relation.png)
![json_relation_dark](https://moonshine-laravel.com/screenshots/json_relation_dark.png)

<a name="filter"></a>
### Filter

If the field is used to build a filter, then you must use the `filterMode()` method. This method adapts the behavior of the field and sets `creatable = false`.

```php
use MoonShine\Fields\Json;
use MoonShine\Fields\Text;

//...

public function filters(): array
{
    return [
        Json::make('Data')
            ->fields([
                Text::make('Title', 'title'),
                Text::make('Value', 'value')
            ])
            ->filterMode()
    ];
}

//...
```

<a name="buttons"></a>
### Buttons

The `buttons()` method allows you to add additional buttons to the *Json* field.

```php
buttons(array $buttons)
```

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data', 'data.content')->fields([
            Text::make('Title'),
            Image::make('Image'),
            Text::make('Value'),
        ])->buttons([
            ActionButton::make('', '#')
                ->icon('heroicons.outline.trash')
                ->onClick(fn() => 'remove()', 'prevent')
                ->customAttributes(['class' => 'btn-secondary'])
                ->showInLine()
        ])
    ];
}

//...
```

<a name="#modify"></a>
### Modify

The *Json* field has methods with which you can modify the delete button or change *TableBuilder* for preview and form.

###modifyRemoveButton()

The `modifyRemoveButton()` method allows you to change the remove button.

```php
/**
 * @param  Closure(ActionButton $button, self $field): ActionButton  $callback
 */
modifyRemoveButton(Closure $callback)
```

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data')
            ->modifyRemoveButton(
                fn(ActionButton $button) => $button->customAttributes([
                    'class' => 'btn-secondary'
                ])
            )
    ];
}

//...
```

###modifyTable()

The `modifyTable()` method allows you to change the *TableBuilder* for the preview and form.

```php
/**
 * @param  Closure(TableBuilder $table, bool $preview): TableBuilder $callback
 */
modifyTable(Closure $callback)
```

```php
use MoonShine\Components\TableBuilder;
use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data')
            ->modifyTable(
                fn(TableBuilder $table, bool $preview) => $table->customAttributes([
                    'style' => 'width: 50%;'
                ])
            )
    ];
}

//...
```
