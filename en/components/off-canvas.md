# OffCanvas

- [Basics](#basics)
- [Events](#events)
  -  [Events when opening/closing](#events-when-open-close)
- [Default State](#open)
- [Position](#position)
- [Width](#width)
- [Asynchronous](#async)
- [Auto Close](#autoclose)
- [Toggler Attributes](#toggler-attributes)

---

<a name="basics"></a>
## Basics

The `Offcanvas` component allows you to create side panels.
You can create an `Offcanvas` using the static method `make()`.

```php
make(
    Closure|string $title = '',
    Closure|Renderable|string $content = '',
    Closure|string $toggler = '',
    Closure|string|null $asyncUrl = null,
    iterable $components = [],
)
```

- `$title` - the title of the side panel,
- `$content` - the content of the side panel,
- `$toggler` - the title for the button,
- `$asyncUrl` - the URL for asynchronous content,
- `$components` - components

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\OffCanvas;

OffCanvas::make(
    'Confirm',
    static fn() => FormBuilder::make(route('password.confirm'))
        ->async()
        ->fields([
            Password::make('Password')->eye(),
        ])
        ->submit('Confirm'),
    'Show Panel'
)
```
tab: Blade
```blade
<x-moonshine::off-canvas
    title="Offcanvas"
    :left="false"
>
    <x-slot:toggler>
         Open
    </x-slot:toggler>
    Content
</x-moonshine::off-canvas>
```
~~~

@preview('off-canvas')

@include('_includes/modal-off-canvas-components', 'OffCanvas', 'OffCanvas', 'OffCanvas', 'OffCanvas')

<a name="events"></a>
## Events

You can trigger the opening/closing of the sidebar from outside the component via *javascript* events.
To access the events, you need to set a unique name for the side panel using the `name()` method.

```php
protected function components(): iterable
{
    return [
        Offcanvas::make(
            'Title',
            'Content...'
        )
            ->name('my-canvas')
    ];
}
```

### Triggering Event via ActionButton

The side panel event can be triggered using the `ActionButton` component.

```php
Offcanvas::make(
    'Title',
    'Content...',
)
    ->name('my-canvas'),

ActionButton::make('Show Modal')
    ->toggleOffCanvas('my-canvas')

// or async
ActionButton::make(
    'Show Panel',
    '/endpoint'
)
    ->async(events: [AlpineJs::event(JsEvent::OFF_CANVAS_TOGGLED, 'my-canvas')])
```

### Triggering Event Using Native Methods

Events can be triggered using native *JavaScript* methods:

```php
document.addEventListener("DOMContentLoaded", () => {
    this.dispatchEvent(new CustomEvent("off_canvas_toggled:my-canvas"))
})
```

### Triggering Event Using Alpine.js Method

Or use the magic method `$dispatch()` from Alpine.js:

```js
this.$dispatch('off_canvas_toggled:my-canvas')
```

### Triggering Event Using Global MoonShine Class

```js
MoonShine.ui.toggleOffCanvas('my-canvas')
```

> [!NOTE]
> More detailed information can be found in the official Alpine.js documentation
> in the sections [Events](https://alpinejs.dev/essentials/events) and [$dispatch](https://alpinejs.dev/magics/dispatch).

<a name="events-when-open-close"></a>
### Events when opening/closing

You can also add events when opening/closing the side panel using the `toggleEvents()` method.

```php
toggleEvents(
    array $events,
    bool $onlyOpening = false,
    bool $onlyClosing = false
)
```

- `$events` - events,
- `$onlyOpening` - will only fire when opening,
- `$onlyClosing` - will only fire when closing.

```php
ActionButton::make('Open off-canvas')
    ->toggleOffCanvas('my-off-canvas'),

OffCanvas::make('My OffCanvas', asyncUrl: '/')
    ->name('my-off-canvas')
    ->toggleEvents([
        AlpineJs::event(
            JsEvent::TOAST,
            params: ['text' => 'Hello off-canvas']
        )
    ]),
```

<a name="open"></a>
## Default State

The `open()` method allows you to show the side panel on page load.

```php
open(Closure|bool|null $condition = null)
```

```php
OffCanvas::make('Title', 'Content...', 'Show Panel')
    ->open()
```

> [!TIP]
> By default, the side panel will be hidden on page load.

<a name="position"></a>
## Position

By default, the side panel is positioned on the right side of the screen; the `left()` method allows you to position the panel on the left side.

```php
left(Closure|bool|null $condition = null)
```

```php
OffCanvas::make('Title', 'Content...', 'Show Panel')
    ->left()
```

<a name="width"></a>
## Width

The `wide()` method of the `OffCanvas` component allows you to make the panel wider.

```php
wide(Closure|bool|null $condition = null)
```

- `$condition` - method execution condition.

```php
OffCanvas::make('Title', 'Content...', 'Show Panel')
    ->wide()
```

The `full()` method sets the maximum width for the panel.

```php
full(Closure|bool|null $condition = null)
```

- `$condition` - method execution condition.

```php
OffCanvas::make('Title', 'Content...', 'Show Panel')
    ->full()
```

<a name="async"></a>
## Asynchronous

```php
OffCanvas::make('Title', '', 'Show Panel', asyncUrl: '/endpoint'),
```

> [!NOTE]
> The request will be sent only once, but if you need to send the request each time it opens, use the `alwaysLoad()` method.

```php
OffCanvas::make(...)
    ->alwaysLoad(),
```

<a name="autoclose"></a>
## Auto Close

By default, `OffCanvas` closes after the asynchronous form inside it has been successfully submitted.
The `autoClose()` method allows you to control this behavior.

```php
autoClose(Closure|bool|null $autoClose = null)
```

```php
OffCanvas::make(
    'Demo OffCanvas',
    static fn() => FormBuilder::make(route('alert.post'))
        ->fields([
            Text::make('Text'),
        ])
        ->submit('Submit', ['class' => 'btn-primary'])
        ->async(),
    )
    ->name('demo-offcanvas')
    ->autoClose(false),
```

<a name="auto-close"></a>
## Auto Close

By default, off-canvas panels close after a successful request (for example, when submitting a form).
The `autoClose()` method allows you to control this behavior.

```php
autoClose(Closure|bool|null $autoClose = null)
```

```php
OffCanvas::make(
    'Title',
    static fn() => FormBuilder::make(route('endpoint'))
        ->fields([
            Text::make('Text'),
        ])
        ->submit('Submit', ['class' => 'btn-primary'])
        ->async(),
    'Show Panel'
)
    ->autoClose(false),
```

<a name="toggler-attributes"></a>
## Toggler Attributes

The `togglerAttributes()` method allows you to set additional attributes for the toggler `$toggler`.

```php
togglerAttributes(array $attributes)
```

```php
OffCanvas::make('Title', 'Content...', 'Show Panel')
    ->togglerAttributes([
        'class' => 'mt-2'
    ]),
```
