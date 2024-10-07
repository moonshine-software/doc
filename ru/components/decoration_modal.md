# Декоратор Modal

- [Создание](#make)
- [События](#events)
- [Состояние по умолчанию](#default-state)
- [Клик вне окна](#click-outside)
- [Автозакрытие](#auto-close)
- [Ширина](#width)
- [Асинхронность](#async)
- [Внешние атрибуты](#outer-attributes)

---

<a name="make"></a>
## Создание

Декоратор *Modal* позволяет создавать модальные окна.
Вы можете создать *Modal*, используя статический метод `make()`.

```php
make(
    Closure|string $title,
    Closure|View|string $content,
    Closure|View|ActionButton|string $outer = '',
    Closure|string|null $asyncUrl = '',
    MoonShineRenderElements|null $components = null
)
```

- `$title` - заголовок модального окна,
- `$content` - содержимое модального окна,
- `$outer` - внешний блок с обработчиком вызова окна,
- `$asyncUrl` - url для асинхронного контента,
- `$components` - компоненты для модального окна.

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
            title: 'Подтвердить',
            outer: ActionButton::make('Показать модальное окно', '#'),
            components: PageComponents::make([
                FormBuilder::make(route('password.confirm'))
                    ->async()
                    ->fields([
                        Password::make('Пароль')->eye(),
                    ])
                    ->submit('Подтвердить'),
            ])
        )
    ];
}
//...
```

<a name="events"></a>
## События

Вы можете открывать или закрывать модальное окно, не используя компонент, через события *javascript*.
Чтобы иметь доступ к событиям, вы должны установить уникальное имя для модального окна, используя метод `name()`.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make(
            'Заголовок',
            'Содержимое...',
        )
            ->name('my-modal'),
    ];
}

//...
```

#### вызов события через ActionButton

Событие модального окна может быть вызвано с помощью компонента *ActionButton*.

```php
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make(
            'Заголовок',
            'Содержимое...',
        )
            ->name('my-modal'),

        ActionButton::make(
            'Показать модальное окно',
            '#'
        )
            ->toggleModal('my-modal')

        // или асинхронно
        ActionButton::make(
            'Показать модальное окно',
            '/endpoint'
        )
            ->async(events: ['modal-toggled-my-modal'])
    ];
}

//...
```

#### вызов события с использованием нативных методов

События могут быть вызваны с использованием нативных методов *javascript*:

```js
document.addEventListener("DOMContentLoaded", () => {
    this.dispatchEvent(new Event("modal-toggled-my-modal"))
})
```

#### вызов события с использованием метода Alpine.js

Или с использованием магического метода `$dispatch()` из *Alpine.js*:

```js
this.$dispatch('modal-toggled-my-modal')
```

> [!NOTE]
> Более подробную информацию можно получить из официальной документации Alpine.js в разделах [Events](https://alpinejs.dev/essentials/events) и [$dispatch](https://alpinejs.dev/magics/dispatch).

<a name="open"></a>
## Состояние по умолчанию

Метод `open()` позволяет открыть модальное окно при загрузке страницы.

```php
open(Closure|bool|null $condition = null)
```

```php
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Заголовок', 'Содержимое...', view('path'))
            ->open(),
    ];
}

//...
```
> [!TIP]
> По умолчанию модальное окно останется закрытым при загрузке страницы.

<a name="close-outside"></a>
## Клик вне окна

По умолчанию модальное окно закрывается при клике вне области окна. Метод `closeOutside()` позволяет переопределить это поведение.

```php
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Заголовок', 'Содержимое...', ActionButton::make('Показать модальное окно', '#'))
            ->closeOutside(false),
    ];
}

//...
```
      
<a name="autoclose"></a>
## Автозакрытие

По умолчанию модальные окна закрываются после успешного запроса. Метод `autoClose()` позволяет управлять этим поведением.

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
            'Демо модальное окно',
            static fn() => FormBuilder::make(route('alert.post'))
                ->fields([
                    Text::make('Текст'),
                ])
                ->submit('Отправить', ['class' => 'btn-primary'])
                ->async(),
        )
            ->name('demo-modal')
            ->autoClose(false),
    ];
}

//...
```

<a name="wide"></a>
## Ширина

#### wide

Метод `wide()` компонента *Modal* устанавливает максимальную ширину модального окна.

```php
wide(Closure|bool|null $condition = null)
```

```php
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Заголовок', 'Содержимое...', ActionButton::make('Показать модальное окно', '#'))
            ->wide(),
    ];
}

//...
```

#### auto

Метод `auto()` компонента *Modal* устанавливает ширину модального окна на основе содержимого.

```php
auto(Closure|bool|null $condition = null)
```

```php
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Заголовок', 'Содержимое...', ActionButton::make('Показать модальное окно', '#'))
            ->auto(),
    ];
}

//...
```

<a name="async"></a>
## Асинхронность

```php
Modal::make('Заголовок', '', ActionButton::make('Показать модальное окно', '#'), asyncUrl: '/endpoint'),
```

> [!NOTE]
> Запрос будет отправлен один раз, но если вам нужно отправлять запрос при каждом открытии, то используйте атрибут `data-always-load`

```php
Modal::make(...)
        ->customAttributes(['data-always-load' => true]),
```

<a name="outer-attributes"></a>
## Внешние атрибуты

Метод `outerAttributes()` позволяет установить дополнительные атрибуты для внешнего блока `$outer`.

```php
outerAttributes(array $attributes)
```

```php
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Заголовок', 'Содержимое...', ActionButton::make('Показать модальное окно', '#'))
            ->outerAttributes([
                'class' => 'mt-2'
            ]),
    ];
}

//...
```
