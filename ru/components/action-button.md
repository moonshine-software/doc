# ActionButton

- [Основы](#basics)
- [Открытие в новом окне](#blank)
- [Иконка](#icon)
- [Цвет](#color)
- [Бейдж](#badge)
- [onClick](#onclick)
- [Модальное окно](#modal)
- [Подтверждение](#confirm)
- [Offcanvas](#offcanvas)
- [Группировка](#group)
- [Массовые действия](#bulk)
- [Асинхронный режим](#async)
    - [Вызов методов](#method)
- [Отправка событий](#event)
- [Наполнение данными](#fill)

---

<a name="basics"></a>
## Основы

Когда вам нужно добавить кнопку с определенным действием, на помощь приходят `ActionButton`.
В **MoonShine** они уже используются - в формах, таблицах, на страницах.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;

make(
    Closure|string $label,
    Closure|string $url = '#',
    ?DataWrapperContract $data = null,
)
```

- `label` - текст кнопки,
- `url` - URL ссылки кнопки,
- `data` - опциональные данные кнопки, доступные в замыканиях.

```php
use MoonShine\UI\Components\ActionButton;

ActionButton::make(
    'Button Label',
    'https://moonshine-laravel.com'
)
```

<a name="blank"></a>
## Открытие в новом окне

Метод `blank()` позволяет открыть URL в новом окне. Добавится атрибут `target="_blank"`.

```php
ActionButton::make('Button Label', '/')
    ->blank()
```

<a name="icon"></a>
## Иконка

Метод `icon()` позволяет указать иконку для кнопки.

```php
ActionButton::make('Button Label')
    ->icon('pencil')
```

> [!NOTE]
> Для получения более подробной информации обратитесь к разделу [Иконки](/docs/{{version}}/appearance/icons).

<a name="color"></a>
## Цвет

Для `ActionButton` есть набор методов, которые позволяют установить цвет кнопки:
`primary()`, `secondary()`, `warning()`, `success()` и `error()`.

```php
ActionButton::make('Button Label')
    ->primary()
```

<a name="badge"></a>
## Бейдж

Метод `badge()` позволяет добавить бейдж к кнопке.

```php
badge(Closure|string|int|float|null $value)
```

```php
ActionButton::make('Button Label')
    ->badge(fn() => Comment::count())
```

<a name="onclick"></a>
## onClick

Метод `onClick()` позволяет выполнить js-код при клике.

```php
ActionButton::make('Button Label')
    ->onClick(fn() => "alert('Пример')", 'prevent')
```

Если вам необходимо получить данные в методе `onClick()`, то воспользуйтесь методом `onAfterSet()`.

```php
ActionButton::make('Alert')
    ->onAfterSet(function (?DataWrapperContract $data, ActionButton $button) {
        return $button->onClick(fn() => 'alert('.$data?->getKey().')');
    })
```

<a name="modal"></a>
## Модальное окно

### Основы

Для вызова модального окна при нажатии на кнопку используйте метод `inModal()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\UI\ActionButtonContract;
use MoonShine\UI\Components\Modal;

/**
 * @param  ?Closure(Modal $modal, ActionButtonContract $ctx): Modal  $builder
 */
inModal(
    Closure|string|null $title = null,
    Closure|string|null $content = null,
    Closure|string|null $name = null,
    ?Closure $builder = null,
    iterable $components = [],
)
```

- `title` - заголовок модального окна,
- `content` - содержимое модального окна,
- `name` - уникальное наименование модального окна для вызова событий,
- `builder` - замыкание с доступом к компоненту `Modal`,
- `components` - компоненты.

@include('_includes/modal-off-canvas-components', 'Modal', 'Modal', 'Modal', 'Modal')

> [!NOTE]
> Для получения более подробной информации по методам модальных окон, обратитесь к разделу [Modal](/docs/{{version}}/components/modal).

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\Modal;

ActionButton::make('Button Label')
    ->inModal(
        title: 'Modal Window Title',
        content: 'Modal Window Content',
        name: 'my-modal',
        builder: fn(Modal $modal, ActionButton $ctx) => $modal
    )
```

> [!WARNING]
> Если вы используете несколько однотипных модальных окон, например в таблицах для каждого элемента, то вам необходимо указывать уникальный `name` для каждой.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\UI\ActionButtonContract;
use MoonShine\UI\Components\ActionButton;

ActionButton::make('Button Label')
    ->inModal(
        name: static fn (mixed $item, ActionButtonContract $ctx): string => "delete-button-{$ctx->getData()?->getKey()}"
    )
```

Вы также можете открыть модальное окно с помощью метода `toggleModal()`, а если `ActionButton` находится внутри модального окна, то просто `openModal()`.

```php
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\Modal;

Modal::make('Title','Content')
    ->name('my-modal'),

ActionButton::make('Open modal window')
    ->toggleModal('my-modal'),
```

### Асинхронный режим

Если вам нужно загрузить содержимое в модальное окно асинхронно, то включите асинхронный режим с помощью метода `async()` у `ActionButton`.

```php
ActionButton::make(
    'Button Label',
    to_page('action_button', fragment: 'doc-content'),
)
    ->async()
    ->inModal(
        title: fn() => 'Modal Window Title',
    )
```

> [!NOTE]
> О [Fragment](/docs/{{version}}/components/fragment) можно узнать в разделе "Компоненты".

<a name="confirm"></a>
## Подтверждение

Метод `withConfirm()` позволяет создать кнопку с подтверждением действия.

```php
/**
 * @param  ?Closure(FormBuilderContract $form, mixed $data): FormBuilderContract  $formBuilder
 * @param  ?Closure(Modal $modal, ActionButtonContract $ctx): Modal  $modalBuilder
 */
withConfirm(
    Closure|string|null $title = null,
    Closure|string|null $content = null,
    Closure|string|null $button = null,
    Closure|array|null $fields = null,
    HttpMethod $method = HttpMethod::POST,
    ?Closure $formBuilder = null,
    ?Closure $modalBuilder = null,
    Closure|string|null $name = null,
)
```

```php
ActionButton::make('Button Label')
    ->withConfirm(
        title: 'Confirmation Modal Window Title',
        content: 'Confirmation Modal Window Content',
        button: 'Confirmation Modal Window Button',
        // опционально - дополнительные поля формы
        fields: null,
        method: HttpMethod::POST,
        // опционально - замыкание с FormBuilder
        formBuilder: null,
        // опционально - замыкание с Modal
        modalBuilder: null,
        name: 'my-modal',
    )
```

> [!WARNING]
> Если вы используете несколько однотипных модальных окон, например в таблицах для каждого элемента, то вам необходимо указывать уникальный `name` для каждой.

```php
ActionButton::make('Button Label')
    ->inModal(
        name: static fn (mixed $item, ActionButtonContract $ctx): string => "delete-button-{$ctx->getData()?->getKey()}"
    )
```

<a name="offcanvas"></a>
## Offcanvas

Для того чтобы при нажатии на кнопку вызывалась боковая панель (Offcanvas), используйте метод `inOffCanvas()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\OffCanvas;

ActionButton::make('Button Label')
    ->inOffCanvas(
        title: fn() => 'Offcanvas Title',
        content: fn() => 'Content',
        name: false,
        builder: fn(OffCanvas $offCanvas, ActionButton $ctx) => $offCanvas->left(),
        // опционально - необходимо чтобы компоненты были доступны для поиска в системе, т.к. content всего лишь HTML
        components: [],
    )
```

<a name="group"></a>
## Группировка

Если вам необходимо организовать логику с несколькими `ActionButton`, при этом некоторые из них должны быть скрыты или отображены в выпадающем меню, используйте компонент `ActionGroup`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\ActionGroup;

ActionGroup::make([
    ActionButton::make('Button 1', '/')
        ->canSee(fn() => false),
    ActionButton::make('Button 2', '/', $model)
        ->canSee(fn($model) => $model->active)
])
```

> [!NOTE]
> Подробнее о компоненте [ActionGroup](/docs/{{version}}/components/action-group).

### Отображение

Благодаря `ActionGroup` вы также можете изменить отображение кнопок, отображать их в линию или в выпадающем меню для экономии места.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\ActionGroup;

ActionGroup::make([
    ActionButton::make('Button 1', '/')
        ->showInLine(),

    ActionButton::make('Button 2', '/')
        ->showInDropdown()
])
```

<a name="bulk"></a>
## Массовые действия

Метод `bulk()` позволяет создать кнопку массового действия для `ModelResource`.

```php
protected function indexButtons(): ListOf
{
    return parent::indexButtons()
        ->add(ActionButton::make('Link', '/endpoint')->bulk());
}
```

> [!NOTE]
> Метод `bulk()`, используется только внутри `ModelResource`.

<a name="async"></a>
## Асинхронный режим

Метод `async()` позволяет реализовать асинхронную работу для `ActionButton`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\DTOs\AsyncCallback;
use MoonShine\Support\Enums\HttpMethod;

async(
    HttpMethod $method = HttpMethod::GET,
    ?string $selector = null,
    array $events = [],
    ?AsyncCallback $callback = null,
)
```

- `$method` - метод асинхронного запроса,
- `$selector` - селектор элемента, содержимое которого изменится в соответствии с ответом,
- `$events` - события, которые будут вызваны после успешного запроса,
- `$callback` - js функция обратного вызова после получения ответа.

> [!NOTE]
> О [Events](/docs/{{version}}/frontend/js#events) можно узнать в разделе "Frontend".

> [!NOTE]
> О [Callback](/docs/{{version}}/frontend/js#response-calback) можно узнать в разделе "Frontend".

```php
ActionButton::make('Button Label', '/endpoint')
    ->async()
```

### Индикатор загрузки

Если вы не хотите видеть индикатор загрузки при выполнении асинхронной работы, вы можете отключить его с помощью метода `withoutLoading()`.

```php
ActionButton::make('Button Label', '/endpoint')
    ->async()
    ->withoutLoading()
```

### Уведомления

Если вам нужно отобразить уведомление или сделать редирект после клика, то достаточно реализовать json ответ согласно следующей структуре:

```json
{
    "message": "Toast",
    "messageType": "success",
    "redirect": "/url"
}
```

> [!NOTE]
> Параметр `redirect` является необязательным.

### HTML содержимое

Если вам нужно заменить область HTML по клику, то можно вернуть HTML содержимое или json с ключом html в ответе, например:

```json
{"html": "Html content"}
```

```php
ActionButton::make('Button Label', '/endpoint')
    ->async(selector: '#my-selector')
```

### События

После успешного запроса вы можете вызвать события.

```php
ActionButton::make('Button Label', '/endpoint')
    ->async(
        events: [
            AlpineJs::event(JsEvent::TABLE_UPDATED, $this->getListComponentName())
        ]
    )
```

> [!NOTE]
> Для работы события `JsEvent::TABLE_UPDATED` у таблицы должен быть включен [асинхронный режим](/docs/{{version}}/model-resource/table#async).

### Обратный вызов

Если вам нужно обработать ответ иным способом, необходимо реализовать функцию-обработчик и указать её в методе `async()`.

```php
ActionButton::make('Button Label', '/endpoint')
    ->async(
        callback: AsyncCallback::with(responseHandler: 'myFunction')
    )
```

```javascript
document.addEventListener("moonshine:init", () => {
    MoonShine.onCallback('myFunction', function(response, element, events, component) {
        if(response.confirmed === true) {
            component.$dispatch('toast', {type: 'success', text: 'Success'})
        } else {
            component.$dispatch('toast', {type: 'error', text: 'Error'})
        }
    })
})
```

> [!NOTE]
> Подробности в разделе [Js](/docs/{{version}}/frontend/js#response-calback).

<a name="method"></a>
### Вызов методов

`method()` позволяет указать имя метода в ресурсе и вызвать его асинхронно при нажатии на `ActionButton` без необходимости создания дополнительных контроллеров.

```php
method(
    string $method,
    array|Closure $params = [],
    ?string $message = null,
    ?string $selector = null,
    array $events = [],
    ?AsyncCallback $callback = null,
    ?PageContract $page = null,
    ?ResourceContract $resource = null,
)
```

- `$method` - имя метода,
- `$params` - опционально - параметры для запроса,
- `$message` - опционально - сообщение при успешном выполнении,
- `$selector` - опционально - селектор элемента, содержимое которого изменится,
- `$events` - опционально - события, которые будут вызваны после успешного запроса,
- `$callback` - опционально - js функция обратного вызова после получения ответа,
- `$page` - опционально - страница, содержащая метод (если кнопка находится вне страницы и ресурса),
- `$resource` - опционально - ресурс, содержащий метод (если кнопка находится вне ресурса).

```php
ActionButton::make('Button Label')
    ->method('updateSomething')
```

Если метод возвращает файл для скачивания, вам необходимо добавить метод `download()`.

```php
ActionButton::make('ZIP')
    ->method('zip')
    ->download()
```

Примеры методов:

```php
// С уведомлением
public function updateSomething(MoonShineRequest $request): MoonShineJsonResponse
{
    // $request->getResource();
    // $request->getResource()->getItem();
    // $request->getPage();

    return MoonShineJsonResponse::make()->toast('My message', ToastType::SUCCESS);
}

// Редирект
public function updateSomething(MoonShineRequest $request): MoonShineJsonResponse
{
    return MoonShineJsonResponse::make()->redirect('/');
}

// Редирект
public function updateSomething(MoonShineRequest $request): RedirectResponse
{
    return back();
}

// Исключение
public function updateSomething(MoonShineRequest $request): void
{
    throw new \Exception('My message');
}

// Пользовательский JSON-ответ
public function updateSomething(MoonShineRequest $request)
{
    return MoonShineJsonResponse::make()->html('Content');
}
```

> [!WARNING]
> Методы, вызываемые через `ActionButton` в ресурсе, должны быть публичными!

> [!WARNING]
> Для доступа к данным из запроса вы должны передать их в параметрах.

#### Передача текущего элемента

Если в запросе присутствует `resourceItem`, вы можете получить доступ к текущему элементу в ресурсе через метод `getItem()`.

Когда в данных есть модель, и кнопка создается в методе `indexButtons()` или `detailButtons()` или `formButtons()` [TableBuilder](/docs/{{version}}/components/table-builder#buttons), [CardsBuilder](/docs/{{version}}/components/cards-builder#buttons) или [FormBuilder](/docs/{{version}}/components/form-builder#buttons),
она автоматически заполняется данными, и параметры будут содержать `resourceItem`.

Когда кнопка находится на странице формы `ModelResource`, вы можете передать id текущего элемента.

```php
ActionButton::make('Button Label')
    ->method(
        'updateSomething',
        params: ['resourceItem' => $this->getResource()->getItemID()]
    )
```

Когда кнопка находится в индексной таблице `ModelResource`, нужно использовать замыкание.

```php
ActionButton::make('Button Label')
    ->method(
        'updateSomething',
        params: fn(Model $item) => ['resourceItem' => $item->getKey()]
    )
```

#### Значения полей

Метод `withSelectorsParams()` позволяет передавать значения полей с запросом, используя селекторы элементов.

```php
ActionButton::make('Button Label')
    ->method('updateSomething')
    ->withSelectorsParams([
        'alias' => '[data-column="title"]',
        'slug' => '#slug',
    ])
```

```php
use MoonShine\Laravel\Http\Responses\MoonShineJsonResponse;
use MoonShine\Laravel\MoonShineRequest;

public function updateSomething(MoonShineRequest $request): MoonShineJsonResponse
{
    return MoonShineJsonResponse::make()
        ->toast($request->get('slug', 'Error'));
}
```

> [!WARNING]
> При использовании метода `withSelectorsParams()` запросы будут отправляться через `POST`.

#### Скачивание

Вызываемый метод может возвращать `BinaryFileResponse`, что позволяет скачать файл.

```php
ActionButton::make('Download')
    ->method('download')
```

```php
use Symfony\Component\HttpFoundation\BinaryFileResponse;

public function download(): BinaryFileResponse
{
    // ...

    return response()->download($file);
}
```

<a name="event"></a>
## Отправка событий

Для отправки javascript-событий вы можете использовать метод `dispatchEvent()`.

```php
dispatchEvent(array|string $events)
```

```php
ActionButton::make('Refresh')
    ->dispatchEvent(
        AlpineJs::event(JsEvent::TABLE_UPDATED, 'index-table')
    )
```

По умолчанию при вызове события с запросом будут отправлены все query параметры (например, `?param=value`) из  `url` (указанного при создании `ActionButton`).

Исключить ненужные можно через параметр `exclude`.

```php
ActionButton::make('Refresh')
    ->dispatchEvent(
        AlpineJs::event(JsEvent::TABLE_UPDATED, 'index-table'),
        exclude: ['something'],
    )
```

Также можно полностью исключить отправку `withoutPayload`.

```php
ActionButton::make('Refresh')
    ->dispatchEvent(
        AlpineJs::event(JsEvent::TABLE_UPDATED, 'index-table'),
        withoutPayload: true
    )
```

### Параметры запроса URL

Вы можете включить параметры текущего запроса URL (например, `?param=value`) в запрос.

```php
ActionButton::make('Button Label')
    ->withQueryParams()
```

<a name="fill"></a>
## Наполнение данными

При работе с `ModelResource`, кнопки действий `ActionButton` обычно автоматически наполняются необходимыми данными.
Этот процесс происходит "под капотом" с использованием метода `setData()`.
Давайте рассмотрим этот механизм подробнее.

```php
ActionButton::make('Button Label')
    ->setData(?DataWrapperContract $data = null)
```

> [!NOTE]
> Подробнее о `DataWrapperContract` читайте в разделе [TypeCasts](/docs/{{version}}/advanced/type-casts).

Также доступны методы с колбеками до и после наполнения кнопки.

```php
ActionButton::make('Button Label')
    ->onBeforeSet(fn(?DataWrapperContract $data, ActionButton $ctx) => $data)
```

```php
ActionButton::make('Button Label')
    ->onAfterSet(function(?DataWrapperContract $data, ActionButton $ctx): void {
        // logic
    })
```
