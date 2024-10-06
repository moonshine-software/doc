https://moonshine-laravel.com/docs/resource/components/components-decoration_modal?change-moonshine-locale=en

------
# Decoration Modal

- [Make](#make)
- [Events](#events)
- [Default state](#default-state)
- [Click outside](#click-outside)
- [Auto close](#auto-close)
- [Width](#width)
- [Async](#async)
- [Outer attributes](#outer-attributes)

<a name="make"></a>
## Make

The *Modal* decorator allows you to create modal windows.
You can create *Modal* using the static method `make()`.

```php
make(
    Closure|string $title,
    Closure|View|string $content,
    Closure|View|ActionButton|string $outer = '',
    Closure|string|null $asyncUrl = '',
    MoonShineRenderElements|null $components = null
)
```

- `$title` - modal window title,
- `$content` - modal window content,
- `$outer` - external block with window call handler,
- `$asyncUrl` - url for asynchronous content,
- `$components` - components for a modal window.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\FormBuilder;
use MoonShine\Components\Modal;
use MoonShine\Fields\Password;
use MoonShine\Pages\PageComponents;

//...

public function components(): array
{
    return [
        Modal::make(
            title: 'Confirm',
            outer: ActionButton::make('Show modal', '#'),
            components: PageComponents::make([
                FormBuilder::make(route('password.confirm'))
                    ->async()
                    ->fields([
                        Password::make('Password')->eye(),
                    ])
                    ->submit('Confirm'),
            ])
        )
    ];
}
//...
```

<a name="events"></a>
## Events

You can open or close a modal window not using component via *javascript* events.
To have access to events, you must set a unique name for the modal window using the `name()` method.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make(
            'Title',
            'Content...',
        )
            ->name('my-modal'),
    ];
}

//...
```

#### calling an event via ActionButton

The modal window event can be triggered using the *ActionButton* component.

```php
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make(
            'Title',
            'Content...',
        )
            ->name('my-modal'),

        ActionButton::make(
            'Show modal',
            '#'
        )
            ->toggleModal('my-modal')

        // or async
        ActionButton::make(
            'Show modal',
            '/endpoint'
        )
            ->async(events: ['modal-toggled-my-modal'])
    ];
}

//...
```

#### calling an event using native methods

Events can be triggered using native *javascript* methods:

```js
document.addEventListener("DOMContentLoaded", () => {
    this.dispatchEvent(new Event("modal-toggled-my-modal"))
})
```

#### calling an event using the Alpine.js method

Or using the magic `$dispatch()` method from *Alpine.js*:

```js
this.$dispatch('modal-toggled-my-modal')
```

> [!NOTE]
> More detailed information can be obtained from the official Alpine.js documentation in the sections [Events](https://alpinejs.dev/essentials/events) and [$dispatch](https://alpinejs.dev/magics/dispatch).

<a name="open"></a>
## Default state

The `open()` method allows you to open a modal window when loading the page.

```php
open(Closure|bool|null $condition = null)
```

```php
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Title', 'Content...', view('path'))
            ->open(),
    ];
}

//...
```
> [!TIP]
> By default, the modal window will remain closed when the page loads..

<a name="close-outside"></a>
## Click outside

By default, a modal window closes when clicked outside the window area.The `closeOutside()` method allows you to override this behavior.

```php
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Title', 'Content...', ActionButton::make('Show modal', '#'))
            ->closeOutside(false),
    ];
}

//...
```
      
<a name="autoclose"></a>
## Auto close

By default, modal windows close after a successful request the `autoClose()` method allows you to control this behavior.

```php
autoClose(Closure|bool|null $autoClose = null)
```

```php
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make(
            'Demo modal',
            static fn() => FormBuilder::make(route('alert.post'))
                ->fields([
                    Text::make('Text'),
                ])
                ->submit('Send', ['class' => 'btn-primary'])
                ->async(),
        )
            ->name('demo-modal')
            ->autoClose(false),
    ];
}

//...
```

<a name="wide"></a>
## Width

#### wide

The `wide()` method of the *Modal* component sets the maximum width of the modal window.

```php
wide(Closure|bool|null $condition = null)
```

```php
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Title', 'Content...', ActionButton::make('Show modal', '#'))
            ->wide(),
    ];
}

//...
```

#### auto

The `auto()` method of the *Modal* component sets the width of the modal window based on the content.

```php
auto(Closure|bool|null $condition = null)
```

```php
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Title', 'Content...', ActionButton::make('Show modal', '#'))
            ->auto(),
    ];
}

//...
```

<a name="async"></a>
## Async

```php
Modal::make('Title', '', ActionButton::make('Show modal', '#'), asyncUrl: '/endpoint'),
```

> [!NOTE]
> The request will be sent once, but if you need to send a request every time you open it, then use the `data-always-load` attribute

```php
Modal::make(...)
        ->customAttributes(['data-always-load' => true]),
```

<a name="outer-attributes"></a>
## Outer attributes

The `outerAttributes()` method allows you to set additional attributes for the outer `$outer` block.

```php
outerAttributes(array $attributes)
```

```php
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Title', 'Content...', ActionButton::make('Show modal', '#'))
            ->outerAttributes([
                'class' => 'mt-2'
            ]),
    ];
}

//...
```
