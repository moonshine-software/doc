# ActionButton

- [Basics](#basics)
- [Open in new window](#blank)
- [Icon](#icon)
- [Color](#color)
- [Badge](#badge)
- [onClick](#onclick)
- [Modal](#modal)
- [Confirmation](#confirm)
- [Offcanvas](#offcanvas)
- [Grouping](#group)
- [Bulk actions](#bulk)
- [Async mode](#async)
    - [Method calls](#method)
- [Event dispatching](#event)
- [Data filling](#fill)

---

<a name="basics"></a>
## Basics

When you need to add a button with a specific action, `ActionButton` comes to the rescue.
In **MoonShine**, they are already used - in forms, tables, and on pages.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;

make(
    Closure|string $label,
    Closure|string $url = '#',
    ?DataWrapperContract $data = null,
)
```

- `label` - button text,
- `url` - button link URL,
- `data` - optional button data, available in closures.

```php
use MoonShine\UI\Components\ActionButton;

ActionButton::make(
    'Button Label',
    'https://moonshine-laravel.com'
)
```

<a name="blank"></a>
## Open in new window

The `blank()` method allows opening a URL in a new window. The attribute `target="_blank"` will be added.

```php
ActionButton::make('Button Label', '/')
    ->blank()
```

<a name="icon"></a>
## Icon

The `icon()` method allows specifying an icon for the button.

```php
ActionButton::make('Button Label')
    ->icon('pencil')
```

> [!NOTE]
> For more detailed information, refer to the [Icons](/docs/{{version}}/appearance/icons) section.

<a name="color"></a>
## Color

For `ActionButton`, there is a set of methods to set the button color:
`primary()`, `secondary()`, `warning()`, `success()`, and `error()`.

```php
ActionButton::make('Button Label')
    ->primary()
```

<a name="badge"></a>
## Badge

The `badge()` method allows adding a badge to the button.

```php
badge(Closure|string|int|float|null $value)
```

```php
ActionButton::make('Button Label')
    ->badge(fn() => Comment::count())
```

<a name="onclick"></a>
## onClick

The `onClick()` method allows executing js code upon clicking.

```php
ActionButton::make('Button Label')
    ->onClick(fn() => "alert('Пример')", 'prevent')
```

If you need to get data in the `onClick()` method, use the `onAfterSet()` method.

```php
ActionButton::make('Alert')
    ->onAfterSet(function (?DataWrapperContract $data, ActionButton $button) {
        return $button->onClick(fn() => 'alert('.$data?->getKey().')');
    })
```

<a name="modal"></a>
## Modal

### Basics

To trigger a modal window when the button is clicked, use the `inModal()` method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\UI\ActionButtonContract;
use MoonShine\UI\Components\Modal;

/**
 * @param  ?Closure(Modal $modal, ActionButtonContract $ctx): Modal  $builder
 */
inModal(
    Closure|string|null $title = null,
    Closure|string|null $content = null,
    Closure|string|null $name = null,
    ?Closure $builder = null,
    iterable $components = [],
)
```

- `title` - modal window title,
- `content` - modal window content,
- `name` - unique modal window name for event dispatching,
- `builder` - closure with access to the `Modal` component.
- `components` - components.

@include('_includes/modal-off-canvas-components', 'Modal', 'Modal', 'Modal', 'Modal')

> [!NOTE]
> For more detailed information on modal methods, refer to the [Modal](/docs/{{version}}/components/modal) section.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\Modal;

ActionButton::make('Button Label')
    ->inModal(
        title: 'Modal Window Title',
        content: 'Modal Window Content',
        name: 'my-modal',
        builder: fn(Modal $modal, ActionButton $ctx) => $modal
    )
```

> [!WARNING]
> If you are using multiple similar modal windows, such as in tables for each item, you need to specify a unique `name` for each.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\UI\ActionButtonContract;
use MoonShine\UI\Components\ActionButton;

ActionButton::make('Button Label')
    ->inModal(
        name: static fn (mixed $item, ActionButtonContract $ctx): string => "delete-button-{$ctx->getData()?->getKey()}"
    )
```

You can also open a modal window using the `toggleModal()` method, and if the `ActionButton` is inside a modal window, simply `openModal()`.

```php
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\Modal;

Modal::make('Title','Content')
    ->name('my-modal'),

ActionButton::make('Open modal window')
    ->toggleModal('my-modal'),
```

### Async mode

If you need to load content in the modal window asynchronously, enable asynchronous mode using the `async()` method in the `ActionButton`.

```php
ActionButton::make(
    'Button Label',
    to_page('action_button', fragment: 'doc-content'),
)
    ->async()
    ->inModal(
        title: fn() => 'Modal Window Title',
    )
```

> [!NOTE]
> You can find out about [Fragment](/docs/{{version}}/components/fragment) in the "Components" section.

<a name="confirm"></a>
## Confirmation

The `withConfirm()` method allows creating a button with action confirmation.

```php
/**
 * @param  ?Closure(FormBuilderContract $form, mixed $data): FormBuilderContract  $formBuilder
 * @param  ?Closure(Modal $modal, ActionButtonContract $ctx): Modal  $modalBuilder
 */
withConfirm(
    Closure|string|null $title = null,
    Closure|string|null $content = null,
    Closure|string|null $button = null,
    Closure|array|null $fields = null,
    HttpMethod $method = HttpMethod::POST,
    ?Closure $formBuilder = null,
    ?Closure $modalBuilder = null,
    Closure|string|null $name = null,
)
```

```php
ActionButton::make('Button Label')
    ->withConfirm(
        title: 'Confirmation Modal Window Title',
        content: 'Confirmation Modal Window Content',
        button: 'Confirmation Modal Window Button',
        // optionally - additional form fields
        fields: null,
        method: HttpMethod::POST,
        // optionally - closure with FormBuilder
        formBuilder: null,
        // optionally - closure with Modal
        modalBuilder: null,
        name: 'my-modal',
    )
```

> [!WARNING]
> If you are using multiple similar modal windows, such as in tables for each item, you need to specify a unique `name` for each.

```php
ActionButton::make('Button Label')
    ->inModal(
        name: static fn (mixed $item, ActionButtonContract $ctx): string => "delete-button-{$ctx->getData()?->getKey()}"
    )
```

<a name="offcanvas"></a>
## Offcanvas

To trigger an offcanvas when clicking the button, use  `inOffCanvas()` method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\OffCanvas;

ActionButton::make('Button Label')
    ->inOffCanvas(
        title: fn() => 'Offcanvas Title',
        content: fn() => 'Content',
        name: false,
        builder: fn(OffCanvas $offCanvas, ActionButton $ctx) => $offCanvas->left(),
        // optionally - necessary for components to be available for searching in the system, as content is just HTML
        components: [],
    )
```

<a name="group"></a>
## Grouping

If you need to organize logic with multiple `ActionButton`, with some of them needing to be hidden or displayed in a dropdown menu, use the `ActionGroup` component.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\ActionGroup;

ActionGroup::make([
    ActionButton::make('Button 1', '/')
        ->canSee(fn() => false),
    ActionButton::make('Button 2', '/', $model)
        ->canSee(fn($model) => $model->active)
])
```

> [!NOTE]
> Learn more about [ActionGroup](/docs/{{version}}/components/action-group) component.

### Display

With `ActionGroup`, you can also change the display of buttons, showing them inline or in a dropdown for space-saving.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\ActionGroup;

ActionGroup::make([
    ActionButton::make('Button 1', '/')
        ->showInLine(),

    ActionButton::make('Button 2', '/')
        ->showInDropdown()
])
```

<a name="bulk"></a>
## Bulk actions

The `bulk()` method allows creating a bulk action button for `ModelResource`.

```php
protected function indexButtons(): ListOf
{
    return parent::indexButtons()
        ->add(ActionButton::make('Link', '/endpoint')->bulk());
}
```

> [!NOTE]
> The `bulk()` method is only used within `ModelResource`.

<a name="async"></a>
## Async mode

The `async()` method allows implementing asynchronous functionality for `ActionButton`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\DTOs\AsyncCallback;
use MoonShine\Support\Enums\HttpMethod;

async(
    HttpMethod $method = HttpMethod::GET,
    ?string $selector = null,
    array $events = [],
    ?AsyncCallback $callback = null,
)
```

- `$method` - the method of the asynchronous request,
- `$selector` - the selector of the element whose content will change according to the response,
- `$events` - events that will be triggered after a successful request,
- `$callback` - js callback function after receiving the response.

> [!NOTE]
> You can learn more about [Events](/docs/{{version}}/frontend/js#events) in the "Frontend" section.
>
> [!NOTE]
> You can learn more about [Callback](/docs/{{version}}/frontend/js#response-calback) in the "Frontend" section.

```php
ActionButton::make('Button Label', '/endpoint')
    ->async()
```

### Notifications

If you need to display a notification or redirect after clicking, simply implement a json response according to the following structure:

```json
{
    "message": "Toast",
    "messageType": "success",
    "redirect": "/url"
}
```

> [!NOTE]
> The `redirect` parameter is optional.

### HTML content

If you need to replace an HTML area upon clicking, you can return HTML content or json with the html key in the response, for example:

```json
{"html": "Html content"}
```

```php
ActionButton::make('Button Label', '/endpoint')
    ->async(selector: '#my-selector')
```

### Events

After a successful request, you can trigger events.

```php
ActionButton::make('Button Label', '/endpoint')
    ->async(
        events: [
            AlpineJs::event(JsEvent::TABLE_UPDATED, $this->getListComponentName())
        ]
    )
```

> [!NOTE]
> For the `JsEvent::TABLE_UPDATED` event to work, the table must have [async mode](/docs/{{version}}/model-resource/table#async) enabled.

### Callback

If you need to handle the response differently, you must implement a handler function and specify it in the `async()` method.

```php
ActionButton::make('Button Label', '/endpoint')
    ->async(
        callback: AsyncCallback::with(responseHandler: 'myFunction')
    )
```

```javascript
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

> [!NOTE]
> Details in the [Js](/docs/{{version}}/frontend/js#response-calback) section.

<a name="method"></a>
### Method calls

`method()` allows specifying a method name in the resource and call it asynchronously when the `ActionButton` is clicked, without the need to create additional controllers.

```php
method(
    string $method,
    array|Closure $params = [],
    ?string $message = null,
    ?string $selector = null,
    array $events = [],
    ?AsyncCallback $callback = null,
    ?PageContract $page = null,
    ?ResourceContract $resource = null,
)
```

- `$method` - the method name,
- `$params` - optionally - parameters for the request,
- `$message` - optionally - message upon successful execution,
- `$selector` - optionally - the selector of the element whose content will change,
- `$events` - optionally - events that will be triggered after a successful query,
- `$callback` - optionally - js callback function after receiving the response,
- `$page` - optionally - the page containing the method (if the button is outside the page and resource),
- `$resource` - optionally - the resource containing the method (if the button is outside the resource).

```php
ActionButton::make('Button Label')
    ->method('updateSomething')
```

If the method returns a file for download, you need to add the `download()` method.

```php
ActionButton::make('ZIP')
    ->method('zip')
    ->download()
```

Examples of methods:

```php
// With notification
public function updateSomething(MoonShineRequest $request): MoonShineJsonResponse
{
    // $request->getResource();
    // $request->getResource()->getItem();
    // $request->getPage();

    return MoonShineJsonResponse::make()->toast('My message', ToastType::SUCCESS);
}

// Redirect
public function updateSomething(MoonShineRequest $request): MoonShineJsonResponse
{
    return MoonShineJsonResponse::make()->redirect('/');
}

// Redirect
public function updateSomething(MoonShineRequest $request): RedirectResponse
{
    return back();
}

// Exception
public function updateSomething(MoonShineRequest $request): void
{
    throw new \Exception('My message');
}

// Custom JSON response
public function updateSomething(MoonShineRequest $request)
{
    return MoonShineJsonResponse::make()->html('Content');
}
```

> [!WARNING]
> Methods called via `ActionButton` in the resource must be public!

> [!WARNING]
> For access to data from the request, you must pass them as parameters.

#### Passing the current item

If the request contains `resourceItem`, you can access the current item in the resource through the `getItem()` method.

When the data contains a model and the button is created in the `indexButtons()` method or `detailButtons()` or `formButtons()` of [TableBuilder](/docs/{{version}}/components/table-builder#buttons), [CardsBuilder](/docs/{{version}}/components/cards-builder#buttons) or [FormBuilder](/docs/{{version}}/components/form-builder#buttons),
it automatically gets the data, and the parameters will contain `resourceItem`.

When the button is on the form page of `ModelResource`, you can pass the id of the current item.

```php
ActionButton::make('Button Label')
    ->method(
        'updateSomething',
        params: ['resourceItem' => $this->getResource()->getItemID()]
    )
```

When the button is in the index table of `ModelResource`, you need to use a closure.

```php
ActionButton::make('Button Label')
    ->method(
        'updateSomething',
        params: fn(Model $item) => ['resourceItem' => $item->getKey()]
    )
```

#### Field values

The `withSelectorsParams()` method allows passing field values with the request using element selectors.

```php
ActionButton::make('Button Label')
    ->method('updateSomething')
    ->withSelectorsParams([
        'alias' => '[data-column="title"]',
        'slug' => '#slug',
    ])
```

```php
use MoonShine\Laravel\Http\Responses\MoonShineJsonResponse;
use MoonShine\Laravel\MoonShineRequest;

public function updateSomething(MoonShineRequest $request): MoonShineJsonResponse
{
    return MoonShineJsonResponse::make()
        ->toast($request->get('slug', 'Error'));
}
```

> [!WARNING]
> When using the `withSelectorsParams()` method, requests will be sent via `POST`.

#### Download

The invoked method can return `BinaryFileResponse`, allowing a file download.

```php
ActionButton::make('Download')
    ->method('download')
```

```php
use Symfony\Component\HttpFoundation\BinaryFileResponse;

public function download(): BinaryFileResponse
{
    // ...

    return response()->download($file);
}
```

<a name="event"></a>
## Event dispatching

To dispatch JavaScript events, you can use the `dispatchEvent()` method.

```php
dispatchEvent(array|string $events)
```

```php
ActionButton::make('Refresh')
    ->dispatchEvent(
        AlpineJs::event(JsEvent::TABLE_UPDATED, 'index-table')
    )
```

By default, when an event is triggered with a request, all query parameters (e.g., `?param=value`) from the `url` (specified when creating the `ActionButton`) will be sent.

You can exclude unnecessary ones through the `exclude` parameter.

```php
ActionButton::make('Refresh')
    ->dispatchEvent(
        AlpineJs::event(JsEvent::TABLE_UPDATED, 'index-table'),
        exclude: ['something'],
    )
```

You can also completely exclude the sending of `withoutPayload`.

```php
ActionButton::make('Refresh')
    ->dispatchEvent(
        AlpineJs::event(JsEvent::TABLE_UPDATED, 'index-table'),
        withoutPayload: true
    )
```

### URL query parameters

You can include the current request URL parameters (e.g., `?param=value`) in the request.

```php
ActionButton::make('Button Label')
    ->withQueryParams()
```

<a name="fill"></a>
## Data filling

When working with `ModelResource`, the action buttons `ActionButton` are usually automatically filled with the necessary data.
This process happens "under the hood" using the `setData()` method.
Let’s examine this mechanism in more detail.

```php
ActionButton::make('Button Label')
    ->setData(?DataWrapperContract $data = null)
```

> [!NOTE]
> For more information about `DataWrapperContract`, read the [TypeCasts](/docs/{{version}}/advanced/type-casts) section.

Methods with callbacks before and after filling the button are also available.

```php
ActionButton::make('Button Label')
    ->onBeforeSet(fn(?DataWrapperContract $data, ActionButton $ctx) => $data)
```

```php
ActionButton::make('Button Label')
    ->onAfterSet(function(?DataWrapperContract $data, ActionButton $ctx): void {
        // logic
    })
```
