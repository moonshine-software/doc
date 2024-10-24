# Js

- [Основы](#basics)
- [Создание компонента](#component)
- [События](#events)
  - [Стандартные события](#default-events)
  - [Вызов событий](#call-events)
  - [Вызов событий через Response](#response-events)
  - [Blade директива](#blade-dir)
  - [Вспомогательный класс AlpineJs](#helper)
- [Обработка ответа](#response-callback)

<a name="basics"></a>
# Основы

`Alpine.js` интегрирован в `MoonShine` "из коробки" и предоставляет декларативный подход к созданию динамического поведения прямо в HTML-разметке.
Это позволяет легко добавлять такие функции как:

- Динамическое скрытие/отображение элементов
- Обработка событий
- Реактивность
- Асинхронные запросы
- Анимации и переходы

Благодаря своей легковесности и простоте синтаксиса, `Alpine.js` отлично подходит для задач админ-панели, не утяжеляя при этом ваше приложение.

> [!NOTE]
> Несмотря на то, что `Alpine.js` является рекомендуемым решением для MoonShine, вы не ограничены в выборе JavaScript-инструментов или использования ванильного js. 

> [!TIP]
> Рекомендуем ознакомится с [Alpine.js](https://alpinejs.dev)

<a name="components"></a>
# Создание компонента

Давайте попробуем создать собственный компонент.

```shell
php artisan moonshine:component MyComponent
```

Путь оставим как предлагает `MoonShine` - `/resources/views/admin/components/my-component.blade.php`.
Внутри добавим `x-data` с наименованием нашего компонента, тем самым мы укажем, что область внутри является `Alpine.js` компонентом

```html
<div x-data="myComponent">
</div>
```

Далее создадим скрипт, где в дальнейшем реализуем логику `Alpine.js` компонента 

```html
<script>
document.addEventListener("alpine:init", () => {
  Alpine.data("myComponent", () => ({
      init() {

      },
  }))
})
</script>
```

Для наглядности мы показали вам скрипт прямо в `blade`, 
но рекомендуем выносить компоненты в отдельные `js` файлы и подключать их через [AssetManager](/docs/{{version}}/appearance/assets)

> [!WARNING]
> Alpine.js уже установлен и запущен (window.Alpine), повторная инициализация приведет к ошибке

<a name="events"></a>
## События

Благодаря `js` событиям вы можете удобно взаимодействовать с `MoonShine`! Обновлять формы, таблица, области, вызывать модальные окна, сбрасывать формы и многое другое. 
Вы также можете создавать собственные события в `js`.

<a name="#default-events"></a>
### Стандартные события

В админ-панели `MoonShine` определено несколько стандартных событий, названия которых удобно получать через `enum` `JsEvent`, но вы также можете их вызвать из `js`.

- `fragment_updated:{componentName}`(`JsEvent::FRAGMENT_UPDATED`) - обновление фрагмента,
- `table_updated:{componentName}`(`JsEvent::TABLE_UPDATED`) - обновление таблицы,
- `table_reindex:{componentName}`(`JsEvent::TABLE_REINDEX`) - обновление индекса таблицы при сортировке,
- `table_row_updated:{componentName}-{row-id}`(`JsEvent::TABLE_ROW_UPDATED`) - обновление строки таблицы,
- `cards_updated:{componentName}`(`JsEvent::CARDS_UPDATED`) - обновление списка карточек,
- `form_reset:{componentName}`(`JsEvent::FORM_RESET`) - сброс формы,
- `form_submit:{componentName}`(`JsEvent::FORM_SUBMIT`) - отправка формы,
- `modal_toggled:{componentName}`(`JsEvent::MODAL_TOGGLED`) - открытие / закрытие модального окна,
- `off_canvas_toggled:{componentName}`(`JsEvent::OFF_CANVAS_TOGGLED`) - открытие / закрытие `OffCanvas`,
- `popover_toggled:{componentName}`(`JsEvent::POPOVER_TOGGLED`) - открытие / закрытие `OffCanvas`,
- `toast:{componentName}`(`JsEvent::TOAST`) - вызов Toast,
- `show_when_refresh:{componentName}`(`JsEvent::SHOW_WHEN_REFRESH`) - обновить состояния `showWhen`,

<a name="#call-events"></a>
### Вызов событий

Давайте вспомним как это делается на стороне `backend`:

```php
Modal::make(
  'Заголовок',
  'Содержимое',
)
->name('my-modal'),

ActionButton::make(
    'Показать модальное окно',
    '/endpoint'
)
    ->async(events: [AlpineJs::event(JsEvent::MODAL_TOGGLED, 'my-modal')])
```

Но раздел посвящен `frontend` и события могут быть вызваны с использованием нативных методов *javascript*:

```js
document.addEventListener("DOMContentLoaded", () => {
    this.dispatchEvent(new Event("modal_toggled:my-modal"))
})
```

Или с использованием магического метода `$dispatch()` из *`alpine.js`:

```js
this.$dispatch('modal_toggled:my-modal')
```

> [!NOTE]
> Более подробную информацию можно получить из официальной документации Alpine.js в разделах [Events](https://alpinejs.dev/essentials/events) и [$dispatch](https://alpinejs.dev/magics/dispatch).

<a name="#response-events"></a>
### Вызов событий через Response

В **MoonShine** можно возвращать события в *MoonShineJsonResponse*, которые затем будут вызваны.
Для этого нужно использовать метод `events()`.

```php
events(array $events)
```

- `$events` - массив событий, которые нужно вызвать.

```php
use MoonShine\Support\Enums\JsEvent;
use MoonShine\Laravel\Http\Responses\MoonShineJsonResponse;
use MoonShine\Support\AlpineJs;

//...

return MoonShineJsonResponse::make()
  ->events([
    AlpineJs::event(JsEvent::TABLE_UPDATED, 'index'),
  ]);
```

<a name="blade-dir"></a>
### Blade директива

*Blade директивы* используются для быстрого объявления событий для компонентов.

#### @defineEvent

Директива для удобного объявления события в `html`

```php
@defineEvent(string|JsEvent $event, ?string $name = null, ?string $call = null, array $params = [])
```
- `$event` - событие,
- `$name` - имя компонента,
- `$call` - функция обратного вызова,
- `$params` - параметры события.

```html
<div x-data="myComponent">
    // @table-updated-index.window="asyncRequest"
    @defineEvent('table-updated', 'index', 'asyncRequest')
    >
</div>
```

#### @defineEventWhen

С условием, будет ли добавлено или нет

```php
@defineEventWhen(mixed $condition, string|JsEvent $event, ?string $name = null, ?string $call = null, array $params = [])
```

- `$condition` - условие,
- `$event` - событие,
- `$name` - имя компонента,
- `$call` - функция обратного вызова,
- `$params` - параметры события.

```html
<div x-data="myComponent">
    // @table-updated-index.window="asyncRequest"
    @defineEventWhen(true, 'table-updated', 'index', 'asyncRequest')
    >
</div>
```

<a name="helper"></a>
### Вспомогательный класс *AlpineJs* для формирования событий.

#### AlpineJs::event()

```php
AlpineJs::event(string|JsEvent $event, ?string $name = null, array $params = [])
```

- `$event` - событие,
- `$name` - имя компонента,
- `$params` - параметры события

```php
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Support\Enums\JsEvent;
use MoonShine\Support\AlpineJs;

FormBuilder::make('/crud/update')
  ->name('main-form')
  ->async(events: [AlpineJs::event(JsEvent::TABLE_UPDATED, 'index', ['var' => 'foo'])])
```

#### AlpineJs::eventBlade()

```php
AlpineJs::eventBlade(string|JsEvent $event, ?string $name = null, ?string $call = null, array $params = [])
```

- `$event` - событие,
- `$name` - имя компонента,
- `$call` - функция обратного вызова,
- `$params` - параметры события

 ```php
FormBuilder::make('/crud/update')
  ->name('main-form')
  ->customAttributes([
    // @form-reset-main-form.window="formReset"
    AlpineJs::eventBlade(JsEvent::FORM_RESET, 'main-form') => 'formReset',
  ]);
```

<a name="response-calback"></a>
# Обработка ответа

`MoonShine` позволяет интегрироваться в процесс выполнения асинхронных запросов в `js`, указывая какая функция выполниться перед запросом и после получения ответа.

`ActionButton`, `FormBuilder`, `TableBuilder`, `Field` и другие компоненты реализующие интерфейс `HasAsyncContract` в `async` методах также содержат параметр `callback`.

За передачу параметра `callback` отвечает класс `AsyncCallback`. Давайте рассмотрим пример для `ActionButton`:

```php
ActionButton::make()->method('myMethod', callback: AsyncCallback::with(success: 'myResponseCallback'));
```

Мы при клике на кнопку отправим запрос в метод myMethod и при успешном ответе вызовем функцию myResponseCallback.

Следующий шаг - необходимо объявить эту функцию в `js` через глобальный класс `MoonShine`:

```js
document.addEventListener("moonshine:init", () => {
  MoonShine.onCallback('myResponseCallback', (response, element, events, component) => alert('response'))
})
```

- `response` - `json` ответ,
- `element` - `html` элемент, в данном случае кнопка `ActionButton`,
- `events` - события которые будут вызваны,
- `component` - компонент `Alpine.js`.

Далее рассмотрим пример с функцией до запроса:

```php
ActionButton::make()->method('myMethod', callback: AsyncCallback::with(before: 'myBeforeRequestCallback'));
```

Мы при клике на кнопку отправим запрос в метод myMethod и при успешном ответе вызовем функцию myResponseCallback.

Следующий шаг - необходимо объявить эту функцию в `js` через глобальный класс `MoonShine`:

```js
document.addEventListener("moonshine:init", () => {
  MoonShine.onCallback('myBeforeRequestCallback', (element, component) => alert('before'))
})
```

- `element` - `html` элемент, в данном случае кнопка `ActionButton`,
- `component` - компонент `Alpine.js`.


