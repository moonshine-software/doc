# Basics

- [Make](#make)
- [Formatting a value](#formatted)
- [Label](#label)
- [Attributes](#attributes)
- [Alpine.js](#alpinejs)
- [Clue](#hint)
- [Link](#link)
- [Nullable](#nullable)
- [Sorting](#sortable)
- [Badge](#badge)
- [Horizontal](#horizontal)
- [Display](#hide-show)
- [Dynamic display](#show-when)
- [Changing the display](#custom-view)
- [Methods by condition](#when-unless)
- [Filling](#fill)
- [Apply](#apply)
- [Events](#events)
- [Assets](#assets)
- [Wrapper](#wrapper)
- [Reactive](#reactive)
- [onChange methods](#on-change)
- [Methods for values](#for-value)
- [Scheme field's work](#scheme)

---

Fields play a vital role in the **MoonShine** admin panel.  
They are used in `FormBuilder` to build forms, in `TableBuilder` to create tables, as well as in forming a filter for `ModelResource`. They can be used in your custom pages and even outside the admin panel.  
Fields in **MoonShine** are not tied to the model (except Slug field, ModelRelationFields, Json in asRelation mode), therefore, the range of their applications is limited only by your imagination.  

For convenience, fields have *fluent interface*.

<a name="make"></a>
## Make

To create an instance of a field, use static method `make()`.

```php
Text::make(Closure|string|null $label = null, ?string $column = null, ?Closure $formatted = null)
```

- `$label` - label, field title,
- `$column` - a field in the database (for example name) or a relation (for example countries),
- `$formatted` - closure for formatting the field value during preview (everywhere except the form).

> [!NOTE]
> If you do not specify `$column`, then the field in the database will be determined automatically based on `$label`.

<a name="formatted"></a>
## Value formatting

```php
//...

public function fields(): array
{
    return [
        Text::make(
            'Name',
            'first_name',
            fn($item) => $item->first_name . ' ' . $item->last_name
        )
    ];
}

//...
```

> [!WARNING]
> Fields that do not support _formatted_: `Json`, `File`, `Range`, `RangeSlider`, `DateRange`, `Select`, `Enum`, `HasOne`, `HasMany`.

<a name="label"></a>
## Label

If you need to change the _Label_, you can use the `setLabel()` method

```php
setLabel(Closure|string $label)
```

```php
//...

public function fields(): array
{
    return [
        Slug::make('Slug')
            ->setLabel(
                fn(Field $field) => $field->getData()?->exists
                    ? 'Slug (do not change)'
                    : 'Slug'
            )
    ];
}

//...
```

To translate *Label* you need to pass the translation key as the name and add `translatable()` method

```php
translatable(string $key = '')
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')->translatable('ui')
    ];
}

//...
```

or

```php
//...

public function fields(): array
{
    return [
        Text::make('ui.Title')->translatable()
    ];
}

//...
```

<a name="attributes"></a>
## Attributes

Basic html attributes such as `required`, `disabled` and `readonly`, must be specified by the appropriate methods on the field.

```php
disabled(Closure|bool|null $condition = null)
```

```php
hidden(Closure|bool|null $condition = null)
```

```php
required(Closure|bool|null $condition = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->disabled()
            ->hidden()
            ->readonly()
    ];
}

//...
```

The ability to specify any other attributes using the `custom Attributes()` method.

```php
customAttributes(array $attributes)
```

```php
//...

public function fields(): array
{
    return [
        Password::make('Title')
            ->customAttributes(['autocomplete' => 'off'])
    ];
}

//...
```

Method `customWrapperAttributes()` allows you to add attributes for a _wrapper_ field.

```php
customWrapperAttributes(array $attributes)
```

```php
//...

public function fields(): array
{
    return [
        Password::make('Title')
            ->customWrapperAttributes(['class' => 'mt-8'])
    ];
}

//...
```

<a name="alpinejs"></a>
## Alpine.js

Methods that allow you to conveniently interact with Alpine.js

```php
xData(null|array|string $data = null)
```

Everything in Alpine starts with the `x-data` directive. The `xData` method defines an HTML fragment as an Alpine component and provides reactive data to reference that component.

```php
Block::make([])->xData(['title' = 'Hello world']) // title is a reactive variable inside
```

```php
xDataMethod(string $method, ...$parameters)
```

`x-data` indicating the component and its parameters

```php
Block::make([])->xDataMethod('some-component', 'var', ['foo' => 'bar'])
```

```php
xModel(?string $column = null)
```

`x-model` binding a field to a reactive variable

```php
Block::make([
    Text::make('Title')->xModel()
])->xData(['title' = 'Hello world'])

// or

Block::make([
    Text::make('Name')->xModel('title')
])->xData(['title' = 'Hello world'])
```

```php
xIf(
    string|Closure $variable,
    ?string $operator = null,
    ?string $value = null,
    bool $wrapper = true
)
```

`x-if` hides a field, removing it from the DOM

```php
Block::make([
    Select::make('Type')->native()->options([1 => 1, 2 => 2])->xModel(),
    Text::make('Title')->xModel()->xIf('type', 1)
])->xData(['title' = 'Hello world', 'type' => 1])

// or

Block::make([
    Select::make('Type')->options([1 => 1, 2 => 2])->xModel(),
    Text::make('Title')->xModel()->xIf(fn() => 'type==2||type.value==2')
])->xData(['title' = 'Hello world', 'type' => 1])

// if you need to hide a field without a container

Block::make([
    Select::make('Type')->native()->options([1 => 1, 2 => 2])->xModel(),
    Text::make('Title')->xModel()->xIf('type', '=', 2, wrapper: false)
])->xData(['title' = 'Hello world', 'type' => 1])
```

```php
xShow(
    string|Closure $variable,
    ?string $operator = null,
    ?string $value = null,
    bool $wrapper = true
)
```

`x-show` is the same as x-if, but does not remove the element from the DOM, it only hides it

```php
xDisplay(string $value, bool $html = true)
```

`x-html` output value

```php
Block::make([
    Select::make('Type')
        ->native()
        ->options([
            1 => 'Paid',
            2 => 'Free',
        ])
        ->xModel(),

    Number::make('Cost', 'price')
        ->xModel()
        ->xIf('type', '1'),

    Number::make('Rate', 'rate')
        ->xModel()
        ->xIf('type', '1')
        ->setValue(90),

    LineBreak::make(),

    Div::make()
        ->xShow('type', '1')
        ->xDisplay('"Result:" + (price * rate)')
    ,
])->xData([
    'price' => 0,
    'rate' => 90,
    'type' => '2',
]),
```

<a name="hint"></a>
## Clue

You can add a hint with a description to a field by calling method `hint()`

```php
hint(string $hint)
```

```php
//...

public function fields(): array
{
    return [
        Number::make('Rating')
            ->hint('From 0 to 5')
            ->min(0)
            ->max(5)
            ->stars()
    ];
}

//...
```

![hint](https://moonshine-laravel.com/screenshots/hint.png) ![hint_dark](https://moonshine-laravel.com/screenshots/hint_dark.png)

<a name="link"></a>
## Link

You can add a link to the field (for example, with instructions) `link()`.

```php
link(
    string|Closure $link,
    string|Closure $name = '',
    ?string $icon = null,
    bool $withoutIcon = false,
    bool $blank = false
)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Link')
            ->link('https://cutcode.dev', 'CutCode', blank: true)
    ];
}

//...
```

![link](https://moonshine-laravel.com/screenshots/link.png) ![link_dark](https://moonshine-laravel.com/screenshots/link_dark.png)

<a name="nullable"></a>
## Nullable

If you need to keep NULL for a field by default, you must use method `nullable()`.

```php
nullable(Closure|bool|null $condition = null)
```

```php
//...

public function fields(): array
{
    return [
        Password::make('Title')
            ->nullable()
    ];
}

//...
```

<a name="sortable"></a>
## Sorting

To be able to sort a field on the main resource page, you need to add method `sortable()`.

```php
sortable(Closure|string|null $callback = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->sortable()
    ];
}

//...
```

Method `sortable()` can take the name of a field in the database or a closure as a parameter.

```php
//...

public function fields(): array
{
    return [
        BelongsTo::make('Author')->sortable('author_id'),

        Text::make('Title')->sortable(function (Builder $query, string $column, string $direction) {
            $query->orderBy($column, $direction);
        })
    ];
}

//...
```

<a name="badge"></a>
## Badge

To display a field in preview mode as a *badge*, you need to use the `badge()` method.

```php
badge(string|Closure|null $color = null)
```

Available colors:

- primary 
- secondary 
- success 
- warning 
- error 
- info

- purple 
- pink 
- blue 
- green 
- yellow 
- red 
- gray

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->badge(fn($status, Field $field) => 'green')
    ];
}

//...
```

<a name="horizontal"></a>
## Horizontal display

The `horizontal()` method allows you to display the title and field horizontally.

```php
horizontal()
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->horizontal(),
    ];
}

//...
```

![horizontal](https://moonshine-laravel.com/screenshots/horizontal.png) ![horizontal_dark](https://moonshine-laravel.com/screenshots/horizontal_dark.png)

<a name="hide-show"></a>
##  Display

In a model resource, fields are displayed on the list page (main page) and on the create/edit/view pages.

To exclude the display of a field on any page, you can use the appropriate methods `hideOnIndex()`, `hideOnForm()`, `hideOnDetail()` or reverse methods `showOnIndex()`, `showOnForm()`, `showOnDetail()`.

To exclude only from the edit or add page - `hideOnCreate()`, `hideOnUpdate()`, as well as reverse `showOnCreate()`, `showOnUpdate`

In order to exclude a field on all pages, you can use the `hideOnAll()` method.

```php
hideOnIndex(Closure|bool|null $condition = null)
showOnIndex(Closure|bool|null $condition = null)
```

```php
hideOnForm(Closure|bool|null $condition = null)
showOnForm(Closure|bool|null $condition = null)

hideOnCreate(Closure|bool|null $condition = null)
showOnCreate(Closure|bool|null $condition = null)

hideOnUpdate(Closure|bool|null $condition = null)
showOnUpdate(Closure|bool|null $condition = null)
```

```php
hideOnDetail(Closure|bool|null $condition = null)
showOnDetail(Closure|bool|null $condition = null)
```

```php
hideOnAll(Closure|bool|null $condition = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->hideOnIndex()
            ->hideOnForm(),

        Switcher::make('Active')
            ->hideOnAll()
            ->showOnIndex(static fn() => true)
    ];
}

//...
```

> [!NOTE]
> If you just need to specify which fields to display on pages or change the order of display, then you can use a convenient method [field overrides](https://moonshine-laravel.com/docs/resource/models-resources/resources-fields#override).

<a name="show-when"></a>
## Dynamic display

It may be necessary to display a field only if the value of another field in the form has a certain value (for example: display the phone only if there is a checkmark that there is a phone).  
Method `showWhen()` is used for this purpose.

```php
showWhen(
    string $column,
    mixed $operator = null,
    mixed $value = null
)
```

Available operators:

`=` `<` `>` `<=` `>=` `!=` `in` `not` `in`

> [!NOTE]
> If operator is not specified, `=` will be used

```php
//...

public function fields(): array
{
    return [
        Checkbox::make('Has phone', 'has_phone'),
        Phone::make('Phone')
            ->showWhen('has_phone','=', 1)
    ];
}

//...
```
> [!NOTE]
> If the operator is `in` or `not in`, then in `$value` you need to pass an array, and the values as a string.

```php
//...

public function fields(): array
{
    return [
        Select::make('List', 'list')->multiple()->options([
            'value 1' => 'Option Label 1',
            'value 2' => 'Option Label 2',
            'value 3' => 'Option Label 3',
        ]),

        Text::make('Name')
            ->showWhen('list', 'not in', ['value 1', 'value 3']),

        Textarea::make('Content')
            ->showWhen('list', 'in', ['value 2', 'value 3'])
    ];
}

//...
```

In the `showWhen()` method for the *Json* and *BelongsToMany* fields You can access nested values via `.`:

```php
->showWhen('data.content.active', '=', 1)
```

<a name="custom-view"></a>
## Changing the display

When you need to change the view using *fluent interface* you can use the `customView()` method.

```php
customView(string $customView)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->customView('fields.my-custom-input')
    ];
}

//...
```

Method `changePreview()` allows you to override the view for the preview (everywhere except the form).

```php
changePreview(Closure $closure)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Thumbnail')
            ->changePreview(function ($value, Field $field) {
                return view('moonshine::ui.image', [
                    'value' => Storage::url($value)
                ]);
            })
    ];
}

//...
```

The `forcePreview()` method will indicate that the field should always be in preview mode

```php
Text::make('Label')->forcePreview()
```

The `requestValueResolver()` method allows you to override the logic for getting a value from Request

```php
requestValueResolver(Closure $closure)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Thumbnail')
            ->requestValueResolver(function (string $nameDot, mixed $default, Field $field) {
                return request($nameDot, $default);
            })
    ];
}

//...
```

`beforeRender()` and `afterRender()` methods allows you to display some information before and after the field, respectively.

```php
beforeRender(Closure $closure)
```

```php
afterRender(Closure $closure)
```

```php
//...

public function fields(): array
{
    return [
        Image::make('Thumbnail')
            ->beforeRender(function (Field $field) {
                return $field->preview();
            })
    ];
}

//...
```

<a name="when-unless"></a>
## Methods by condition

Method `when()` implements a *fluent interface* and executes callback when the first argument passed to the method is true.

```php
when($value = null, callable $callback = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Slug')
            ->when(fn() => true, fn(Field $field) => $field->locked())
    ];
}

//...
```
> [!NOTE]
> An instance of the field will be passed to the callback function.

The second callback can be passed to method `when()`, it will be executed, when the first argument passed to the method is false.

```php
when($value = null, callable $callback = null, callable $default = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Slug')
            ->when(
                auth('moonshine')->user()->moonshine_user_role_id === 1,
                fn(Field $field) => $field->locked(),
                fn(Field $field) => $field->readonly()
            )
    ];
}

//...
```

Method `unless()` is the inverse of method `when()` and will execute the first callback, when the first argument is false, otherwise the second callback will be executed if it is passed to the method.

```php
unless($value = null, callable $callback = null, callable $default = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Slug')
            ->unless(
                auth('moonshine')->user()->moonshine_user_role_id === 1,
                fn(Field $field) => $field->readonly()->hideOnCreate(),
                fn(Field $field) => $field->locked()
            )
    ];
}

//...
```

<a name="fill"></a>
## Filling

Fields can be filled with values using the `fill()` method.

```php
fill(mixed $value, mixed $casted = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->fill('Some title')
    ];
}

//...
```

The `changeFill()` method allows you to change the logic of filling a field with values.

```php
changeFill(mixed $value, mixed $casted = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Categories')
            ->changeFill(
                fn(Article $data, Field $field) => $data->categories->implode('title', ',')
            )
    ];
}

//...
```

> [!NOTE]
> Relationship fields do not support the `changeFill` method

<a name="apply"></a>
## Apply

Each field has an `apply()` method, which transforms the data taking into account the *request* and *resolve* methods. For example, it transforms model data for saving in a database or generates a query for filtering.

It is possible to override the actions when executing the `apply()` method, To do this, you need to use the `onApply()` method, which accepts a closure.

```php
onApply(Closure $onApply)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Thumbnail by link', 'thumbnail')
            ->onApply(function(Model $item, $value, Field $field) {
                $path = 'thumbnail.jpg';

                if ($value) {
                    $item->thumbnail = Storage::put($path, file_get_contents($value));
                }

                return $item;
            })
    ];
}

//...
```

> [!NOTE]
> If the field is used to build a filter, then a *Query Builder* will be passed to the closure.

```php
use Illuminate\Contracts\Database\Eloquent\Builder;

//...

public function filters(): array
{
    return [
        Switcher::make('Active')
            ->onApply(fn(Builder $query, $value, Field $field) => $query->where('active', $value))
    ];
}

//...
```

If you do not want the field to perform any actions, then you can use the `canApply()` method.

```php
canApply(Closure|bool|null $condition = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->canApply()
    ];
}

//...
```

<a name="events"></a>
## Events

Sometimes you may need to override *resolve* methods that are executed before and after `apply()`, to do this, you must use appropriate methods.

```php
onBeforeApply(Closure $onBeforeApply)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->onBeforeApply(function(Model $item, $value, Field $field) {
                //
                return $item;
            })
    ];
}
```

```php
onAfterApply(Closure $onAfterApply)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->onAfterApply(function(Model $item, $value, Field $field) {
                //
                return $item;
            })
    ];
}
```

```php
onAfterDestroy(Closure $onAfterDestroy)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->onAfterDestroy(function(Model $item, $value, Field $field) {
                //
                return $item;
            })
    ];
}
```

<a name="assets"></a>
## Assets

For the field, it is possible to load additional CSS styles and JS scripts using the `addAssets()` method.

```php
addAssets(array $assets)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->addAssets(['custom.css', 'custom.js'])
    ];
}
```

<a name="wrapper"></a>
## Wrapper

When displayed on forms, fields use a special *wrapper* for titles, tooltips, links, etc. Sometimes a situation may arise when you want to display a field without additional elements.  
Method `withoutWrapper()` allows you to disable the creation of *wrapper*.

```php
withoutWrapper(mixed $condition = null)
```

```php
//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->withoutWrapper()
    ];
}
```

![without_wrapper](https://moonshine-laravel.com/screenshots/without_wrapper.png) ![without_wrapper_dark](https://moonshine-laravel.com/screenshots/without_wrapper_dark.png)

<a name="reactive"></a>
## Reactive

The `reactive()` method allows you to change fields reactively.

```php
reactive(
    ?Closure $callback = null,
    bool $lazy = false,
    int $debounce = 0,
    int $throttle = 0,
)
```

- `$callback` - _callback_ function,
- `$lazy` - deferred function call
- `$debounce` - time between function calls (ms.),
- `$throttle` - function call interval (ms.).

#### Callback

The *Callback* function in the `reactive()` method accepts parameters which you can use to build your logic.

```php
function(Fields $fields, ?string $value, Field $field, array $values)
```

- `$fields` - reactive fields
- `$value` - the value of the field that triggers reactivity
- `$field` - field that initiates reactivity
- `$values` - values of reactive fields.

> [!NOTE]
> Fields that support reactivity: `Text`, `Number`, `Checkbox`, `Select` and their successors.

```php
FormBuilder::make()
    ->name('my-form')
    ->fields([
        Text::make('Title')
            ->reactive(function(Fields $fields, ?string $value): Fields {
                return tap($fields, static fn ($fields) => $fields
                    ->findByColumn('slug')
                    ?->setValue(str($value ?? '')->slug()->value())
                );
            }),

        Text::make('Slug')
            ->reactive()
    ])
```

This example implements the formation of a slug field based on the header.  
The Slug will be generated as you enter text.

> [!NOTE]
> A reactive field can change the state of other fields, but does not change its own state!

To change the state of the field that initiates reactivity, it is convenient to use the parameters of the *callback* function.

```php
Select::make('Category', 'category_id')
    ->reactive(function(Fields $fields, ?string $value, Field $field, array $values): Fields {
        $field->setValue($value);

        return tap($fields, static fn ($fields) =>
            $fields
                ->findByColumn('article_id')
                ?->options(
                    Article::where('category_id', $value)
                        ->get()
                        ->pluck('title', 'id')
                        ->toArray()
                );
        );
    })
```

<a name="on-change"></a>
## onChange methods

Using the `onChangeMethod()` and `onChangeUrl()` methods You can add logic when changing field values.

The `onChangeUrl()` or `onChangeMethod()` methods are present for all fields, except for the *HasOne* and *HasMany* relationship fields.

### onChangeUrl()

The `onChangeUrl()` method allows you to send a request asynchronously when a field changes.

```php
onChangeUrl(
    Closure $url,
    string $method = 'PUT',
    array $events = [],
    ?string $selector = null,
    ?string $callback = null,
)
```

- `$url` - request url
- `$method` - asynchronous request method
- `$events` - events to be called after a successful request,
- `$selector` - selector of the element whose content will change
- `$callback` - js callback function after receiving a response.

```php
//...

public function fields(): array
{
    return [
        Switcher::make('Active')
            ->onChangeUrl(fn() => '/endpoint')
    ];
}
```

If you need to replace the area with html after a successful request, you can return HTML content or json with the html key in the response.

```php
//...

public function fields(): array
{
    return [
        Switcher::make('Active')
            ->onChangeUrl(fn() => '/endpoint', selector: '#my-selector')
    ];
}
```

#### onChangeMethod()

The `onChangeMethod()` method allows you to asynchronously call a resource or page method when a field changes without the need to create additional controllers.

```php
onChangeMethod(
    string $method,
    array|Closure $params = [],
    ?string $message = null,
    ?string $selector = null,
    array $events = [],
    ?string $callback = null,
    ?Page $page = null,
    ?ResourceContract $resource = null,
)
```

- `$method` - name of the method
- `$params` - parameters for the request,
- `$message` - messages
- `$selector` - selector of the element whose content will change
- `$events` - events to be called after a successful request,
- `$callback` - js callback function after receiving a response
- `$page` - page containing the method
- `$resource` - resource containing the method.

```php
//...

public function fields(): array
{
    return [
        Switcher::make('Active')
            ->onChangeMethod('someMethod')
    ];
}
```

```php
public function someMethod(MoonShineRequest $request): void
{
    // Logic
}
```

> [!NOTE]
> Example of sorting the *CardsBuilder* component in the section [Recipes](https://moonshine-laravel.com/docs/resource/recipes/recipes#sorting-for-cards-builder)

<a name="for-value"></a>
## Methods for values

#### Get value from source

The `fromRaw()` method allows you to add a closure to get the final value from the original.  
This closure is used when importing data.

```php
/**
 * @param  Closure(mixed $raw, static): mixed  $callback
 * @return $this
 */
fromRaw(Closure $callback)
```

```php
use App\Enums\StatusEnum;
use MoonShine\Fields\Enum;

Enum::make('Status')
    ->attach(StatusEnum::class)
    ->fromRaw(fn(string $raw, Enum $ctx) => StatusEnum::tryFrom($raw))
```

### Get raw value

The `modifyRawValue()` method allows you to add a closure to obtain the raw value.  
This closure is used when exporting data.

```php
/**
 * @param  Closure(mixed $raw, static): mixed  $callback
 * @return $this
 */
modifyRawValue(Closure $callback)
```

```php
use App\Enums\StatusEnum;
use MoonShine\Fields\Enum;

Enum::make('Status')
    ->attach(StatusEnum::class)
    ->modifyRawValue(fn(StatusEnum $raw, Enum $ctx) => $raw->value))
```

<a name="scheme"></a>
## Scheme field's work

![field_scheme](https://moonshine-laravel.com/screenshots/field_scheme.png)]