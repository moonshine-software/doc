# Js

- [Basics](#basics)
- [Creating a component](#component)
- [Events](#events)
  - [Default events](#default-events)
  - [Calling events](#call-events)
  - [Calling events through Response](#response-events)
  - [Blade directive](#blade-dir)
  - [Helper class AlpineJs](#helper)
- [Global class](#js-core)
- [Response handling](#response-callback)

---

<a name="basics"></a>
## Basics

**Alpine.js** is integrated into **MoonShine** "out of the box" and provides a declarative approach to creating dynamic behavior right in the HTML markup.
This allows you to easily add such features as:

- Dynamic hiding/showing of elements,
- Event handling,
- Reactivity,
- Asynchronous requests,
- Animations and transitions.

Thanks to its lightweight nature and simple syntax, **Alpine.js** is well-suited for admin panel tasks without weighing down your application.

> [!NOTE]
> Although **Alpine.js** is the recommended solution for **MoonShine**, you are not limited in your choice of JavaScript tools or using vanilla JS.

> [!TIP]
> We recommend familiarizing yourself with [Alpine.js](https://alpinejs.dev).

<a name="components"></a>
## Creating a component

Let's try to create our own component.

```shell
php artisan moonshine:component MyComponent
```

We'll leave the path as suggested by **MoonShine** - `/resources/views/admin/components/my-component.blade.php`.
Inside, we'll add `x-data` with the name of our component, thereby indicating that the area inside is an **Alpine.js** component.

```html
<div x-data="myComponent"></div>
```

Next, we'll create a script where we will later implement the logic of the **Alpine.js** component.

```js
document.addEventListener("alpine:init", () => {
    Alpine.data("myComponent", () => ({
        init() {
            // ...
        },
    }))
})
```

For clarity, we have shown you the script right in **Blade**,
but we recommend placing components in separate JS files and including them via [AssetManager](/docs/{{version}}/appearance/assets).

> [!WARNING]
> **Alpine.js** is already installed and running (window.Alpine); reinitializing will cause an error.

<a name="events"></a>
## Events

With JS events, you can easily interact with **MoonShine**! Update forms, tables, areas, trigger modal windows, reset forms, and much more.
You can also create your own events in JS.

<a name="#default-events"></a>
### Default events

In the **MoonShine** admin panel, several standard events are defined, the names of which can be conveniently obtained through the `enum` `JsEvent`, but you can also call them from JS.

- `fragment_updated:{componentName}`(`JsEvent::FRAGMENT_UPDATED`) - fragment update,
- `table_updated:{componentName}`(`JsEvent::TABLE_UPDATED`) - table update,
- `table_reindex:{componentName}`(`JsEvent::TABLE_REINDEX`) - table index update on sorting,
- `table_row_updated:{componentName}-{row-id}`(`JsEvent::TABLE_ROW_UPDATED`) - row update in the table,
- `cards_updated:{componentName}`(`JsEvent::CARDS_UPDATED`) - card list update,
- `form_reset:{componentName}`(`JsEvent::FORM_RESET`) - form reset,
- `form_submit:{componentName}`(`JsEvent::FORM_SUBMIT`) - form submission,
- `modal_toggled:{componentName}`(`JsEvent::MODAL_TOGGLED`) - opening/closing modal window,
- `off_canvas_toggled:{componentName}`(`JsEvent::OFF_CANVAS_TOGGLED`) - opening/closing `OffCanvas`,
- `popover_toggled:{componentName}`(`JsEvent::POPOVER_TOGGLED`) - opening/closing `OffCanvas`,
- `toast:{componentName}`(`JsEvent::TOAST`) - triggering Toast,
- `show_when_refresh:{componentName}`(`JsEvent::SHOW_WHEN_REFRESH`) - refresh `showWhen` states,

<a name="#call-events"></a>
### Calling events

Let's recall how this is done on the `backend` side:

```php
Modal::make('Title', 'Content')
    ->name('my-modal'),

ActionButton::make('Show modal window', '/endpoint')
    ->async(
        events: [AlpineJs::event(JsEvent::MODAL_TOGGLED, 'my-modal')]
    )
```

But this section is dedicated to `frontend` and events can be called using native JS methods:

```js
document.addEventListener("DOMContentLoaded", () => {
    this.dispatchEvent(new CustomEvent("modal_toggled:my-modal"))
})
```

Or using the magic method `$dispatch()` from **Alpine.js**:

```js
this.$dispatch('modal_toggled:my-modal')
```

> [!NOTE]
> More detailed information can be found in the official **Alpine.js** documentation
> in the sections [Events](https://alpinejs.dev/essentials/events) and [$dispatch](https://alpinejs.dev/magics/dispatch).

<a name="#response-events"></a>
### Calling events through Response

In **MoonShine**, you can return events in *MoonShineJsonResponse*, which will then be triggered.
To do this, you need to use the `events()` method.

```php
events(array $events)
```

- `$events` - an array of events to be triggered.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\Laravel\Http\Responses\MoonShineJsonResponse;
use MoonShine\Support\AlpineJs;
use MoonShine\Support\Enums\JsEvent;

// ...

return MoonShineJsonResponse::make()
    ->events([
        AlpineJs::event(JsEvent::TABLE_UPDATED, 'index'),
    ]);
```

<a name="blade-dir"></a>
### Blade directive

Blade directives are used for quickly declaring events for components.

#### @defineEvent

A directive for conveniently declaring an event in HTML.

```php
@defineEvent(
    string|JsEvent $event,
    ?string $name = null,
    ?string $call = null,
    array $params = [],
)
```

- `$event` - the event,
- `$name` - the component name,
- `$call` - the callback function,
- `$params` - event parameters.

```blade
<div x-data="myComponent"
    {{-- @table-updated-index.window="asyncRequest" --}}
    @defineEvent('table-updated', 'index', 'asyncRequest')
>
</div>
```

#### @defineEventWhen

With a condition of whether it will be added or not.

```php
@defineEventWhen(
    mixed $condition,
    string|JsEvent $event,
    ?string $name = null,
    ?string $call = null,
    array $params = [],
)
```

- `$condition` - condition,
- `$event` - the event,
- `$name` - the component name,
- `$call` - the callback function,
- `$params` - event parameters.

```blade
<div x-data="myComponent"
    {{-- @table-updated-index.window="asyncRequest" --}}
    @defineEventWhen(true, 'table-updated', 'index', 'asyncRequest')
>
</div>
```

<a name="helper"></a>
### Helper class AlpineJs for event formation.

#### AlpineJs::event()

```php
AlpineJs::event(
    string|JsEvent $event,
    ?string $name = null,
    array $params = [],
)
```

- `$event` - the event,
- `$name` - the component name,
- `$params` - event parameters.

```php
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Support\Enums\JsEvent;
use MoonShine\Support\AlpineJs;

FormBuilder::make('/crud/update')
    ->name('main-form')
    ->async(
        events: [AlpineJs::event(JsEvent::TABLE_UPDATED, 'index', ['var' => 'foo'])]
    )
```

#### AlpineJs::eventBlade()

```php
AlpineJs::eventBlade(
    string|JsEvent $event,
    ?string $name = null,
    ?string $call = null,
    array $params = []
)
```

- `$event` - the event,
- `$name` - the component name,
- `$call` - the callback function,
- `$params` - event parameters.

 ```php
FormBuilder::make('/crud/update')
    ->name('main-form')
    ->customAttributes([
        // @form-reset-main-form.window="formReset"
        AlpineJs::eventBlade(JsEvent::FORM_RESET, 'main-form') => 'formReset',
    ])
```

<a name="js-core"></a>
## Global class

We provide a global class **MoonShine** for convenient interaction on the client side.

## Request

```js
MoonShine.request(ctx, '/url', method = 'get', body = {}, headers = {}, data = {})
```

## Toast

```js
MoonShine.ui.toast('Hello world', 'success')
```

## Modal

Open/Close Modal

```js
MoonShine.ui.toggleModal('modal-name')
```

## OffCanvas

Open/Close OffCanvas

```js
MoonShine.ui.toggleOffCanvas('canvas-name')
```

## Iterable

### Reorder

```js
MoonShine.iterable.sortable(
    container,
    url,
    group,
    events,
    attributes = {
        handle: '.handle'
    },
    function(evt) {
        // ...
    }
)
```

### Reindexing of form element names

```js
MoonShine.iterable.reindex(
    container,
    itemSelector = '.item'
)
```

<a name="response-calback"></a>
## Response handling

**MoonShine** allows integration into the process of executing asynchronous requests in JS, specifying which function will run before the request and after receiving the response.

`ActionButton`, `FormBuilder`, `TableBuilder`, `Field`, and other components implementing the `HasAsyncContract` interface in `async` methods also contain the `callback` parameter.

The class `AsyncCallback` is responsible for passing the `callback` parameter. Let's consider an example for `ActionButton`:

### Overriding response handling

With the `responseHandler` parameter, you can completely redefine the behavior of response handling.
In the case of overriding, you take care of event calls, error handling, notifications, and more.

```php
ActionButton::make()
    ->method(
        'myMethod',
        callback: AsyncCallback::with(responseHandler: 'myResponseHandler')
    )
```

> [!NOTE]
> `responseHandler` takes full control of response handling, excluding the default behavior.

When clicking the button, a request will be sent to the method `myMethod`, and upon response, the function `myResponseHandler` will be called.

The next step is to declare this function in JS through the global class **MoonShine**:

```js
document.addEventListener("moonshine:init", () => {
    MoonShine.onCallback('myResponseHandler', function(response, element, events, component) {
        console.log('myResponseHandler', response, element, events, component)
    })
})
```

- `response` - response object,
- `element` - HTML element, in this case, the `ActionButton`,
- `events` - events that will be triggered,
- `component` - **Alpine.js** component.

### Call before request

Next, let's look at an example with the function before the request call through the `beforeRequest` parameter:

```php
ActionButton::make()
    ->method(
        'myMethod',
        callback: AsyncCallback::with(beforeRequest: 'myBeforeRequest')
    )
```

When the button is pressed, the function `myBeforeRequest` will be executed before sending the request to the method `myMethod`.

The next step is to declare this function in JS through the global class **MoonShine**:

```js
document.addEventListener("moonshine:init", () => {
    MoonShine.onCallback('myBeforeRequest', function(element, component) {
        console.log('myBeforeRequest', element, component)
    })
})
```

- `element` - HTML element, in this case, the `ActionButton`,
- `component` - **Alpine.js** component.

### Call after successful response

Next, let's look at an example with the `afterResponse` parameter, which takes the name of the function to be called after a successful response:

```php
ActionButton::make()
    ->method(
        'myMethod',
        callback: AsyncCallback::with(afterResponse: 'myAfterResponse')
    )
```

> [!NOTE]
> If you specified `responseHandler`, then the response handling behavior takes your function, and `afterResponse` will not be called.

When clicking the button, a request will be sent to the method `myMethod`, and in case of success, the function `myAfterResponse` will be called.

The next step is to declare this function in JS through the global class **MoonShine**:

```js
document.addEventListener("moonshine:init", () => {
    MoonShine.onCallback('myAfterResponse', function(data, messageType, component) {
        console.log('myAfterResponse', data, messageType, component)
    })
})
```

- `data` - JSON response,
- `messageType` - `ToastType`,
- `component` - **Alpine.js** component.
