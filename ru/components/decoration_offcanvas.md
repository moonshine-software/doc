# Декоратор Offcanvas

  - [Создание](#make)
  - [События](#events)
  - [Состояние по умолчанию](#open)
  - [Позиция](#position)
  - [Атрибуты переключателя](#toggler-attributes)

---

<a name="make"></a> 
## Создание

Декоратор *Offcanvas* позволяет создавать боковые панели.
Вы можете создать *Offcanvas*, используя статический метод `make()`.

```php
make(Closure|string $title, Closure|View|string $content, Closure|string $toggler = '', Closure|string|null $asyncUrl = '')
```

- `$title` - заголовок боковой панели,
- `$content` - содержимое боковой панели,
- `$toggler` - заголовок для кнопки,
- `$asyncUrl` - url для асинхронного контента

```php
use MoonShine\Components\FormBuilder;
use MoonShine\Components\Offcanvas;
use MoonShine\Fields\Password;

//...

public function components(): array
{
    return [
        Offcanvas::make(
            'Подтвердить',
            static fn() => FormBuilder::make(route('password.confirm'))
                ->async()
                ->fields([
                    Password::make('Пароль')->eye(),
                ])
                ->submit('Подтвердить'),
            'Показать панель'
        )
    ];
}

//...
```

<a name="events"></a> 
## События

Вы можете показывать или скрывать боковую панель не из компонента через события *javascript*.
Чтобы иметь доступ к событиям, вы должны установить уникальное имя для боковой панели, используя метод `name()`.

```php
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make(
            'Заголовок',
            'Содержимое...'
        )
            ->name('my-canvas')
    ];
}

//...
```

#### вызов события через ActionButton

Событие боковой панели может быть вызвано с помощью компонента *ActionButton*.

```php
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make(
            'Заголовок',
            'Содержимое...',
        )
            ->name('my-canvas'),

        ActionButton::make(
            'Показать панель',
            '/endpoint'
        )
            ->async(events: ['offcanvas-toggled-my-canvas'])
    ];
}

//...
```

#### вызов события с использованием нативных методов

События могут быть вызваны с использованием нативных методов *javascript*:

```php
document.addEventListener("DOMContentLoaded", () => {
    this.dispatchEvent(new Event("offcanvas-toggled-my-canvas"))
})
```

#### вызов события с использованием метода Alpine.js

Или используйте магический метод `$dispatch()` из Alpine.js:

```php
this.$dispatch('offcanvas-toggled-my-canvas')
```

> [!NOTE]
> Более подробную информацию можно получить из официальной документации Alpine.js в разделах [Events](https://alpinejs.dev/essentials/events) и [$dispatch](https://alpinejs.dev/magics/dispatch).

<a name="open"></a> 
## Состояние по умолчанию

Метод `open()` позволяет показать боковую панель при загрузке страницы.

```php
open(Closure|bool|null $condition = null)
```

```php
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make('Заголовок', 'Содержимое...', 'Показать панель')
            ->open()
    ];
}

//...
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
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make('Заголовок', 'Содержимое...', 'Показать панель')
            ->left()
    ];
}

//...
```

<a name="toggler-attributes"></a> 
## Атрибуты переключателя

Метод `togglerAttributes()` позволяет установить дополнительные атрибуты для переключателя `$toggler`.

```php
togglerAttributes(array $attributes)
```

```php
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make('Заголовок', 'Содержимое...', 'Показать панель')
            ->togglerAttributes([
                'class' => 'mt-2'
            ]),
    ];
}

//...
```
