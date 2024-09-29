https://moonshine-laravel.com/docs/resource/advanced/advanced-table_builder?change-moonshine-locale=en

------
# TableBuilder

<a name="basics"></a>
## Basics

Fields and decorations in *MoonShine* are used inside tables in `preview` mode.<br/>
*TableBuilder* is responsible for tables.<br/>
Using *TableBuilder*, tables are displayed and filled with data.<br/>
You can also use *TableBuilder* on your own pages or even outside of **MoonShine**.<br/>

```php
TableBuilder::make(
    Fields|array $fields = [],
    Paginator|iterable $items = [],
    ?Paginator $paginator = null
)
```

-`$fields` - fields
-`$items` - field values
-`$paginator` - paginator object

```php
use MoonShine\Components\TableBuilder;

TableBuilder::make(
    [Text::make('Text')],
    [['text' => 'Value']]
)
```
Same thing through methods:

```php
TableBuilder::make()
    ->fields([Text::make('Text')])
    ->items([[ 'text' => 'Value' ]])
```


Helper `table()` is also available:

```php
{!!
    table()
        ->fields([Text::make('Text')])
        ->items([['text' => 'Value']])
!!}
```

## Text
###Value



<a name="fields"></a>
## Fields

The `fields()` method allows you to specify a list of fields to build a table:

```php
TableBuilder::make()
    ->fields([
        Text::make('Text'),
    ])
```

<a name="items"></a>
## Items

The `items()` method is used to fill the table with data:

```php
TableBuilder::make()
    ->fields([Text::make('Text')])
    ->items([[ 'text' => 'Value' ]])
```

> [!NOTE]
> The correspondence of data with fields is carried out through the value [column](https://moonshine-laravel.com/docs/resource/fields/fields-index#make) fields!




<a name="paginator"></a>
## Paginator

The `paginator()` method for the table to work with pagination:

```php
$paginator = Article::paginate();

TableBuilder::make()
    ->fields([Text::make('Text')])
    ->items($paginator->items())
    ->paginator($paginator)
```
Or directly pass the paginator:

```php
TableBuilder::make(
    items: Article::paginate()
)
    ->fields([Text::make('Text')])
```

The *TableBuilder* works with arrays of items;<br/>

if you don't have arrays, you need to cast the paginator to arrays:

```php
$paginator = Article::paginate();

TableBuilder::make()
    ->fields([Text::make('Text')])
    ->items($paginator->through(fn($item) => $item->toArray()))
    ->paginator($paginator)
```

Or you can use `cast()` method instead.

<a name="cast"></a>
## Casting

The `cast()` method is used to cast table values to a specific type.<br/>
Since by default fields work with primitive types:

```php
use MoonShine\TypeCasts\ModelCast;

TableBuilder::make(items: User::paginate())
    ->fields([Text::make('Email')])
    ->cast(ModelCast::make(User::class))
```

In this example, we cast the data to the `User` model format using `ModelCast`.


> [!NOTE]
> For more detailed information, please refer to the section [TypeCasts](https://moonshine-laravel.com/docs/resource/advanced/advanced-type_casts)


<a name="buttons"></a>
## Buttons

To add new buttons based on *ActionButton*, use the `buttons()` method.<br/>
Buttons will be added for each row, and when `bulk()` mode is enabled, they will be displayed in the footer for bulk actions:

```php
TableBuilder::make(items: Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->cast(ModelCast::make(Article::class))
    ->buttons([
        ActionButton::make('Delete', route('name.delete')),
        ActionButton::make('Edit', route('name.edit'))->showInDropdown(),
        ActionButton::make('Go to home', route('home'))->blank()->canSee(fn($data) => $data->active),
        ActionButton::make('Mass Delete', route('name.mass_delete'))->bulk()
    ])
```

<a name="async"></a>
## Asynchronous mode

If you need to receive data from the table asynchronously (during pagination, sorting), then use the `async()` method:

```php
async(
    ?string $asyncUrl = null,
    string|array|null $asyncEvents = null,
    ?string $asyncCallback = null
)
```
-`asyncUrl` - request url
-`asyncEvents` - events called after a successful request
-`asyncCallback` - js callback function after receiving a response

```php
TableBuilder::make()
    ->async('/async_url')
```

After a successful request, you can raise events by adding the `asyncEvents` parameter.

```php
TableBuilder::make()
        ->name('crud')
        ->async(asyncEvents: ['table-updated-crud', 'form-reset-main-form'])
```

**MoonShine** already has a set of ready-made events:
- `table-updated-{name}` - updating an asynchronous table by its name
- `form-reset-{name}` - reset the form values by its name
- `fragment-updated-{name}` - updating a blade fragment by its name


> [!NOTE]
> The `async()` method must come after the `name()` method!

<a name="attributes"></a>
## Attributes

You can set any html attributes for the table using the `customAttributes()` method:

```php
TableBuilder::make()
    ->customAttributes(['class' => 'custom-table'])
```
You can set any html attributes for table rows and cells:
```php
TableBuilder::make()
    ->trAttributes(function(
        mixed $data,
        int $row,
        ComponentAttributeBag $attributes
    ): ComponentAttributeBag {
        return $attributes->merge(['class' => 'bgc-green']);
    })
```
         


### Text
### Value
        
```php
TableBuilder::make()
    ->tdAttributes(
        function(
            mixed $data,
            int $row,
            int $cell,
            ComponentAttributeBag $attributes
        ): ComponentAttributeBag {
            return $attributes->merge(['class' => 'bgc-red']);
        }
    )
```

### Text
### Value 

<a name="notfound"></a>
### Missing elements

By default, if the table has no data, it will be empty, but you can display the message *"No records yet"*.<br/>
To do this, use the `withNotFound()` method:

```php
TableBuilder::make()
    ->withNotFound()
```

### Records not found

<a name="simple"></a>
### Simplified style

By default, the table is styled as MoonShine,<br/>
but using the `simple()` method you can display the table in a simplified style:

```php
TableBuilder::make()
    ->simple()
```

### Text	
### Value

<a name="sticky"></a>
### Sticky head

The `sticky()` method allows you to fix the header when scrolling a table with a large number of elements.

```php
TableBuilder::make()
    ->sticky()
```

<a name="preview"></a>
### Preview

The `preview()` method disables the display of buttons and sorts for the table:

```php
TableBuilder::make()
    ->preview()
```

<a name="vertical"></a>
### Vertical mode

Using the `vertical()` method you can display the table in vertical mode:

```php
TableBuilder::make()
    ->vertical()
```


### Property 1
### Value 1
### Property 2
### Value 2


<a name="creatable"></a>
### Adding entries

Using the `creatable()` method, you can create an "Add" button to generate new records in the table:


```php
creatable(
    bool $reindex = true,
    ?int $limit = null,
    ?string $label = null,
    ?string $icon = null,
    array $attributes = [],
    ?ActionButton $button = null
)
```

-`$reindex` - editing mode with dynamic name,
-`$limit` - the number of records that can be added
-`$label` - button name
-`$icon` - button icon
-`$attributes` - additional attributes
-`$button` - custom add button.






```
TableBuilder::make()
    ->creatable(
        icon: 'heroicons.outline.pencil',
        attributes: ['class' => 'my-class']
    )
    ->fields([
        Text::make('Title'),
        Text::make('Text')
    ])->items([
        ['title' => 'Value 1', 'text' => 'Value 2'],
        ['title' => '', 'text' => '']
    ])

```

### Title	Text	
### Value 1	Value 2

> [!NOTE]
> In append mode, the last element must be empty (the skeleton of the new entry)!

### reindex

If the table contains fields in edit mode with a dynamic name,
then you need to add a method or parameter `reindex`:

```php
TableBuilder::make()
    ->creatable(reindex: true)
```

or

```php
TableBuilder::make()
    ->creatable()
    ->reindex()
```

### limit

If you want to limit the number of records that can be added, you must specify the `limit` parameter:
```php
TableBuilder::make()
    ->creatable(limit: 6)
```
### Custom add button
```php
TableBuilder::make()
    ->creatable(
        button: ActionButton::make('Foo', '#')
    )
```

<a name="editable"></a>
### Editable

By default, fields in the table are displayed in `preview` mode,<br/>
but if you want to display them as editable form elements,<br/>
then you need to use the `editable()` method:

```php
TableBuilder::make()
    ->editable()
```
### Title	Text	
### Value 1
### Value 2

<a name="sortable"></a>
### Sortable

To sort rows in a table, use the `sortable()` method:
```php
TableBuilder::make()
    ->sortable(
        url: '/update_indexes_endpoint',
        key: 'id',
        group: 'nested'
    )
```



-`$url` - url handler
-`$key` - element key
-`$group` - grouping.


```php
TableBuilder::make()
    ->sortable(
        url: '/update_indexes_endpoint',
        key: 'id',
        group: 'nested'
    )
```
### Title	Text	
### Value 1	Value 2	
### Value 3	Value 4

<a name="column-display"></a>
### Column display 

You can let users decide which columns to display in the table, saving the choice.<br/>
To do this, you need to set the resource parameter `$columnSelection`.

```php
columnSelection(string $uniqueId = '')
```

-`$uniqueId` - unique table Id to save the selection of displayed columns.

```php
TableBuilder::make()
    ->fields([
        Text::make('Title'),
        Text::make('Text')
    ])
    ->columnSelection('unique-id')
```
### Title	Text	
### Value 3	Value 4	
### Value 1	Value 2

If you need to exclude fields from selection, use the `columnSelection()` method.

```php
public function columnSelection(bool $active = true)
```

```php
TableBuilder::make()
    ->fields([
        Text::make('Title')
            ->columnSelection(false),
        Text::make('Text')
    ])
    ->columnSelection('unique-id')

```


### Title	Text	
### Value 1	Value 2	
### Value 3	Value 4	

