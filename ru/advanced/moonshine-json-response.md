# MoonShineJsonResponse

- [Основы](#basics)
- [Методы](#methods)
    - [Toast](#toast)
    - [Redirect](#redirect)
    - [Events](#events)
    - [Html](#html)
    - [HtmlData](#htmldata)

---

<a name="basics"></a>
## Основы

MoonShineJsonResponse наследует `Illuminate\Http\JsonResponse` и дополнен вспомогательными методами для взаимодействия с frontend частью интерфейса админ-панели после обработки запроса. 

<a name="methods"></a>
## Методы

<a name="toast"></a>
### Toast

Метод `toast()` вызывает стандартное [всплывающее уведомление](/docs/{{version}}/advanced/toasts) админ-панели.

```php
toast(string $value, ToastType $type = ToastType::DEFAULT, null|int|false $duration = null)
```
Пример:
```php
MoonShineJsonResponse::make()->toast('My message', ToastType::SUCCESS, duration: 3000);
```

<a name="redirect"></a>
### Редирект

Метод `redirect()` выполнит редирект на указанный url.

```php
redirect(string $value)
```

Пример:

```php
MoonShineJsonResponse::make()->redirect('/');
```

<a name="events"></a>
### Events

Метод `events()` добавляет в ответ [JSEvents](/docs/{{version}}/frontend/js#events), которые будут вызваны после обработки асинхронного запроса.

```php
events(array $events)
```

Пример:

```php
MoonShineJsonResponse::make()->events([AlpineJs::event(JsEvent::TABLE_UPDATED, 'index')]);
```

<a name="html"></a>
### Html

Метод `html()` подставит нужный HTML-код в селектор, который был указан при создании компонента, инициирующего запрос.

```php
html(string|array $value, HtmlMode $mode = HtmlMode::INNER_HTML)
```
- `$value` - значение, которое нужно подставить в селектор,
- `$mode` - режим замены контента в селекторе.

HtmlMode является Enum, которому доступны следующие значения:
```php
enum HtmlMode: string
{
    case INNER_HTML = 'inner_html';

    case OUTER_HTML = 'outer_html';

    case BEFORE_BEGIN = 'beforebegin';

    case AFTER_BEGIN = 'afterbegin';

    case BEFORE_END = 'beforeend';

    case AFTER_END = 'afterend';
}
```

В следующем примере значение `Content` будет подставлено в селектор `#my-selector`

```php
ActionButton::make('Button Label', '/endpoint')->async(selector: '#my-selector')

//...

MoonShineJsonResponse::make()->html('Content');
```

<a name="htmldata"></a>
### HtmlData

Метод `htmlData()` позволяет указать сразу несколько селекторов и HTML контент для подстановки в данные селекторы.

```php
htmlData(string|array $value, string $selector, HtmlMode $mode = HtmlMode::INNER_HTML)
```

Пример:

```php
MoonShineJsonResponse::make()
      ->htmlData((string) Text::make('One'), '#selector1')
      ->htmlData((string) Text::make('Two'), '#selector2', HtmlMode::BEFORE_END)
```