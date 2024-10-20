# Js

- [Основы](#basics)
- [События](#events)
  - [Blade директива](#blade-dir)
  - [AlpineJs хелпер](#helper)
  - [Стандартные события](#default-events)
  - [Вызов событий через Response](#response)
- [Response/Request callbacks](#callbacks)

# Основы

```html
<div x-data="myComponent">
</div>

<script>
	document.addEventListener("alpine:init", () => {
	Alpine.data("myComponent", () => ({
		init() {

		},
	}))
})
</script>
```
<a name="events"></a>
## События

<a name="blade-dir"></a>
## Blade директива

*Blade директивы* используются для быстрого объявления событий для компонентов.

### @defineEvent

```php
@defineEvent(string|JsEvent $event, ?string $name = null, ?string $call = null, array $params = [])
```
- `$event` - событие,
- `$name` - имя компонента,
- `$call` - функция обратного вызова,
- `$params` - параметры события.

```php
<div x-data="myComponent">
            // @table-updated-index.window="asyncRequest"
            @defineEvent('table-updated', 'index', 'asyncRequest')
            >
        </div>
```

### @defineEventWhen

```php
@defineEventWhen(mixed $condition, string|JsEvent $event, ?string $name = null, ?string $call = null, array $params = [])
```

- `$condition` - условие для события,
- `$event` - событие,
- `$name` - имя компонента,
- `$call` - функция обратного вызова,
- `$params` - параметры события.

```php
<div x-data="myComponent">
            // @table-updated-index.window="asyncRequest"
            @defineEventWhen(true, 'table-updated', 'index', 'asyncRequest')
            >
        </div>
```

<a name="helper"></a>
## Вспомогательный класс *AlpineJs* для формирования событий.

### AlpineJs::event()

```php
AlpineJs::event(string|JsEvent $event, ?string $name = null, array $params = [])
```
- `$event` - событие,
- `$name` - имя компонента,
- `$params` - параметры события

```php
use MoonShine\Components\FormBuilder;
        use MoonShine\Enums\JsEvent;
        use MoonShine\Support\AlpineJs;

        FormBuilder::make('/crud/update', 'PUT')
        ->name('main-form')
        ->async(asyncEvents: [AlpineJs::event(JsEvent::TABLE_UPDATED, 'index', ['var' => 'foo'])])
```

### AlpineJs::eventBlade()

```php
AlpineJs::eventBlade(string|JsEvent $event, ?string $name = null, ?string $call = null, array $params = [])
```

- `$event` - событие,
- `$name` - имя компонента,
- `$call` - функция обратного вызова,
- `$params` - параметры события

 ```php
 use MoonShine\Components\FormBuilder;
        use MoonShine\Enums\JsEvent;
        use MoonShine\Support\AlpineJs;

        FormBuilder::make('/crud/update', 'PUT')
        ->name('main-form')
        ->customAttributes([
        // @form-reset-main-form.window="formReset"
        AlpineJs::eventBlade(JsEvent::FORM_RESET, 'main-form') => 'formReset',
        ]);
```

<a name="#default-events"></a>
## Стандартные события

В админ-панели **MoonShine** определено несколько стандартных событий, названия которых удобно получать через enum *JsEvent*.

- `JsEvent::FRAGMENT_UPDATED` - обновление фрагмента,
- `JsEvent::TABLE_UPDATED` - обновление таблицы,
- `JsEvent::TABLE_REINDEX` - обновление индекса таблицы при сортировке,
- `JsEvent::TABLE_ROW_UPDATED` - обновление строки таблицы,
- `JsEvent::CARDS_UPDATED` - обновление списка карточек,
- `JsEvent::FORM_RESET` - сброс формы,
- `JsEvent::FORM_SUBMIT` - отправка формы,
- `JsEvent::MODAL_TOGGLED` - открытие / закрытие модального окна,
- `JsEvent::OFF_CANVAS_TOGGLED` - открытие / закрытие Offcanvas,
- `JsEvent::TOAST` - вызов Toast.

<a name="#response"></a>
## Вызов событий через Response

В **MoonShine** можно возвращать события в *MoonShineJsonResponse*, которые затем будут вызваны.
Для этого нужно использовать метод `events()`.

```php
events(array $events)
```

- `$events` - массив событий, которые нужно вызвать.

```php
use MoonShine\Enums\JsEvent;
use MoonShine\Http\Responses\MoonShineJsonResponse;
use MoonShine\Support\AlpineJs;

//...

return MoonShineJsonResponse::make()
->events([
AlpineJs::event(JsEvent::TABLE_UPDATED, 'index'),
]);
```

# Response/Request

AsyncCallback
MoonShine::onCallback
