https://moonshine-laravel.com/docs/resource/advanced/advanced-js_events?change-moonshine-locale=en

------

# Js events

- [Js events](#js-events)
  - [Blade directive](#blade-dir)
  - [Помощник AlpineJs](#helper)
  - [События по умолчанию](#default-events)
  - [Вызов событий через Response](#response)

<a name="blade-directive"></a>
## Blade directive

*Blade-директивы<* используются для быстрого объявления событий у компонентов.

### @defineEvent

```php
@defineEvent(string|JsEvent $event, ?string $name = null, ?string $call = null, array $params = [])
```
- `$event` - событие,
- `$name` - название компонента,
- `$call` - callback функция,
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
- `$name` - название компонента,
- `$call` - callback функция.
- `$params` - параметры события.                

```php
<div x-data="myComponent">
            // @table-updated-index.window="asyncRequest"
            @defineEventWhen(true, 'table-updated', 'index', 'asyncRequest')
            >
        </div>
```

<a name="helper"></a>
## *AlpineJs* класс-помощник, для формирования событий.

### AlpineJs::event()

```php
AlpineJs::event(string|JsEvent $event, ?string $name = null, array $params = [])
```
- `$event` - событие,
- `$name` - название компонента,
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
- `$name` - название компонента,
- `$call` - callback функция.
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
## События по умолчанию

В админ-панели **MoonShine** определены несколько событий по умолчанию,названия которых можно удобно получить через enum *JsEvent*.

- `JsEvent::FRAGMENT_UPDATED` - обновление фрагмента,
- `JsEvent::TABLE_UPDATED` - обновление таблицы,
- `JsEvent::TABLE_REINDEX` - обновление индексов таблицы при сортировке,<
- `JsEvent::TABLE_ROW_UPDATED` - обновление строки в таблице,
- `JsEvent::CARDS_UPDATED` - обновление списка Сards,
- `JsEvent::FORM_RESET` - сброс формы,
- `JsEvent::FORM_SUBMIT` - отправка формы,
- `JsEvent::MODAL_TOGGLED` - открытие / закрытие модального окна,
- `JsEvent::OFF_CANVAS_TOGGLED` - открытие / закрытие Offcanvas,
- `JsEvent::TOAST` - вызов Toast.

<a name="#response"></a>
## Вызов событий через Response

В **MoonShine** можно вернуть события в *MoonShineJsonResponse*, которые потом будут вызваны.
Для этого необходимо воспользоваться методом `events()`.
           
```php
events(array $events)
```

- `$events` - массив вызываемых событий.

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
