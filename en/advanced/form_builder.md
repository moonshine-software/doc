https://moonshine-laravel.com/docs/resource/advanced/advanced-form_builder?change-moonshine-locale=en

------

# FormBuilder

- [Basics](#basics)
- [Fields](#fields)
- [Fill fields](#fill-fields)
- [Casting](#casting)
- [FillCast](#fillcast)
- [Buttons](#buttons)
- [Attributes](#attributes)
- [Form name](#form-name)
- [Asynchronous mode](#asynchronous-mode)
- [Displaying validation errors](#displaying-validation-errors)
- [Precognitive](#precognitive)
- [Apply](#apply)
- [Calling methods](#calling-methods)
- [Dispatch events](#dispatch-events)
- [Submit event](#submit-event)


<a name="basics"></a>
## Basics

Fields and decorations in *FormBuilder* are used inside forms, which are handled by FormBuilder.Thanks to *FormBuilder*, fields are displayed and filled with data.You can also use *FormBuilder* on your own pages or even outside of **MoonShine**.

```php
make(
    string $action = '',
    string $method = 'POST',
    Fields|array $fields = [],
    array $values = []
)
```

- `action` - handler
- `method` - request type,
- `fields` - fields and decorations.
- `values` - field values.

```php
FormBuilder::make(
    action:'/crud/update',
    method: 'PUT',
    fields: [
        Text::make('Text')
    ],
    values: ['text' => 'Value']
)
```

Same thing through methods:

```php
FormBuilder::make()
    ->action('/crud/update')
    ->method('PUT')
    ->fields([
        Text::make('Text')
    ])
    ->fill(['text' => 'Value'])
```

Helper is also available:

```php
{!! form(request()->url(), 'GET')
    ->fields([
        Text::make('Text')
    ])
    ->fill(['text' => 'Value'])
!!}
```

<a name="fields"></a>
## Fields

The `fields()` method for declaring form fields and decorations:

```php
fields(Fields|Closure|array $fields)
```

```php
FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
```

<a name="fill-fields"></a>
## Fill fields

`fill()` method for filling fields with values:

```php
fill(mixed $values = [])
```

```php
FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fill(['text' => 'value'])
```

<a name="casting"></a>
## Casting

The `cast()` method for casting form values to a specific type.Since by default fields work with primitive types:

```php
cast(MoonShineDataCast $cast)
```

```php
use MoonShine\TypeCasts\ModelCast;

FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fillCast(
        ['text' => 'value'],
        ModelCast::make(User::class)
    )
```

In this example, we cast the data to the `User` model format using `ModelCast`.

> [!NOTE]
> For more detailed information, please refer to the section [TypeCasts](https://moonshine-laravel.com/docs/resource/advanced/advanced-type_casts)

<a name="fillcast"></a>
## FillCast

The `fillCast()` method allows you to cast data to a specific type and immediately fill it with values:

```php
fillCast(mixed $values, MoonShineDataCast $cast)
```

```php
use MoonShine\TypeCasts\ModelCast;

FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fillCast(
        ['text' => 'value'],
        ModelCast::make(User::class)
    )
```

or

```php
use MoonShine\TypeCasts\ModelCast;

FormBuilder::make('/crud/update', 'PUT')
    ->fields([
        Heading::make('Title'),
        Text::make('Text'),
    ])
    ->fillCast(
        User::query()->first(),
        ModelCast::make(User::class)
    )
```

<a name="buttons"></a>
## Buttons

Form buttons can be modified and added.

To customize the "submit" button, use the `submit()` method.

```php
submit(string $label, array $attributes = [])
```

- `label` - button name,
- `attributes` - additional attributes

```php
FormBuilder::make('/crud/update', 'PUT')
    ->submit(label: 'Click me', attributes: ['class' => 'btn-primary'])
```

The `hideSubmit()` method allows you to hide the **"submit"** button.

```php
FormBuilder::make('/crud/update', 'PUT')
    ->hideSubmit()
```

To add new buttons based on `ActionButton`, use the `buttons()` method

```php
buttons(array $buttons = [])
```

```php
FormBuilder::make('/crud/update', 'PUT')
    ->buttons([
        ActionButton::make('Delete', route('name.delete'))
    ])
```

<a name="attributes"></a>
## Attributes

You can set any html attributes for the form using the `customAttributes()` method.

```php
FormBuilder::make()
    ->customAttributes(['class' => 'custom-form'])
```

<a name="form-name"></a>
## Form name

The `name()` method allows you to set a unique name for the form through which events can be raised.

```php
FormBuilder::make('/crud/update', 'PUT')
    ->name('main-form')
```

<a name="asynchronous-mode"></a>
## Asynchronous mode

If you need to submit the form asynchronously, use the `async()` method.

```php
async(
    ?string $asyncUrl = null,
    string|array|null $asyncEvents = null,
    ?string $asyncCallback = null
)
```

- `asyncUrl` - request url (by default the request is sent via action url),
- `asyncEvents` - events raised after a successful request,
- `asyncCallback` - js callback function after receiving a response.

```php
FormBuilder::make('/crud/update', 'PUT')
    ->async()
```

After a successful request, you can raise events by adding the `asyncEvents` parameter.

```php
FormBuilder::make('/crud/update', 'PUT')
        ->name('main-form')
        ->async(asyncEvents: ['table-updated-crud', 'form-reset-main-form'])
```

**MoonShine** already has a set of ready-made events:
- `table-updated-{name}` - updating an asynchronous table by its name,
- `form-reset-{name}` - reset form values by its name,
- `fragment-updated-{name}` - updates a blade fragment by its name.

> [!NOTE]
> Recipe [Upon a successful request, the form updates the table and resets the values](https://moonshine-laravel.com/docs/resource/recipes/recipes#form-with-events)

>[!WARNING]
>The `async()` method must come after the `name()` method!

<a name="displaying-validation-errors"></a>
## Displaying validation errors

By default, validation errors are displayed at the top of the form.

![errors_above_true](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/errors_above_true.png)
![errors_above_true_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/errors_above_true_dark.png)

The `errorsAbove(bool $enable = true)` method is used to control the display of validation errors at the top of the form. It allows you to enable or disable this feature.

```php
FormBuilder::make('/crud/update', 'PUT')
    ->errorsAbove(false)
```

![errors_above_false](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/errors_above_false.png)
![errors_above_false_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/errors_above_false_dark.png)

<a name="precognitive"></a>
## Precognitive

If you need to perform precognition validation first, you need the `precognitive()` method.

```php
FormBuilder::make('/crud/update', 'PUT')
    ->precognitive()
```

<a name="apply"></a>
## Apply

The `apply()` method in *FormBuilder* iterates through all form fields and calls their apply methods.

```php
apply(
    Closure $apply,
    ?Closure $default = null,
    ?Closure $before = null,
    ?Closure $after = null,
    bool $throw = false,
)
```
- `$apply` - callback function;
- `$default` - apply for the default field;
- `$before` - callback function before apply;
- `$after` - callback function after apply;
- `$throw` - throw exceptions.

#### Examples

It is necessary to save the data of all *FormBuilder* fields in the controller:

```php
$form->apply(fn(Model $item) => $item->save());
```

A more complex option, indicating events before and after saving:

```php
$form->apply(
    static fn(Model $item) => $item->save(),
    before: function (Model $item) {
        if (! $item->exists) {
            $item = $this->beforeCreating($item);
        }

        if ($item->exists) {
            $item = $this->beforeUpdating($item);
        }

        return $item;
    },
    after: function (Model $item) {
        $wasRecentlyCreated = $item->wasRecentlyCreated;

        $item->save();

        if ($wasRecentlyCreated) {
            $item = $this->afterCreated($item);
        }

        if (! $wasRecentlyCreated) {
            $item = $this->afterUpdated($item);
        }

        return $item;
    },
    throw: true
);
```

<a name="calling-methods"></a>
## Calling methods

`asyncMethod()` allow you to specify the name of the method in the resource and call it asynchronously when sending *FormBuilder* without the need to create additional controllers.

```php
public function components(): array
{
    return [
        FormBuilder::make()
            ->asyncMethod('updateSomething'),
    ];
}
```

```php
// With toast
public function updateSomething(MoonShineRequest $request)
{
    // $request->getResource();
    // $request->getResource()->getItem();
    // $request->getPage();

    MoonShineUI::toast('MyMessage', 'success');

    return back();
}

// Exception
public function updateSomething(MoonShineRequest $request)
{
    throw new \Exception('My message');
}

// Custom json response
public function updateSomething(MoonShineRequest $request)
{
    return MoonShineJsonResponse::make()->toast('MyMessage', ToastType::SUCCESS);
}
```

<a name="dispatch-events"></a>
## Dispatch events

To dispatch javascript events, you can use the `dispatchEvent()` method.

```php
dispatchEvent(array|string $events)
```

```php
FormBuilder::make()
    ->dispatchEvent(JsEvent::OFF_CANVAS_TOGGLED, 'default'),
```

<a name="submit-event"></a>
## "Submit" event

To submit a form, you can call the *Submit* event.

```php
AlpineJs::event(JsEvent::FORM_SUBMIT, 'componentName')
```

#### Example of calling an event on a form page

```php
public function formButtons(): array
{
    return [
       ActionButton::make('Save')->dispatchEvent(AlpineJs::event(JsEvent::FORM_SUBMIT, $this->uriKey()))
    ];
}
```

> [!NOTE]
> For more information about AlpineJs helpers, please refer to [Js events](https://moonshine-laravel.com/docs/resource/advanced/advanced-js_events#helper).
