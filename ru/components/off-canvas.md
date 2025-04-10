# OffCanvas

- [Основы](#basics)
- [События](#events)
  -  [Открытие/Закрытие](#open-close)
- [Состояние по умолчанию](#open)
- [Позиция](#position)
- [Ширина](#width)
- [Асинхронность](#async)
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
use MoonShine\UI\Components\OffCanvas;

OffCanvas::make(
    'Подтвердить',
    static fn() => FormBuilder::make(route('password.confirm'))
        ->async()
        ->fields([
            Password::make('Пароль')->eye(),
        ])
        ->submit('Подтвердить'),
    'Показать панель'
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
## События

Вы можете показывать или скрывать боковую панель не из компонента через события *javascript*.
Чтобы иметь доступ к событиям, необходимо установить уникальное имя для боковой панели, используя метод `name()`.

```php
use MoonShine\UI\Components\OffCanvas;

// ...

protected function components(): iterable
{
    return [
        Offcanvas::make(
            'Заголовок',
            'Содержимое...'
        )
            ->name('my-canvas')
    ];
}

// ...
```

### Вызов события через ActionButton

Событие боковой панели может быть вызвано с помощью компонента `ActionButton`.

```php
Offcanvas::make(
    'Заголовок',
    'Содержимое...',
)
    ->name('my-canvas'),

ActionButton::make('Показать модальное окно')
    ->toggleOffCanvs('my-canvas')

// или асинхронно
ActionButton::make(
    'Показать панель',
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

```php
this.$dispatch('off_canvas_toggled:my-canvas')
```

### Вызов события с использованием глобального класса MoonShine

```js
MoonShine.ui.toggleOffCanvas('my-canvas')
```

> [!NOTE]
> Более подробную информацию можно получить из официальной документации Alpine.js в разделах [Events](https://alpinejs.dev/essentials/events) и [$dispatch](https://alpinejs.dev/magics/dispatch).

<a name="open-close"></a>
### Открытие/Закрытие

Вы также можете добавить события при открытии/закрытии боковой панели через метод `toggleEvents`

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

Параметры `onlyOpening` и `onlyClosing` позволяют настраивать, будут ли события срабатывать при открытии и закрытии. По умолчанию оба параметра установлены в `TRUE`, что означает, что список событий будет вызываться как при открытии боковой панели, так и при её закрытии.

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
OffCanvas::make('Заголовок', '', 'Показать панель', asyncUrl: '/endpoint'),
```

> [!NOTE]
> Запрос будет отправлен один раз, но если вам нужно отправлять запрос при каждом открытии, то используйте метод `alwaysLoad`

```php
OffCanvas::make(...)
        ->alwaysLoad(),
```

<a name="toggler-attributes"></a>
## Атрибуты переключателя

Метод `togglerAttributes()` позволяет установить дополнительные атрибуты для переключателя `$toggler`.

```php
togglerAttributes(array $attributes)
```

```php
OffCanvas::make('Заголовок', 'Содержимое...', 'Показать панель')
    ->togglerAttributes([
        'class' => 'mt-2'
    ]),
```
