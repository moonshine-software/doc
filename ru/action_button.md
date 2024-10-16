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

---

Расширяет [MoonShineComponent](https://moonshine-laravel.com/docs/resource/components/components-moonshine_component)
* имеет те же функции

<a name="basics"></a> 
## Основы

Когда вам нужно добавить кнопку с определенным действием, на помощь приходят ActionButtons.  
В MoonShine они уже используются - в формах, таблицах, на страницах.

```php
ActionButton::make(
    Closure|string $label,
    Closure|string|null $url = null,
    mixed $item = null
)
```

- `label` - текст кнопки,  
- `url` - URL ссылки кнопки,  
- `item` - опциональные данные кнопки, доступные в замыканиях.  

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Заголовок кнопки',
            url: 'https://moonshine-laravel.com',
        )
    ];
}
```

Также доступен хелпер, который можно использовать в Blade:

```php
<div>
    {!! actionBtn('Нажми меня', 'https://moonshine-laravel.com') !!}
</div>
```

<a name="blank"></a> 
## Открытие в новом окне

Метод `blank()` позволяет открыть URL в новом окне.

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Нажми меня',
            url: '/',
        )
            ->blank()
    ];
}
```

<a name="icon"></a> 
## Иконка

Метод `icon()` позволяет указать иконку для кнопки.

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: fn() => 'Нажми меня',
            url: 'https://moonshine-laravel.com',
        )
            ->icon('heroicons.outline.pencil')
    ];
}
```

> [!NOTE]
> Для получения более подробной информации обратитесь к разделу [Иконки](https://moonshine-laravel.com/docs/resource/appearance/icons).

<a name="color"></a> 
## Цвет

Для *ActionButton* есть набор методов, которые позволяют установить цвет кнопки:  
`primary()`, `secondary()`, `warning()`, `success()` и `error()`.

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Нажми меня',
            url: fn() => 'https://moonshine-laravel.com',
        )
            ->primary()
    ];
}
```

<a name="badge"></a> 
## Бейдж

Метод `badge()` позволяет добавить бейдж к кнопке.

```php
badge(Closure|string|int|float|null $value)
```
```php
use MoonShine\ActionButtons\ActionButton;

//...

ActionButton::make('Кнопка')
    ->badge(fn() => Comment::count())

//...
```

<a name="onclick"></a> 
## onClick

Метод `onClick` позволяет выполнить js-код при клике:

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Нажми меня',
            url: 'https://moonshine-laravel.com',
        )
            ->onClick(fn() => "alert('Пример')", 'prevent')
    ];
}
```

<a name="modal"></a> 
## Модальное окно

#### Основы

Для вызова модального окна при нажатии на кнопку используйте метод `inModal()`.

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Нажми меня',
            url: 'https://moonshine-laravel.com',
        )
            ->inModal(
                title: fn() => 'Заголовок модального окна',
                content: fn() => 'Содержимое модального окна',
                buttons: [
                    ActionButton::make('Нажми меня в модальном окне', 'https://moonshine-laravel.com')
                ],
                async: false
            )
    ];
}
```

- `title` - заголовок модального окна,
- `content` - содержимое модального окна,
- `buttons` - кнопки модального окна,
- `async` - асинхронный режим,
- `wide` - максимальная ширина модального окна,
- `auto` - ширина модального окна по содержимому,
- `closeOutside` - закрытие модального окна при клике вне области окна,
- `attributes` - дополнительные атрибуты,
- `autoClose` - автоматическое закрытие модального окна после успешного запроса.

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Нажми меня',
            url: 'https://moonshine-laravel.com',
        )
            ->inModal(
                title: fn() => 'Заголовок модального окна',
                content: fn() => 'Содержимое модального окна',
                buttons: [
                    ActionButton::make('Нажми меня в модальном окне', 'https://moonshine-laravel.com')
                ],
                async: false
            )
    ];
}
```

Вы также можете открыть модальное окно с помощью метода `toggleModal`, а если ActionButton находится внутри модального окна, то просто `openModal`

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\Modal;

public function components(): array
{
    return [
        MoonShine\Components\Modal::make(
            'Заголовок',
            fn() => 'Содержимое',
        )->name('my-modal')

        ActionButton::make(
            label: 'Открыть модальное окно',
            url: '#',
        )->toggleModal('my-modal')
    ];
}
```

#### Асинхронный режим

Если вам нужно загрузить содержимое в модальное окно асинхронно, то переключите параметр async на `true`.

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Нажми меня',
            url: to_page('action_button', fragment: 'doc-content'),
        )
            ->inModal(
                title: fn() => 'Заголовок модального окна',
                async: true
            )
    ];
}
```

> [!NOTE]
> О [Fragment](https://moonshine-laravel.com/docs/resource/components/components-decoration_fragment) можно узнать в разделе "Компоненты"

<a name="confirm"></a> 
## Подтверждение

Метод `withConfirm()` позволяет создать кнопку с подтверждением действия.

```php
ActionButton::make(
    label: 'Нажми меня',
    url: 'https://moonshine-laravel.com',
)
    ->withConfirm(
        'Заголовок модального окна подтверждения',
        'Содержимое модального окна подтверждения',
        'Кнопка модального окна подтверждения',
    )
```

> [!WARNING]
> `withConfirm` не работает с `async` режимами. Для асинхронного режима нужно сделать свою реализацию через [Modal](https://moonshine-laravel.com/docs/resource/components/components-decoration_modal) или [inModal()](https://moonshine-laravel.com/docs/resource/components/components-decoration_modal).

<a name="offcanvas"></a> 
## Боковая панель

Для того чтобы при нажатии на кнопку вызывалась боковая панель, используйте метод `inOffCanvas()`.

```php
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Нажми меня',
            url: 'https://moonshine-laravel.com',
        )
            ->inOffCanvas(
                fn() => 'Заголовок боковой панели',
                fn() => form()->fields([Text::make('Текст')]),
                isLeft: false
            )
    ];
}
```

<a name="group"></a> 
## Группировка

Если вам нужно выстроить логику с несколькими `ActionButton`, однако некоторые должны быть скрыты или отображены в выпадающем меню, в этом случае используйте компонент `ActionGroup`.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\ActionGroup;

public function components(): array
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

Благодаря *ActionGroup* вы также можете изменить отображение кнопок, отображать их в линию или в выпадающем меню для экономии места.

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\ActionGroup;

public function components(): array
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

Метод `bulk()` позволяет создать кнопку массового действия для *ModelResource*.

```php
public function indexButtons(): array
{
    return [
        ActionButton::make('Ссылка', '/endpoint')->bulk(),
    ];
}
```

> [!TIP]
> Метод `bulk()`, используется только внутри *ModelResource*.

<a name="async"></a> 
## Асинхронный режим

Метод `async()` позволяет реализовать асинхронную работу для *ActionButton*.

```php
async(
    string $method = 'GET',
    ?string $selector = null,
    array $events = []
    ?string $callback = null
)

```

- `$method` - метод асинхронного запроса,
- `$selector` - селектор элемента, содержимое которого изменится,
- `$events` - события, поднимаемые после успешного запроса,
- `$callback` - js функция обратного вызова после получения ответа.

```php
public function components(): array
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

Если вам нужно заменить область html по клику, то можно вернуть HTML содержимое или json с ключом html в ответе:

```php
{html: 'Html content'}
```

```php
public function components(): array
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

После успешного запроса вы можете поднять события:

```php
public function components(): array
{
    return [
        ActionButton::make(
            'Нажми меня',
            '/endpoint'
        )
            ->async(events: ['table-updated-index-table'])
    ];
}
```
> [!TIP]
> Для работы события `table-updated-index-table` должен быть включен [асинхронный режим](https://moonshine-laravel.com/docs/resource/models-resources/resources-table#async).

#### Обратный вызов

Если вам нужно обработать ответ иным способом, необходимо реализовать функцию-обработчик и указать ее в методе `async()`.

```php
public function components(): array
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
## Вызов методов

`method()` позволяет указать имя метода в ресурсе и вызвать его асинхронно при нажатии на *ActionButton* без необходимости создания дополнительных контроллеров.

```php
method(
    string $method,
    array|Closure $params = [],
    ?string $message = null,
    ?string $selector = null,
    array $events = [],
    string|AsyncCallback|null $callback = null,
    ?Page $page = null,
    ?ResourceContract $resource = null
)
```

- `$method` - имя метода,
- `$params` - параметры для запроса,
- `$message` - сообщения,
- `$selector` - селектор элемента, содержимое которого изменится,
- `$events` - события, которые будут вызваны после успешного запроса,
- `$callback` - js функция обратного вызова после получения ответа,
- `$page` - страница, содержащая метод,
- `$resource` - ресурс, содержащий метод.

```php
public function components(): array
{
    return [
        ActionButton::make('Нажми меня')
            ->method('updateSomething'),
    ];
}
```
```php
// С уведомлением
public function updateSomething(MoonShineRequest $request)
{
    // $request->getResource();
    // $request->getResource()->getItem();
    // $request->getPage();

    MoonShineUI::toast('МоеСообщение', 'success');

    return back();
}

// Исключение
public function updateSomething(MoonShineRequest $request)
{
    throw new \Exception('Мое сообщение');
}

// Пользовательский JSON-ответ
public function updateSomething(MoonShineRequest $request)
{
    return MoonShineJsonResponse::make()->toast('МоеСообщение', ToastType::SUCCESS);
}
```
> [!WARNING]
> Методы, вызываемые через *ActionButton* в ресурсе, должны быть публичными!

> [!CAUTION]
> Для доступа к данным из запроса вы должны передать их в параметрах.

#### Передача текущего элемента

Если в запросе присутствует *resourceItem*, вы можете получить доступ к текущему элементу в ресурсе через метод `getItem()`.

- Когда в данных есть модель, и кнопка создается в методе `buttons()` [TableBuilder](https://moonshine-laravel.com/docs/resource/advanced/advanced-table_builder#buttons), [CardsBuilder](https://moonshine-laravel.com/docs/resource/advanced/advanced-cards_builder#buttons) или [FormBuilder](https://moonshine-laravel.com/docs/resource/advanced/advanced-form_builder#buttons), она автоматически заполняется данными, и параметры будут содержать `resourceItem`.
- Когда кнопка находится на странице формы *ModelResource*, вы можете передать id текущего элемента.

```php
ActionButton::make('Нажми меня')
    ->method(
        'updateSomething',
        params: ['resourceItem' => $this->getResource()->getItemID()]
    )
```

- Когда кнопка находится в индексной таблице *ModelResource*, нужно использовать замыкание

```php
ActionButton::make('Нажми меня')
    ->method(
        'updateSomething',
        params: fn($item) => ['resourceItem' => $item->getKey()]
    )
```
## Значения полей

Метод `withParams()` позволяет передавать значения полей с запросом, используя селекторы элементов.

```php
ActionButton::make('Асинхронный метод')
    ->method('updateSomething')
    ->withParams([
        'alias' => '[data-column="title"]',
        'slug' => '#slug'
    ]),
```

```php
use MoonShine\Http\Responses\MoonShineJsonResponse;
use MoonShine\MoonShineRequest;

public function updateSomething(MoonShineRequest $request): MoonShineJsonResponse
{
    return MoonShineJsonResponse::make()
        ->toast($request->get('slug', 'Ошибка'));
}
```

> [!WARNING]
> При использовании метода `withParams()` запросы будут отправляться через `POST`.

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
ActionButton::make('Обновить', '#')
    ->dispatchEvent(AlpineJs::event(JsEvent::TABLE_UPDATED, 'index-table')),
```