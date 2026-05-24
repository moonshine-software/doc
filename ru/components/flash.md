# Flash

- [Основы](#basics)
- [Toast](#toast)

---

<a name="basics"></a>
## Основы

@include('_includes/note-about-appearance-layout')

Компонент `Flash` предназначен для вывода разных типов уведомлений, которые содержаться в сессии.

```php
make(
    string $key = 'alert',
    string|FlashType $type = FlashType::INFO,
    bool $withToast = true,
    bool $removable = true
)
```

 - `$key` - ключ значения из сессии,
 - `$type` - тип уведомления,
 - `$withToast` - добавляет всплывающие уведомления, которые можно вывести, добавив в сессию значение `toast`,
 - `$removable` - уведомление можно закрыть.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Layout\Flash;

Flash::make()
```

<a name="toast"></a>
## Toast

Чтобы вывести всплывающие уведомления, необходим, чтобы в компоненте `Flash` флаг `$withToast` был в значении `true`.
Добавьте массив "toast" в сессию со следующими значениями:

```php
session()->flash('toast', [
    'type' => FlashType::INFO->value,
    'message' => 'Info',
]);
```

Работая в асинхронном режиме, уведомление можно вызвать с помощью [JsEvents](/docs/{{version}}/frontend/js#default-events).

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
