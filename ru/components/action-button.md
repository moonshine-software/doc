# ActionButton

- [Основы](#basics)
- [Открытие в новом окне](#blank)
- [Иконка](#icon)
- [Цвет](#color)
- [Бейдж](#badge)
- [onClick](#onclick)
- [Модальное окно](#modal)
- [Подтверждение](#confirm)
- [Боковая панель](#offcanvas)
- [Группировка](#group)
- [Массовые действия](#bulk)
- [Асинхронный режим](#async)
    - [Вызов методов](#method)
- [Отправка событий](#event)
- [Наполнение данными](#fill)

---

Наследует [MoonShineComponent](/docs/{{version}}/components/index).

\* имеет те же возможности.


<a name="basics"></a> 
## Основы

Когда вам нужно добавить кнопку с определенным действием, на помощь приходят `ActionButton`.  
В `MoonShine` они уже используются - в формах, таблицах, на страницах.

```php
ActionButton::make(
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

protected function components(): iterable
{
    return [
        ActionButton::make(
            label: 'Заголовок кнопки',
            url: 'https://moonshine-laravel.com',
        )
    ];
}
```

<a name="blank"></a> 
## Открытие в новом окне

Метод `blank()` позволяет открыть URL в новом окне. Добавится атрибут `target="_blank"`

```php
ActionButton::make(
    label: 'Нажми меня',
    url: '/',
)->blank()
```

<a name="icon"></a> 
## Иконка

Метод `icon()` позволяет указать иконку для кнопки.

```php
ActionButton::make(
    label: fn() => 'Нажми меня',
    url: 'https://moonshine-laravel.com',
)->icon('pencil')
```

> [!NOTE]
> Для получения более подробной информации обратитесь к разделу [Иконки](/docs/{{version}}/appearance/icons).

<a name="color"></a> 
## Цвет

Для *ActionButton* есть набор методов, которые позволяют установить цвет кнопки:  
`primary()`, `secondary()`, `warning()`, `success()` и `error()`.

```php
ActionButton::make(
    label: 'Нажми меня',
    url: fn() => 'https://moonshine-laravel.com',
)->primary()
```

<a name="badge"></a> 
## Бейдж

Метод `badge()` позволяет добавить бейдж к кнопке.

```php
badge(Closure|string|int|float|null $value)
```

```php
ActionButton::make('Кнопка')->badge(fn() => Comment::count())
//...
```

<a name="onclick"></a> 
## onClick

Метод `onClick` позволяет выполнить js-код при клике:

```php
ActionButton::make(
    label: 'Нажми меня',
    url: 'https://moonshine-laravel.com',
)->onClick(fn() => "alert('Пример')", 'prevent')
```

Если вам необходимо получить данные в методе `onClick`, то воспользуйтесь методом `onAfterSet`:

```php
ActionButton::make('Alert')
  ->onAfterSet(function (?DataWrapperContract $data, ActionButton $button) {
    return $button->onClick(fn() => 'alert('.$data?->getKey().')');
  })
```

<a name="modal"></a> 
## Модальное окно

#### Основы

Для вызова модального окна при нажатии на кнопку используйте метод `inModal()`.

> [!NOTE]
> Для получения более подробной информации по методам модальных окон, обратитесь к разделу [Modal](/docs/{{version}}/components/modal).

```php
use MoonShine\UI\Components\Modal;

ActionButton::make(
    label: 'Нажми меня',
    url: 'https://moonshine-laravel.com',
)
    ->inModal(
        title: fn() => 'Заголовок модального окна',
        content: fn() => 'Содержимое модального окна',
        name: 'my-modal',
        builder: fn(Modal $modal, ActionButton $ctx) => $modal->buttons([
          ActionButton::make('Нажми меня в модальном окне', 'https://moonshine-laravel.com')
        ])
    )
```

- `title` - заголовок модального окна,
- `content` - содержимое модального окна,
- `name` - наименование модального окна для вызова событий,
- `builder` - замыкание с доступом к компоненту `Modal`

Вы также можете открыть модальное окно с помощью метода `toggleModal`, а если `ActionButton` находится внутри модального окна, то просто `openModal`

```php
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\Modal;

protected function components(): iterable
{
    return [
        Modal::make(
            'Заголовок',
            fn() => 'Содержимое',
        )->name('my-modal')

        ActionButton::make(
            label: 'Открыть модальное окно',
        )->toggleModal('my-modal')
    ];
}
```

#### Асинхронный режим

Если вам нужно загрузить содержимое в модальное окно асинхронно, то включите режим `async` у `ActionButton`.

```php
protected function components(): iterable
{
    return [
        ActionButton::make(
            label: 'Нажми меня',
            url: to_page('action_button', fragment: 'doc-content'),
        )
            ->async()
            ->inModal(
                title: fn() => 'Заголовок модального окна',
            )
    ];
}
```

> [!NOTE]
> О [Fragment](/docs/{{version}}/components/fragment) можно узнать в разделе "Компоненты"

<a name="confirm"></a> 
## Подтверждение

Метод `withConfirm()` позволяет создать кнопку с подтверждением действия.

```php
ActionButton::make(
    label: 'Нажми меня',
    url: 'https://moonshine-laravel.com',
)
    ->withConfirm(
        title: 'Заголовок модального окна подтверждения',
        content: 'Содержимое модального окна подтверждения',
        button: 'Кнопка модального окна подтверждения',
        // опционально - дополнительные поля формы
        fields: null,
        method: HttpMethod::POST,
        // опционально - замыкание с FormBuilder
        formBuilder: null,
        // опционально - замыкание с Modal
        modalBuilder: null,
        // опционально - наименование компонента Modal
        name: null,
    )
```

<a name="offcanvas"></a> 
## Боковая панель

Для того чтобы при нажатии на кнопку вызывалась боковая панель, используйте метод `inOffCanvas()`.

```php
use MoonShine\UI\Components\OffCanvas;

protected function components(): iterable
{
    return [
        ActionButton::make(
            label: 'Нажми меня',
            url: 'https://moonshine-laravel.com',
        )
            ->inOffCanvas(
                title: fn() => 'Заголовок боковой панели',
                content: fn() => 'Содержимое',
                name: false,
                builder: fn(OffCanvas $offCanvas, ActionButton $ctx) => $offCanvas->left()
                // опционально - необходимо чтобы компоненты были доступны для поиска в системе, т.к. content всего лишь HTML
                components: []
            )
    ];
}
```

<a name="group"></a> 
## Группировка

Если вам нужно выстроить логику с несколькими `ActionButton`, однако некоторые должны быть скрыты или отображены в выпадающем меню, в этом случае используйте компонент `ActionGroup`.

```php
use MoonShine\UI\Components\ActionGroup;

protected function components(): iterable
{
    return [
        ActionGroup::make([
            ActionButton::make('Кнопка 1', '/')->canSee(fn() => false),
            ActionButton::make('Кнопка 2', '/', $model)->canSee(fn($model) => $model->active)
        ])
    ];
}
```

## Отображение

Благодаря `ActionGroup` вы также можете изменить отображение кнопок, отображать их в линию или в выпадающем меню для экономии места.

```php
use MoonShine\UI\Components\ActionGroup;

protected function components(): iterable
{
    return [
        ActionGroup::make([
            ActionButton::make('Кнопка 1', '/')->showInLine(),
            ActionButton::make('Кнопка 2', '/')->showInDropdown()
        ])
    ];
}
```

<a name="bulk"></a> 
## Массовые действия

Метод `bulk()` позволяет создать кнопку массового действия для `ModelResource`.

```php
protected function indexButtons(): ListOf
{
    return parent::indexButtons()->add(ActionButton::make('Ссылка', '/endpoint')->bulk());
}
```

> [!TIP]
> Метод `bulk()`, используется только внутри `ModelResource`.

<a name="async"></a> 
## Асинхронный режим

Метод `async()` позволяет реализовать асинхронную работу для `ActionButton`.

```php
async(
    HttpMethod $method = HttpMethod::GET,
    ?string $selector = null,
    array $events = [],
    ?AsyncCallback $callback = null
)
```

- `$method` - метод асинхронного запроса,
- `$selector` - селектор элемента, содержимое которого изменится в соответствии с ответом,
- `$events` - события, которые будут вызваны после успешного запроса,
- `$callback` - js функция обратного вызова после получения ответа.

> [!NOTE]
> О [Events](/docs/{{version}}/frontend/events) можно узнать в разделе "Frontend"
> 
> [!NOTE]
> О [Callback](/docs/{{version}}/frontend/callback) можно узнать в разделе "Frontend"

```php
protected function components(): iterable
{
    return [
        ActionButton::make(
            'Нажми меня',
            '/endpoint'
        )
            ->async()
    ];
}
```

#### Уведомления

Если вам нужно отобразить уведомление или сделать редирект после клика, то достаточно реализовать json ответ согласно структуре:

```php
{message: 'Toast', messageType: 'success', redirect: '/url'}
```

> [!TIP]
> Параметр `redirect` является необязательным.

#### HTML содержимое

Если вам нужно заменить область HTML по клику, то можно вернуть HTML содержимое или json с ключом html в ответе:

```php
{html: 'Html content'}
```

```php
protected function components(): iterable
{
    return [
        ActionButton::make(
            'Нажми меня',
            '/endpoint'
        )
            ->async(selector: '#my-selector')
    ];
}
```

#### События

После успешного запроса вы можете вызвать события:

```php
protected function components(): iterable
{
    return [
        ActionButton::make(
            'Нажми меня',
            '/endpoint'
        )
            ->async(events: [AlpineJs::event(JsEvent::TABLE_UPDATED, $this->getListComponentName())])
    ];
}
```
> [!TIP]
> Для работы события `JsEvent::TABLE_UPDATED` у таблицы должен быть включен [асинхронный режим](/docs/{{version}}/model-resource/table#async).

#### Обратный вызов

Если вам нужно обработать ответ иным способом, необходимо реализовать функцию-обработчик и указать ее в методе `async()`.

```php
protected function components(): iterable
{
    return [
        ActionButton::make(
            'Нажми меня',
            '/endpoint'
        )
            ->async(callback: 'myFunction')
    ];
}
```

```php
document.addEventListener("moonshine:init", () => {
    MoonShine.onCallback('myFunction', function(response, element, events, component) {
        if(response.confirmed === true) {
            component.$dispatch('toast', {type: 'success', text: 'Успех'})
        } else {
            component.$dispatch('toast', {type: 'error', text: 'Ошибка'})
        }
    })
})
```

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
    ?ResourceContract $resource = null
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
protected function components(): iterable
{
    return [
        ActionButton::make('Нажми меня')
            ->method('updateSomething'),
    ];
}
```
```php
// С уведомлением
public function updateSomething(MoonShineRequest $request): MoonShineJsonResponse
{
    // $request->getResource();
    // $request->getResource()->getItem();
    // $request->getPage();

    return MoonShineJsonResponse::make()->toast('Мое сообщение', ToastType::SUCCESS);
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
    throw new \Exception('Мое сообщение');
}

// Пользовательский JSON-ответ
public function updateSomething(MoonShineRequest $request)
{
    return MoonShineJsonResponse::make()->html('Контент');
}
```
> [!WARNING]
> Методы, вызываемые через `ActionButton` в ресурсе, должны быть публичными!

> [!CAUTION]
> Для доступа к данным из запроса вы должны передать их в параметрах.

#### Передача текущего элемента

Если в запросе присутствует `resourceItem`, вы можете получить доступ к текущему элементу в ресурсе через метод `getItem()`.

- Когда в данных есть модель, и кнопка создается в методе `indexButtons()` или `detailButtons` или `formButtons` [TableBuilder](/docs/{{version}}/components/table-builder#buttons), [CardsBuilder](/docs/{{version}}/components/cards-builder#buttons) или [FormBuilder](/docs/{{version}}/components/form-builder#buttons), она автоматически заполняется данными, и параметры будут содержать `resourceItem`.
- Когда кнопка находится на странице формы `ModelResource`, вы можете передать id текущего элемента.

```php
ActionButton::make('Нажми меня')
    ->method(
        'updateSomething',
        params: ['resourceItem' => $this->getResource()->getItemID()]
    )
```

- Когда кнопка находится в индексной таблице `ModelResource`, нужно использовать замыкание

```php
ActionButton::make('Нажми меня')
    ->method(
        'updateSomething',
        params: fn(Model $item) => ['resourceItem' => $item->getKey()]
    )
```

## Значения полей

Метод `withSelectorsParams()` позволяет передавать значения полей с запросом, используя селекторы элементов.

```php
ActionButton::make('Асинхронный метод')
    ->method('updateSomething')
    ->withSelectorsParams([
        'alias' => '[data-column="title"]',
        'slug' => '#slug'
    ]),
```

```php
use MoonShine\Laravel\Http\Responses\MoonShineJsonResponse;
use MoonShine\Laravel\MoonShineRequest;

public function updateSomething(MoonShineRequest $request): MoonShineJsonResponse
{
    return MoonShineJsonResponse::make()
        ->toast($request->get('slug', 'Ошибка'));
}
```

> [!WARNING]
> При использовании метода `withSelectorsParams()` запросы будут отправляться через `POST`.

## Скачивание

Вызываемый метод может возвращать `BinaryFileResponse`, что позволяет скачать файл.

```php
ActionButton::make('Скачать')->method('download')
```

```php
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
ActionButton::make('Обновить')
    ->dispatchEvent(AlpineJs::event(JsEvent::TABLE_UPDATED, 'index-table')),
```

<a name="fill"></a> 
## Наполнение данными

При работе с `ModelResource`, кнопки действий `ActionButton` обычно автоматически наполняются необходимыми данными. Этот процесс происходит "под капотом" с использованием метода `setData`. Давайте рассмотрим этот механизм подробнее.

```php
ActionButton::make('Button')->setData(?DataWrapperContract $data = null)
```

> [!NOTE]
> Подробнее о DataWrapperContract читайте в разделе [TypeCasts](/docs/{{version}}/advanced/type-casts)

Также доступны методы с колбеками до и после наполнения кнопки

```php
ActionButton::make('Button')->onBeforeSet(fn(?DataWrapperContract $data, ActionButton $ctx) => $data)
```

```php
ActionButton::make('Button')->onAfterSet(function(?DataWrapperContract $data, ActionButton $ctx): void {
    // logic
})
```
