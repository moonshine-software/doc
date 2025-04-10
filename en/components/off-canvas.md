# OffCanvas

- [Basics](#basics)
- [Events](#events)
  -  [Open/Close](#open-close)
- [Default State](#open)
- [Position](#position)
- [Width](#width)
- [Asynchronous](#async)
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
    {{ fake()->text() }}
</x-moonshine::off-canvas>
```
~~~

@include('_includes/modal-off-canvas-components', 'OffCanvas', 'OffCanvas', 'OffCanvas', 'OffCanvas')

<a name="events"></a>
## Events

You can show or hide the side panel outside of the component using *JavaScript* events.
To access the events, you need to set a unique name for the side panel using the `name()` method.

```php
use MoonShine\UI\Components\OffCanvas;

// ...

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

// ...
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
    ->toggleOffCanvs('my-canvas')

// or asynchronously
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

```php
this.$dispatch('off_canvas_toggled:my-canvas')
```

### Triggering Event Using Global MoonShine Class

```js
MoonShine.ui.toggleOffCanvas('my-canvas')
```

> [!NOTE]
> More detailed information can be found in the official Alpine.js documentation in the sections [Events](https://alpinejs.dev/essentials/events) and [$dispatch](https://alpinejs.dev/magics/dispatch).

<a name="open-close"></a>
### Open/Close

You can also add events when opening/closing the side panel using the `toggleEvents` method.

```php
toggleEvents(array $events, bool $onlyOpening = false, $onlyClosing = false)
```

```php
ActionButton::make('Open off-canvas')->toggleOffCanvas('my-off-canvas'),

OffCanvas::make('My OffCanvas', asyncUrl: '/')
    ->name('my-off-canvas')
    ->left()
    ->toggleEvents([
        AlpineJs::event(JsEvent::TOAST, params: ['text' => 'Hello off-canvas'])
    ]),
```

The parameters `onlyOpening` and `onlyClosing` allow you to configure whether events will be triggered on opening and closing. By default, both parameters are set to `TRUE`, meaning that the event list will be triggered both when opening and closing the side panel.

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
> The request will be sent only once, but if you need to send the request each time it opens, use the `alwaysLoad` method.

```php
OffCanvas::make(...)
        ->alwaysLoad(),
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
