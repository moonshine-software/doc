# Flash

- [Basics](#basics)
- [Toast](#toast)

---

<a name="basics"></a>
## Basics

@include('_includes/note-about-appearance-layout')

The `Flash` component is designed to display different types of notifications that are stored in the session.

```php
make(
    string $key = 'alert',
    string|FlashType $type = FlashType::INFO,
    bool $withToast = true,
    bool $removable = true
)
```

 - `$key` - the key of the value from the session,
 - `$type` - the type of notification,
 - `$withToast` - adds toast notifications that can be displayed by adding the value `toast` to the session,
 - `$removable` - the notification can be closed.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Layout\Flash;

Flash::make()
```

<a name="toast"></a>
## Toast

To display toast notifications, it is necessary for the `$withToast` flag in the `Flash` component to be set to `true`.
Add the "toast" array to the session with the following values:

```php
session()->flash('toast', [
    'type' => FlashType::INFO->value,
    'message' => 'Info',
]);
```

When working asynchronously, you can trigger the notification using [JsEvents](/docs/{{version}}/frontend/js#default-events).

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use MoonShine\Support\AlpineJs;
use MoonShine\Support\Enums\JsEvent;
use MoonShine\Support\Enums\ToastType;
use MoonShine\Support\EventParams\ToastEventParams;

AlpineJs::event(
    JsEvent::TOAST,
    params: ToastEventParams::make(ToastType::SUCCESS, 'Success')
)
```
