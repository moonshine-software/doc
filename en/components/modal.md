# Modal

- [Basics](#basics)
- [Events](#events)
    - [Open/Close](#open-close)
- [Default State](#open)
- [Click Outside](#click-outside)
- [Auto Close](#auto-close)
- [Width](#width)
- [Asynchronicity](#async)
- [Outer Attributes](#outer-attributes)
- [Blade](#blade)

---

<a name="basics"></a>
## Basics

The `Modal` component allows you to create modal windows.
You can create a `Modal` using the static method `make()`.

```php
make(
    Closure|string $title = '',
    protected Closure|Renderable|string $content = '',
    protected Closure|Renderable|ActionButtonContract|string $outer = '',
    protected Closure|string|null $asyncUrl = null,
    iterable $components = [],
)
```

- `$title` - title of the modal window,
- `$content` - content of the modal window,
- `$outer` - external block with the trigger for the window,
- `$asyncUrl` - URL for asynchronous content,
- `$components` - components for the modal window.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Modal;

Modal::make(
    title: 'Confirm',
    content: 'Content'
)
```
tab: Blade
```blade
<x-moonshine::modal title="Title">
    <div>
        Content...
    </div>
    <x-slot name="outerHtml">
        <x-moonshine::link-button @click.prevent="toggleModal">
            Open modal
        </x-moonshine::link-button>
    </x-slot>
</x-moonshine::modal>
```
~~~

@preview('modal')

@include('_includes/modal-off-canvas-components', 'Modal', 'Modal', 'Modal', 'Modal')

<a name="events"></a>
## Events

You can open or close a modal window without using the component through `javascript` events.
To access the events, you must set a unique name for the modal window using the `name()` method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Modal;

// ...

protected function components(): iterable
{
    return [
        Modal::make(
            'Title',
            'Content',
        )
            ->name('my-modal'),
    ];
}

// ...
```

### Triggering an Event via ActionButton

The modal window's event can be triggered using the `ActionButton` component.

```php
Modal::make(
    'Title',
    'Content',
)
    ->name('my-modal'),

ActionButton::make('Show Modal')
    ->toggleModal('my-modal')

// or asynchronously
ActionButton::make(
    'Show Modal',
    '/endpoint'
)
    ->async(events: [AlpineJs::event(JsEvent::MODAL_TOGGLED, 'my-modal')])
```

### Triggering an Event Using Native Methods

Events can be triggered using native *javascript* methods:

```js
document.addEventListener("DOMContentLoaded", () => {
    this.dispatchEvent(new CustomEvent("modal_toggled:my-modal"))
})
```

### Triggering an Event with Alpine.js Method

Or using the magical method `$dispatch()` from *`alpine.js`:

```js
this.$dispatch('modal_toggled:my-modal')
```

### Triggering an Event with Global MoonShine Class

```js
MoonShine.ui.toggleModal('my-modal')
```

> [!NOTE]
> More detailed information can be found in the official Alpine.js documentation
> in the sections [Events](https://alpinejs.dev/essentials/events) and [$dispatch](https://alpinejs.dev/magics/dispatch).

<a name="open-close"></a>
### Open/Close

You can also add events when opening/closing the modal window using the `toggleEvents` method.

```php
toggleEvents(array $events, bool $onlyOpening = false, $onlyClosing = false)
```

```php
ActionButton::make('Open Modal')->toggleModal('my-modal'),

Modal::make('My Modal', asyncUrl: '/')
    ->name('my-modal')
    ->toggleEvents([
        AlpineJs::event(JsEvent::TOAST, params: ['text' => 'Hello'])
    ], onlyOpening: false, onlyClosing: true),
```

The parameters `onlyOpening` and `onlyClosing` allow you to configure whether events will fire on opening and closing.
By default, both parameters are set to `TRUE`, which means the event list will be triggered on both opening and closing of the modal.

<a name="open"></a>
## Default State

The `open()` method allows you to open the modal window when the page loads.

```php
open(Closure|bool|null $condition = null)
```

```php
Modal::make('Title', 'Content...', view('path'))
    ->open(),
```

> [!TIP]
> By default, the modal window will remain closed when the page loads.

<a name="close-outside"></a>
## Click Outside

By default, the modal window closes when clicking outside the window area. The `closeOutside()` method allows you to override this behavior.

```php
Modal::make('Title', 'Content...', ActionButton::make('Show Modal', '#'))
    ->closeOutside(false),
```

<a name="autoclose"></a>
## Auto Close

By default, modal windows close after a successful request (for example, when submitting a form).
The `autoClose()` method allows you to control this behavior.

```php
autoClose(Closure|bool|null $autoClose = null)
```

```php
Modal::make(
    'Demo Modal',
    static fn() => FormBuilder::make(route('alert.post'))
        ->fields([
            Text::make('Text'),
        ])
        ->submit('Submit', ['class' => 'btn-primary'])
        ->async(),
    )
    ->name('demo-modal')
    ->autoClose(false),
```

<a name="width"></a>
## Width

#### wide

The `wide()` method of the *Modal* component sets the maximum width of the modal window.

```php
wide(Closure|bool|null $condition = null)
```

```php
Modal::make('Title', 'Content...', ActionButton::make('Show Modal', '#'))
    ->wide(),
```

#### full

The `full()` method of the *Modal* component sets the full width of the modal window.

```php
full(Closure|bool|null $condition = null)
```

```php
Modal::make('Title', 'Content...', ActionButton::make('Show Modal', '#'))
    ->full(),
```

#### auto

The `auto()` method of the *Modal* component sets the width of the modal window based on the content.

```php
auto(Closure|bool|null $condition = null)
```

```php
Modal::make('Title', 'Content...', ActionButton::make('Show Modal', '#'))
    ->auto(),
```

<a name="async"></a>
## Asynchronicity

```php
Modal::make(
    'Title',
    '',
    ActionButton::make('Show Modal', '#'),
    asyncUrl: '/endpoint'
),
```

> [!NOTE]
> The request will be sent once, but if you need to send a request each time it opens, use the `alwaysLoad()` method.

```php
Modal::make(...)
    ->alwaysLoad(),
```

<a name="outer-attributes"></a>
## Outer Attributes

The `outerAttributes()` method allows you to set additional attributes for the external block `$outer`.

```php
outerAttributes(array $attributes)
```

```php
Modal::make('Title', 'Content...', ActionButton::make('Show Modal', '#'))
    ->outerAttributes([
        'class' => 'mt-2'
    ]),
```

<a name="blade"></a>
## Blade

The `moonshine::modal` component is used to create modal windows.

```blade
<x-moonshine::modal title="Title">
    <div>
        Content...
    </div>
    <x-slot name="outerHtml">
        <x-moonshine::link-button @click.prevent="toggleModal">
            Open modal
        </x-moonshine::link-button>
    </x-slot>
</x-moonshine::modal>
```

<a name="wide"></a>
### Wide Modal

The `wide` parameter allows modal windows to fill the entire width.

```blade
<x-moonshine::modal wide title="Title">
    <div>
        Content...
    </div>
    <x-slot name="outerHtml">
        <x-moonshine::link-button @click.prevent="toggleModal">
            Open wide modal
        </x-moonshine::link-button>
    </x-slot>
</x-moonshine::modal>
```

<a name="auto"></a>
### Auto Width

The `auto` parameter allows modal windows to take width based on content.

```blade
<x-moonshine::modal auto title="Title">
    <div>
        Content...
    </div>
    <x-slot name="outerHtml">
        <x-moonshine::link-button @click.prevent="toggleModal">
            Open auto modal
        </x-moonshine::link-button>
    </x-slot>
</x-moonshine::modal>
```

<a name="=close"></a>
### Closing Window

By default, modal windows close when clicking outside the window area.
You can override this behavior using the `closeOutside` parameter.

```blade
<x-moonshine::modal :closeOutside="false" title="Title">
    <div>
        Content...
    </div>
    <x-slot name="outerHtml">
        <x-moonshine::link-button @click.prevent="toggleModal">
            Open modal
        </x-moonshine::link-button>
    </x-slot>
</x-moonshine::modal>
```

<a name="async"></a>
### Asynchronous Content

The `moonshine::modal` component allows for loading content asynchronously.

```blade
<x-moonshine::modal
    async
    :asyncUrl="route('async')"
    title="Title"
>
    <x-slot name="outerHtml">
        <x-moonshine::link-button @click.prevent="toggleModal">
            Open async modal
        </x-moonshine::link-button>
    </x-slot>
</x-moonshine::modal>
```

## Subtitle in Modal

The `Modal` component now supports an optional subtitle, allowing you to provide additional context or information in the modal header.

### Usage

To set a subtitle for a modal, use the `subtitle()` method on the `Modal` component.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Modal;

Modal::make('Title')
    ->subtitle('This is a subtitle');
```

This will render a modal with both a title and a subtitle in the header.

### Blade Example

You can also set the subtitle directly in a Blade view:

```blade
<x-moonshine::modal title="Title" subtitle="This is a subtitle">
    <!-- Modal content -->
</x-moonshine::modal>
```

### Styling

The subtitle uses the following CSS variables for styling, which can be customized:

- `--ms-modal-subtitle-font-size`: Font size of the subtitle.
- `--ms-modal-subtitle-font-weight`: Font weight of the subtitle.
- `--ms-modal-subtitle-color`: Color of the subtitle text.

These variables provide flexibility in styling the subtitle to match your application's design.
