# Modal

- [Основы](#basics)
- [События](#events)
    - [Открытие/Закрытие](#open-close)
- [Состояние по умолчанию](#open)
- [Клик вне окна](#click-outside)
- [Автозакрытие](#auto-close)
- [Ширина](#width)
- [Асинхронность](#async)
- [Внешние атрибуты](#outer-attributes)
- [Blade](#blade)

---

<a name="basics"></a>
## Основы

Компонент `Modal` позволяет создавать модальные окна.
Вы можете создать `Modal`, используя статический метод `make()`.

```php
make(
    Closure|string $title = '',
    protected Closure|Renderable|string $content = '',
    protected Closure|Renderable|ActionButtonContract|string $outer = '',
    protected Closure|string|null $asyncUrl = null,
    iterable $components = [],
    protected string|null $subTitle = null
)
```

- `$title` - заголовок модального окна,
- `$content` - содержимое модального окна,
- `$outer` - внешний блок с обработчиком вызова окна,
- `$asyncUrl` - url для асинхронного контента,
- `$components` - компоненты для модального окна.
- `$subTitle` - подзаголовок модального окна.

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
## События

Вы можете открывать или закрывать модальное окно, не используя компонент, через события `javascript`.
Чтобы иметь доступ к событиям, вы должны установить уникальное имя для модального окна, используя метод `name()`.

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

### Вызов события через ActionButton

Событие модального окна может быть вызвано с помощью компонента `ActionButton`.

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

### Вызов события с использованием нативных методов

События могут быть вызваны с использованием нативных методов *javascript*:

```js
document.addEventListener("DOMContentLoaded", () => {
    this.dispatchEvent(new CustomEvent("modal_toggled:my-modal"))
})
```

### Вызов события с использованием метода Alpine.js

Или с использованием магического метода `$dispatch()` из *`alpine.js`:

```js
this.$dispatch('modal_toggled:my-modal')
```

### Вызов события с использованием глобального класса MoonShine

```js
MoonShine.ui.toggleModal('my-modal')
```

> [!NOTE]
> Более подробную информацию можно получить из официальной документации Alpine.js
> в разделах [Events](https://alpinejs.dev/essentials/events) и [$dispatch](https://alpinejs.dev/magics/dispatch).

<a name="open-close"></a>
### Открытие/Закрытие

Вы также можете добавить события при открытии/закрытии модального окна через метод `toggleEvents`

```php
toggleEvents(array $events, bool $onlyOpening = false, $onlyClosing = false)
```

```php
ActionButton::make('Open modal')->toggleModal('my-modal'),

Modal::make('My modal', asyncUrl: '/')
    ->name('my-modal')
    ->toggleEvents([
        AlpineJs::event(JsEvent::TOAST, params: ['text' => 'Hello'])
    ], onlyOpening: false, onlyClosing: true),
```

Параметры `onlyOpening` и `onlyClosing` позволяют настраивать, будут ли события срабатывать при открытии и закрытии.
По умолчанию оба параметра установлены в `TRUE`, что означает, что список событий будет вызываться как при открытии боковой панели, так и при её закрытии.

<a name="open"></a>
## Состояние по умолчанию

Метод `open()` позволяет открыть модальное окно при загрузке страницы.

```php
open(Closure|bool|null $condition = null)
```

```php
Modal::make('Title', 'Content...', view('path'))
    ->open(),
```

> [!TIP]
> По умолчанию модальное окно останется закрытым при загрузке страницы.

<a name="close-outside"></a>
## Клик вне окна

По умолчанию модальное окно закрывается при клике вне области окна. Метод `closeOutside()` позволяет переопределить это поведение.

```php
Modal::make('Title', 'Content...', ActionButton::make('Show Modal', '#'))
    ->closeOutside(false),
```

<a name="autoclose"></a>
## Автозакрытие

По умолчанию модальные окна закрываются после успешного запроса (к примеру при отправке формы).
Метод `autoClose()` позволяет управлять этим поведением.

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
## Ширина

#### wide

Метод `wide()` компонента *Modal* устанавливает максимальную ширину модального окна.

```php
wide(Closure|bool|null $condition = null)
```

```php
Modal::make('Заголовок', 'Содержимое...', ActionButton::make('Показать модальное окно', '#'))
    ->wide(),
```

#### full

Метод `full()` компонента *Modal* устанавливает полную ширину модального окна.

```php
full(Closure|bool|null $condition = null)
```

```php
Modal::make('Заголовок', 'Содержимое...', ActionButton::make('Показать модальное окно', '#'))
    ->full(),
```

#### auto

Метод `auto()` компонента *Modal* устанавливает ширину модального окна на основе содержимого.

```php
auto(Closure|bool|null $condition = null)
```

```php
Modal::make('Заголовок', 'Содержимое...', ActionButton::make('Показать модальное окно', '#'))
    ->auto(),
```

<a name="async"></a>
## Асинхронность

```php
Modal::make(
    'Title',
    '',
    ActionButton::make('Show Modal', '#'),
    asyncUrl: '/endpoint'
),
```

> [!NOTE]
> Запрос будет отправлен один раз, но если вам нужно отправлять запрос при каждом открытии, то используйте метод `alwaysLoad()`.

```php
Modal::make(...)
    ->alwaysLoad(),
```

<a name="outer-attributes"></a>
## Внешние атрибуты

Метод `outerAttributes()` позволяет установить дополнительные атрибуты для внешнего блока `$outer`.

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

Для создания модальных окон используется компонент `moonshine::modal`.

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
### Широкое окно

Параметр `wide` позволяет модальным окнам заполнять всю ширину.

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
### Автоматическая ширина

Параметр `auto` позволяет модальным окнам занимать ширину на основе содержимого.

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
### Закрытие окна

По умолчанию модальные окна закрываются при клике вне области окна.
Вы можете переопределить это поведение с помощью параметра `closeOutside`.

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
### Асинхронный контент

Компонент `moonshine::modal` позволяет загружать контент асинхронно.

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
