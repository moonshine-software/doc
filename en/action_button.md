https://moonshine-laravel.com/docs/resource/actionbutton/action_button?change-moonshine-locale=en

------

## ActionButton

- [Basics](#basics)
- [Blank](#blank)
- [Icon](#icon)
- [Color](#color)
- [Badge](#badge)
- [onClick](#onclick)
- [Modal](#modal)
- [Confirm](#confirm)
- [Offcanvas](#offcanvas)
- [Group](n#group)
- [Bulk](#bulk)
- [Async mode](#async)
- [Calling methods](#method)
- [Dispatch events](#event)

Extends [MoonShineComponent](https://moonshine-laravel.com/docs/resource/components/components-moonshine_component)
* has the same features

<a name="basics"></a> 
### Basics

When you need to add a button with a specific action, ActionButtons come to the rescue.  
In MoonShine they are already used - in forms, tables, on pages.

```php
ActionButton::make(
    Closure|string $label,
    Closure|string|null $url = null,
    mixed $item = null
)
```

- `label`- button text,  
- `url` - URL of the button link,  
- `item` - optional button data available in closures.  

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Button title',
            url: 'https://moonshine-laravel.com',
        )
    ];
}
```

A helper is also available that can be used in Blade:

```php
<div>
    {!! actionBtn('Click me', 'https://moonshine-laravel.com') !!}
</div>
```

<a name="blank"></a> 
### Blank

The `blank()` method allows you to open a URL in a new window.

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Click me',
            url: '/',
        )
            ->blank()
    ];
}
```

<a name="icon"></a> 
### Icon

The `icon()` method allows you to specify an icon for a button.

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: fn() => 'Click me',
            url: 'https://moonshine-laravel.com',
        )
            ->icon('heroicons.outline.pencil')
    ];
}
```

> [!NOTE]
> For more detailed information, please refer to the section [Icons](https://moonshine-laravel.com/docs/resource/appearance/icons) .

<a name="color"></a> 
### Color

For *ActionButton* there is a set of methods that allow you to set the color of the button:  
`primary()`, `secondary()`, `warning()`, `success()` and `error()`.

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Click me',
            url: fn() => 'https://moonshine-laravel.com',
        )
            ->primary()
    ];
}
```

<a name="badge"></a> 
### Badge

The `badge()` method allows you to add a badge to a button.

```php
badge(Closure|string|int|float|null $value)
```
```php
use MoonShine\ActionButtons\ActionButton;

//...

ActionButton::make('Button')
    ->badge(fn() => Comment::count())

//...
```

<a name="onclick"></a> 
### onClick

The `onClick` method allows you to execute js code on click:

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Click me',
            url: 'https://moonshine-laravel.com',
        )
            ->onClick(fn() => "alert('Example')", 'prevent')
    ];
}
```

<a name="modal"></a> 
### Modal

### Basics

To trigger a modal window when a button is clicked, use the `inModal()` method.

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Click me',
            url: 'https://moonshine-laravel.com',
        )
            ->inModal(
                title: fn() => 'Modal title',
                content: fn() => 'Modal content',
                buttons: [
                    ActionButton::make('Click me in modal', 'https://moonshine-laravel.com')
                ],
                async: false
            )
    ];
}
```

- `title` - modal title,
- `content` - modal content,
- `buttons` - modal buttons,
- `async` - async mode,
- `wide` - maximum modal width,
- `auto` - width of modal window by content,
- `closeOutside` - close the modal window when clicking outside the window area,
- `attributes` - additional attributes,
- `autoClose` - auto close modal window after successful request.

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Click me',
            url: 'https://moonshine-laravel.com',
        )
            ->inModal(
                title: fn() => 'Modal title',
                content: fn() => 'Modal content',
                buttons: [
                    ActionButton::make('Click me in modal', 'https://moonshine-laravel.com')
                ],
                async: false
            )
    ];
}
```

You can also open a modal window using the `toggleModal` method, and if the ActionButton is inside modal window then just `openModal`

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\Modal;

public function components(): array
{
    return [
        MoonShine\Components\Modal::make(
            'Title',
            fn() => 'Content',
        )->name('my-modal')

        ActionButton::make(
            label: 'Open modal',
            url: '#',
        )->toggleModal('my-modal')
    ];
}
```

### Async

If you need to load content into the modal window asynchronously, then switch the async parameter to `true`.

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Click me',
            url: to_page('action_button', fragment: 'doc-content'),
        )
            ->inModal(
                title: fn() => 'Modal title',
                async: true
            )
    ];
}
```

> [!NOTE]
> About [Fragment](https://moonshine-laravel.com/docs/resource/components/components-decoration_fragment) can be found in the "Components" section

<a name="confirm"></a> 
### Confirm

The `withConfirm()` method allows you to create a button with confirmation of an action.

```php
ActionButton::make(
    label: 'Click me',
    url: 'https://moonshine-laravel.com',
)
    ->withConfirm(
        'Confirm modal title',
        'Confirm modal content',
        'Confirm modal button',
    )
```

> [!WARNING]
> `withConfirm` does not work with `async` modes. For asynchronous mode, you need to make your own implementation via [Modal](https://moonshine-laravel.com/docs/resource/components/components-decoration_modal) or [inModal()](https://moonshine-laravel.com/docs/resource/components/components-decoration_modal) .

<a name="offcanvas"></a> 
### Offcanvas

In order for offcanvas to be called when a button is clicked, use the `inOffCanvas()` method.

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Click me',
            url: 'https://moonshine-laravel.com',
        )
            ->inOffCanvas(
                fn() => 'OffCanvas title',
                fn() => form()->fields([Text::make('Text')]),
                isLeft: false
            )
    ];
}
```

<a name="group"></a> 
### Group

If you need to build logic with several `ActionButton`, however, some should be hidden or displayed in a drop-down menu, in this case, use the `ActionGroup` component.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\ActionGroup;

public function components(): array
{
    return [
        ActionGroup::make([
            ActionButton::make('Button 1', '/')->canSee(fn() => false),
            ActionButton::make('Button 2', '/', $model)->canSee(fn($model) => $model->active)
        ])
    ];
}
```

### Display

Thanks to *ActionGroup* you can also change the display of buttons, display them in a line or in a drop-down menu to save space.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\ActionGroup;

public function components(): array
{
    return [
        ActionGroup::make([
            ActionButton::make('Button 1', '/')->showInLine(),
            ActionButton::make('Button 2', '/')->showInDropdown()
        ])
    ];
}
```

<a name="bulk"></a> 
### Bulk

The `bulk()` method allows you to create a bulk action button for a *ModelResource*.

```php
public function indexButtons(): array
{
    return [
        ActionButton::make('Link', '/endpoint')->bulk(),
    ];
}
```

> [!TIP]
> The `bulk()` method, used only inside *ModelResource*.

<a name="async"></a> 
### Async mode

The `async()` method allows you to implement asynchronous operation for the *ActionButton*.

```php
async(
    string $method = 'GET',
    ?string $selector = null,
    array $events = []
    ?string $callback = null
)

```

- `$method` - asynchronous request method;
- `$selector` - selector of the element whose content will change;
- `$events` - events raised after a successful request;
- `$callback` - js callback function after receiving the response.

```php
public function components(): array
{
    return [
        ActionButton::make(
            'Click me',
            '/endpoint'
        )
            ->async()
    ];
}
```

#### Notifications

If you need to display a notification or make a redirect after a click, then it is enough to implement the json response according to the structure:

```php
{message: 'Toast', messageType: 'success', redirect: '/url'}
```

> [!TIP]
> The `redirect` parameter is optional.

#### HTML content

If you need to replace an area with html on click, then you can return HTML content or json with the html key in the response:

```php
{html: 'Html content'}
```

```php
public function components(): array
{
    return [
        ActionButton::make(
            'Click me',
            '/endpoint'
        )
            ->async(selector: '#my-selector')
    ];
}
```

#### Events

After a successful request, you can raise events:

```php
public function components(): array
{
    return [
        ActionButton::make(
            'Click me',
            '/endpoint'
        )
            ->async(events: ['table-updated-index-table'])
    ];
}
```
> [!TIP]
> For the `table-updated-index-table` event to work [async mode](https://moonshine-laravel.com/docs/resource/models-resources/resources-table#async) must be enabled.

#### Callback

If you need to process the response in a different way, then you need to implement a handler function and specify it in the `async()` method.

```php
public function components(): array
{
    return [
        ActionButton::make(
            'Click me',
            '/endpoint'
        )
            ->async(callback: 'myFunction')
    ];
}
```

```php
document.addEventListener("moonshine:init", () => {
    MoonShine.onCallback('myFunction', function(response, element, events, component) {
        if(response.confirmed === true) {
            component.$dispatch('toast', {type: 'success', text: 'Success'})
        } else {
            component.$dispatch('toast', {type: 'error', text: 'Error'})
        }
    })
})
```

<a name="method"></a> 
### Calling methods

`method()` allows you to specify the name of a method in a resource and call it asynchronously when you click on it *ActionButton* without having to create additional controllers.

```php
method(
    string $method,
    array|Closure $params = [],
    ?string $message = null,
    ?string $selector = null,
    array $events = [],
    string|AsyncCallback|null $callback = null,
    ?Page $page = null,
    ?ResourceContract $resource = null
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
public function components(): array
{
    return [
        ActionButton::make('Click me')
            ->method('updateSomething'),
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
> [!WARNING]
> Methods called via *ActionButton* in a resource must be public!

> [!CAUTION]
> To access the data from the request, you must pass it in the parameters.

#### Passing the current item

If *resourceItem* is present in the request, you can access the current item in the resource through the `getItem()` method.

- When there is a model in the data and the button is created in the `buttons()` method [TableBuilder](https://moonshine-laravel.com/docs/resource/advanced/advanced-table_builder#buttons), [CardsBuilder](https://moonshine-laravel.com/docs/resource/advanced/advanced-cards_builder#buttons) or [FormBuilder](https://moonshine-laravel.com/docs/resource/advanced/advanced-form_builder#buttons), then it is automatically filled with data and the parameters will contain `resourceItem`.
- When the button is on the *ModelResource* form page, you can pass the id of the current element.

```php
ActionButton::make('Click me')
    ->method(
        'updateSomething',
        params: ['resourceItem' => $this->getResource()->getItemID()]
    )
```

- When the button is in the *ModelResource* index table, you need to use a closure

```php
ActionButton::make('Click me')
    ->method(
        'updateSomething',
        params: fn($item) => ['resourceItem' => $item->getKey()]
    )
```
### Field values

The `withParams()` method allows you to pass field values with the request using element selectors.

```php
ActionButton::make('Async method')
    ->method('updateSomething')
    ->withParams([
        'alias' => '[data-column="title"]',
        'slug' => '#slug'
    ]),
```

```php
use MoonShine\Http\Responses\MoonShineJsonResponse;
use MoonShine\MoonShineRequest;

public function updateSomething(MoonShineRequest $request): MoonShineJsonResponse
{
    return MoonShineJsonResponse::make()
        ->toast($request->get('slug', 'Error'));
}
```

> [!WARNING]
> When using the `withParams()` method, requests will be sent via `POST`.

### Download

The called method can return `BinaryFileResponse`, which allows you to download a file.

```php
ActionButton::make('Download')->method('download')
```

```php
public function download(): BinaryFileResponse
{
    // ...

    return response()->download($file);
}
```

<a name="event"></a> 
### Dispatch events

To dispatch javascript events, you can use the `dispatchEvent()` method.

```php
dispatchEvent(array|string $events)
```

```php
ActionButton::make('Refresh', '#')
    ->dispatchEvent(AlpineJs::event(JsEvent::TABLE_UPDATED, 'index-table')),
```
