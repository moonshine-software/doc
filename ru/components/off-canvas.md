# OffCanvas

- [Основы](#basics)
- [События](#events)
  -  [События при открытии/закрытии](#events-when-open-close)
- [Состояние по умолчанию](#open)
- [Позиция](#position)
- [Ширина](#width)
- [Асинхронность](#async)
- [Автозакрытие](#autoclose)
- [Атрибуты переключателя](#toggler-attributes)

---

<a name="basics"></a>
## Основы

Компонент `Offcanvas` позволяет создавать боковые панели.
Вы можете создать `Offcanvas`, используя статический метод `make()`.

```php
make(
    Closure|string $title = '',
    Closure|Renderable|string $content = '',
    Closure|string $toggler = '',
    Closure|string|null $asyncUrl = null,
    iterable $components = [],
)
```

- `$title` - заголовок боковой панели,
- `$content` - содержимое боковой панели,
- `$toggler` - заголовок для кнопки,
- `$asyncUrl` - url для асинхронного контента,
- `$components` - компоненты

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

@include('_includes/modal-off-canvas-components', 'OffCanvas', 'OffCanvas', 'OffCanvas', 'OffCanvas')

<a name="events"></a>
## События

Вы можете инициировать открытие/закрытие боковой панели извне компонента через события *javascript*.
Чтобы иметь доступ к событиям, необходимо установить уникальное имя для боковой панели, используя метод `name()`.

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

### Вызов события через ActionButton

Событие боковой панели может быть вызвано с помощью компонента `ActionButton`.

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

### Вызов события с использованием нативных методов

События могут быть вызваны с использованием нативных методов *javascript*:

```php
document.addEventListener("DOMContentLoaded", () => {
    this.dispatchEvent(new CustomEvent("off_canvas_toggled:my-canvas"))
})
```

### Вызов события с использованием метода Alpine.js

Или используйте магический метод `$dispatch()` из Alpine.js:

```js
this.$dispatch('off_canvas_toggled:my-canvas')
```

### Вызов события с использованием глобального класса MoonShine

```js
MoonShine.ui.toggleOffCanvas('my-canvas')
```

> [!NOTE]
> Более подробную информацию можно получить из официальной документации Alpine.js
> в разделах [Events](https://alpinejs.dev/essentials/events) и [$dispatch](https://alpinejs.dev/magics/dispatch).

<a name="events-when-open-close"></a>
### События при открытии/закрытии

Вы также можете добавить события, которые будут вызываться при открытии/закрытии боковой панели, через метод `toggleEvents()`.

```php
toggleEvents(
    array $events,
    bool $onlyOpening = false,
    bool $onlyClosing = false
)
```

- `$events` - события,
- `$onlyOpening` - будут срабатывать только при открытии,
- `$onlyClosing` - будут срабатывать только при закрытии.

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
## Состояние по умолчанию

Метод `open()` позволяет показать боковую панель при загрузке страницы.

```php
open(Closure|bool|null $condition = null)
```

```php
OffCanvas::make('Title', 'Content...', 'Show Panel')
    ->open()
```

> [!TIP]
> По умолчанию боковая панель будет скрыта при загрузке страницы.

<a name="position"></a>
## Позиция

По умолчанию боковая панель расположена с правой стороны экрана, метод `left()` позволяет расположить панель с левой стороны.

```php
left(Closure|bool|null $condition = null)
```

```php
OffCanvas::make('Title', 'Content...', 'Show Panel')
    ->left()
```

<a name="width"></a>
## Ширина

Метод `wide()` компонента `OffCanvas` позволяет сделать боковую панель более широкой.

```php
wide(Closure|bool|null $condition = null)
```

- `$condition` - условие выполнения метода.

```php
OffCanvas::make('Title', 'Content...', 'Show Panel')
    ->wide()
```

Метод `full()` устанавливает максимальную ширину для боковой панели.

```php
full(Closure|bool|null $condition = null)
```

- `$condition` - условие выполнения метода.

```php
OffCanvas::make('Title', 'Content...', 'Show Panel')
    ->full()
```

<a name="async"></a>
## Асинхронность

```php
OffCanvas::make('Title', '', 'Show Panel', asyncUrl: '/endpoint'),
```

> [!NOTE]
> Запрос будет отправлен один раз, но если вам нужно отправлять запрос при каждом открытии, то используйте метод `alwaysLoad()`.

```php
OffCanvas::make(...)
    ->alwaysLoad(),
```

<a name="autoclose"></a>
## Автозакрытие

По умолчанию `OffCanvas` закрывается после успешной отправки асинхронной формы внутри него.
Метод `autoClose()` позволяет управлять этим поведением.

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
## Автозакрытие

По умолчанию боковые панели закрываются после успешного запроса (к примеру при отправке формы).
Метод `autoClose()` позволяет управлять этим поведением.

```php
autoClose(Closure|bool|null $autoClose = null)
```

```php
OffCanvas::make(
    'Заголовок',
    static fn() => FormBuilder::make(route('endpoint'))
        ->fields([
            Text::make('Text'),
        ])
        ->submit('Submit', ['class' => 'btn-primary'])
        ->async(),
    'Показать панель'
)
    ->autoClose(false),
```

<a name="toggler-attributes"></a>
## Атрибуты переключателя

Метод `togglerAttributes()` позволяет установить дополнительные атрибуты для переключателя `$toggler`.

```php
togglerAttributes(array $attributes)
```

```php
OffCanvas::make('Title', 'Content...', 'Show Panel')
    ->togglerAttributes([
        'class' => 'mt-2'
    ]),
```
