# Decoration Offcanvas

  - [Make](#make)
  - [Events](#events)
  - [Default state](#open)
  - [Position](#position)
  - [Toggler attributes](#toggler-attributes)

---

<a name="make"></a> 
## Make

The *Offcanvas* decorator allows you to create sidebars.
You can create *Offcanvas* using the static `make()` method.

```php
make(Closure|string $title, Closure|View|string $content, Closure|string $toggler = '', Closure|string|null $asyncUrl = '')
```

- `$title` - sidebar title,
- `$content` - sidebar content,
- `$toggler` - title for button,
- `$asyncUrl` - url for asynchronous content

```php
use MoonShine\Components\FormBuilder;
use MoonShine\Components\Offcanvas;
use MoonShine\Fields\Password;

//...

public function components(): array
{
    return [
        Offcanvas::make(
            'Confirm',
            static fn() => FormBuilder::make(route('password.confirm'))
                ->async()
                ->fields([
                    Password::make('Password')->eye(),
                ])
                ->submit('Confirm'),
            'Show canvas'
        )
    ];
}

//...
```

<a name="events"></a> 
## Events

You can show or hide a sidebar not from a component through *javascript* events.
To have access to events, you must set a unique name for the sidebar using the `name()` method.

```php
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make(
            'Title',
            'Content...'
        )
            ->name('my-canvas')
    ];
}

//...
```

#### calling an event via ActionButton

The sidebar event can be triggered using the *ActionButton* component.

```php
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make(
            'Title',
            'Content...',
        )
            ->name('my-canvas'),

        ActionButton::make(
            'Show canvas',
            '/endpoint'
        )
            ->async(events: ['offcanvas-toggled-my-canvas'])
    ];
}

//...
```

#### calling an event using native methods

Events can be triggered using native *javascript* methods:

```php
document.addEventListener("DOMContentLoaded", () => {
    this.dispatchEvent(new Event("offcanvas-toggled-my-canvas"))
})
```

#### calling an event using the Alpine.js method

Or use the magic `$dispatch()` method from Alpine.js:

```php
this.$dispatch('offcanvas-toggled-my-canvas')
```

> [!NOTE]
> More detailed information can be obtained from the official Alpine.js documentation in the sections [Events](https://alpinejs.dev/essentials/events) and [$dispatch](https://alpinejs.dev/magics/dispatch).

<a name="open"></a> 
## Default state

The `open()` method allows you to show the sidebar when the page loads.

```php
open(Closure|bool|null $condition = null)
```

```php
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make('Title', 'Content...', 'Show canvas')
            ->open()
    ];
}

//...
```

> [!TIP]
> By default, the sidebar will be hidden when the page loads.

<a name="position"></a> 
##  Position

By default, the sidebar is located on the right side of the screen, the `left()` method allows you to position the panel on the left side.

```php
left(Closure|bool|null $condition = null)
```

```php
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make('Title', 'Content...', 'Show canvas')
            ->left()
    ];
}

//...
```

<a name="toggler-attributes"></a> 
##  Toggler attributes

The `toggler Attributes()` method allows you to set additional attributes for the `$toggler` toggle.

```php
togglerAttributes(array $attributes)
```

```php
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make('Title', 'Content...', 'Show canvas')
            ->togglerAttributes([
                'class' => 'mt-2'
            ]),
    ];
}

//...
```




