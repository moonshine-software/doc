https://moonshine-laravel.com/docs/resource/advanced/advanced-js_events?change-moonshine-locale=en

------

# Js events

- [Js events](#js-events)
  - [Blade directive](#blade-dir)
  - [AlpineJs helper](#helper)
  - [Default events](#default-events)
  - [Triggering events through Response](#response)

<a name="blade-directive"></a>
## Blade directive

*Blade directives* are used for quick declaration of events for components.

### @defineEvent

```php
@defineEvent(string|JsEvent $event, ?string $name = null, ?string $call = null, array $params = [])
```
- `$event` - event,
- `$name` - component name,
- `$call` - callback function,
- `$params` - event parameters.

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

- `$condition` - condition for the event,
- `$event` - event,
- `$name` - component name,
- `$call` - callback function,
- `$params` - event parameters.                

```php
<div x-data="myComponent">
            // @table-updated-index.window="asyncRequest"
            @defineEventWhen(true, 'table-updated', 'index', 'asyncRequest')
            >
        </div>
```

<a name="helper"></a>
## *AlpineJs* helper class for forming events.

### AlpineJs::event()

```php
AlpineJs::event(string|JsEvent $event, ?string $name = null, array $params = [])
```
- `$event` - event,
- `$name` - component name,
- `$params` - event parameters

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

- `$event` - event,
- `$name` - component name,
- `$call` - callback function,
- `$params` - event parameters

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
## Default events

In the **MoonShine** admin panel, several default events are defined, whose names can be conveniently obtained through the *JsEvent* enum.

- `JsEvent::FRAGMENT_UPDATED` - fragment update,
- `JsEvent::TABLE_UPDATED` - table update,
- `JsEvent::TABLE_REINDEX` - table index update during sorting,
- `JsEvent::TABLE_ROW_UPDATED` - table row update,
- `JsEvent::CARDS_UPDATED` - Cards list update,
- `JsEvent::FORM_RESET` - form reset,
- `JsEvent::FORM_SUBMIT` - form submission,
- `JsEvent::MODAL_TOGGLED` - modal window opening / closing,
- `JsEvent::OFF_CANVAS_TOGGLED` - Offcanvas opening / closing,
- `JsEvent::TOAST` - Toast call.

<a name="#response"></a>
## Triggering events through Response

In **MoonShine**, you can return events in *MoonShineJsonResponse*, which will then be triggered.
To do this, you need to use the `events()` method.
           
```php
events(array $events)
```

- `$events` - array of events to be triggered.

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
