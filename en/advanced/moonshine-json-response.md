# JsonResponse

- [Basics](#basics)
- [Methods](#methods)
    - [Toast](#toast)
    - [Redirect](#redirect)
    - [Events](#events)
    - [Html](#html)
    - [HtmlData](#htmldata)
    - [Fields values](#fields-values)

---

<a name="basics"></a>
## Basics

`JsonResponse` extends `Illuminate\Http\JsonResponse` and is supplemented with helper methods for interacting with the frontend part of the admin panel interface after processing a request.

<a name="methods"></a>
## Methods

<a name="toast"></a>
### Toast

The `toast()` method triggers a standard [toast notification](/docs/{{version}}/advanced/toasts) of the admin panel.

```php
toast(string $value, ToastType $type = ToastType::DEFAULT, null|int|false $duration = null)
```
Example:
```php
JsonResponse::make()->toast('My message', ToastType::SUCCESS, duration: 3000);
```

<a name="redirect"></a>
### Redirect

The `redirect()` method will redirect to the specified URL.

```php
redirect(string $value)
```

Example:

```php
JsonResponse::make()->redirect('/');
```

<a name="events"></a>
### Events

The `events()` method adds [JSEvents](/docs/{{version}}/frontend/js#events) to the response, which will be triggered after processing an asynchronous request.

```php
events(array $events)
```

Example:

```php
JsonResponse::make()->events([AlpineJs::event(JsEvent::TABLE_UPDATED, 'index')]);
```

<a name="html"></a>
### Html

The `html()` method inserts the required HTML code into the selector specified when creating the component that initiated the request.

```php
html(string|array $value, HtmlMode $mode = HtmlMode::INNER_HTML)
```
- `$value` - the value to be inserted into the selector,
- `$mode` - the mode of content replacement in the selector.

HtmlMode is an Enum with the following values:
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

In the following example, the value `Content` will be inserted into the selector `#my-selector`

```php
ActionButton::make('Button Label', '/endpoint')->async(selector: '#my-selector')

//...

JsonResponse::make()->html('Content');
```

<a name="htmldata"></a>
### HtmlData

The `htmlData()` method allows specifying multiple selectors and HTML content for insertion into these selectors.

```php
htmlData(string|array $value, string $selector, HtmlMode $mode = HtmlMode::INNER_HTML)
```

Example:

```php
JsonResponse::make()
      ->htmlData((string) Text::make('One'), '#selector1')
      ->htmlData((string) Text::make('Two'), '#selector2', HtmlMode::BEFORE_END)
```

<a name="fields-values"></a>
### Fields values

The `fieldsValues()` method allows you to set the values of the field fields through selectors.

```php
fieldsValues(array $values)
```

Example:

```php
JsonResponse::make()
      ->fieldsValues([
        '.field-title-1' => 'some value 1',
        '.field-title-2' => 'some value 2',
    ])
```

> [!NOTE]
> Also, when filling the field, the event `change` will be caused
