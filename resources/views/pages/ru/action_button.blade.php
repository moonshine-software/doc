<x-page title="ActionButton"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#blank', 'label' => 'Blank'],
            ['url' => '#icon', 'label' => 'Icon'],
            ['url' => '#color', 'label' => 'Цвет'],
            ['url' => '#onclick', 'label' => 'onClick'],
            ['url' => '#modal', 'label' => 'Modal'],
            ['url' => '#offcanvas', 'label' => 'Offcanvas'],
            ['url' => '#group', 'label' => 'Группы'],
            ['url' => '#bulk', 'label' => 'Bulk'],
            ['url' => '#async', 'label' => 'Асинхронный режим'],
            ['url' => '#method', 'label' => 'Вызов методов'],
        ]
    ]"
>

<x-extendby :href="route('moonshine.page', 'components-moonshine_component')">
    MoonShineComponent
</x-extendby>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Когда Вам необходимо добавить кнопку с определенным действием, на помощь приходят ActionButton.
    В MoonShine они уже используются - в формах, таблицах, на страницах.
</x-p>

<x-code language="php">
ActionButton::make(
    Closure|string $label,
    Closure|string|null $url = null,
    mixed $item = null
)
</x-code>

<x-ul>
    <li><code>label</code> - текст кнопки,</li>
    <li><code>url</code> - url ссылки у кнопки,</li>
    <li><code>item</code> - опциональные данные кнопки, доступные в замыканиях.</li>
</x-ul>

<x-code>
use MoonShine\ActionButtons\ActionButton; // [tl! focus]

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Button title',
            url: 'https://moonshine-laravel.com',
        ) // [tl! focus:-3]
    ];
}
</x-code>

<x-p>
    Также доступен helper, который можно применить в blade:
</x-p>

<x-code>
<div>
    @{!! actionBtn('Click me', 'https://moonshine-laravel.com') !!}
</div>
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com') !!}

<x-sub-title id="blank">Blank</x-sub-title>

<x-p>
    Метод <code>blank()</code> позволяет открывать url в новом окне.
</x-p>

<x-code>
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: fn() => 'Click me',
            url: 'https://moonshine-laravel.com',
        )
            ->blank() // [tl! focus]
    ];
}
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')->blank() !!}

<x-sub-title id="icon">Icon</x-sub-title>

<x-p>
    Метод <code>icon()</code> позволяет указать иконку у кнопки.
</x-p>

<x-code>
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: fn() => 'Click me',
            url: 'https://moonshine-laravel.com',
        )
            ->icon('heroicons.outline.pencil') // [tl! focus]
    ];
}
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')->icon('heroicons.outline.pencil') !!}

@include('pages.ru.shared.alert_icons')

<x-sub-title id="color">Цвет</x-sub-title>

<x-p>
    Для <em>ActionButton</em> есть набор методов которые позволяют задать цвет кнопки:
    <code>primary()</code>, <code>secondary()</code>, <code>warning()</code>, <code>success()</code>
    и <code>error()</code>.
</x-p>

<x-code>
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Click me',
            url: fn() => 'https://moonshine-laravel.com',
        )
            ->primary() // [tl! focus]
    ];
}
</x-code>

{!! actionBtn('Primary', 'https://moonshine-laravel.com')->primary() !!}
{!! actionBtn('Secondary', 'https://moonshine-laravel.com')->secondary() !!}
{!! actionBtn('Warning', 'https://moonshine-laravel.com')->warning() !!}
{!! actionBtn('Success', 'https://moonshine-laravel.com')->success() !!}
{!! actionBtn('Error', 'https://moonshine-laravel.com')->error() !!}

<x-sub-title id="onclick">onClick</x-sub-title>

<x-p>
    Метод <code>onClick</code> позволяет выполнить js код по клику:
</x-p>

<x-code>
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Click me',
            url: 'https://moonshine-laravel.com',
        )
            ->onClick(fn() => 'alert("Example")', 'prevent') // [tl! focus]
    ];
}
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')->onClick(fn() => 'alert("Example")', 'prevent') !!}

<x-sub-title id="modal">Modal</x-sub-title>

<x-moonshine::divider label="Basics" />

<x-p>
    Для того, чтобы по клику на кнопку произошел вызов модального окна, воспользуйтесь методом <code>inModal()</code>.
</x-p>

<x-code language="php">
inModal(
    Closure|string|null $title = null,
    Closure|string|null $content = null,
    array $buttons = [],
    bool $async = false,
    bool $wide = false,
    bool $auto = false,
    bool $closeOutside = false,
    array $attributes = [],
    bool $autoClose = true,
)
</x-code>

<x-ul>
    <li><code>title</code> - заголовок окна,</li>
    <li><code>content</code> - контент модального окна,</li>
    <li><code>buttons</code> - кнопки модального окна,</li>
    <li><code>async</code> - асинхронный режим,</li>
    <li><code>wide</code> - максимальная ширина модального окна,</li>
    <li><code>auto</code> - ширина модального окна по контенту,</li>
    <li><code>closeOutside</code> - закрывать модальное окно при клике вне области окна,</li>
    <li><code>attributes</code> - дополнительные аттрибуты,</li>
    <li><code>autoClose</code> - автозакрытие модального окна после успешного запроса.</li>
</x-ul>

<x-code>
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Click me',
            url: 'https://moonshine-laravel.com',
        )
            ->inModal(
                title: fn() => 'Modal title',
                content: fn() => 'Modal content',
                buttons: [
                    ActionButton::make('Click me in modal', 'https://moonshine-laravel.com')
                ],
                async: false
            ) // [tl! focus:-7]
    ];
}
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')
    ->inModal(fn() => 'Modal title', fn() => 'Modal content', [
        actionBtn('Click me in modal', 'https://moonshine-laravel.com')
]) !!}

<x-moonshine::divider label="Async" />

<x-p>
    Если требуется подгрузить контент в модальное окно асинхронно,
    то переключите параметр async в <code>true</code>.
</x-p>

<x-code>
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Click me',
            url: route('moonshine.page', ['pageUri' => 'action_button', '_fragment-load' => 'doc-content']),
        )
            ->inModal(
                title: fn() => 'Modal title',
                async: true // [tl! focus]
            )
    ];
}
</x-code>

{!! actionBtn('Example', route('moonshine.page', ['pageUri' => 'action_button', '_fragment-load' => 'doc-content']))->inModal(
    title: fn() => 'Modal title',
    async: true
) !!}

<x-moonshine::alert class="my-4" type="default" icon="heroicons.book-open">
    О <x-link link="{{ route('moonshine.page', 'components-decoration_fragment') }}">Fragment</x-link>
    можно узнать в разделе "Components"
</x-moonshine::alert>

<x-moonshine::divider label="withConfirm" />

<x-p>
    Метод <code>withConfirm()</code> позволяет создать кнопку с подтверждением действия.
</x-p>

<x-code>
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Click me',
            url: 'https://moonshine-laravel.com',
        )
            ->withConfirm(
                'Confirm modal title',
                'Confirm modal content',
                'Confirm modal button',
            ) // [tl! focus:-4]
    ];
}
</x-code>

<x-sub-title id="offcanvas">Offcanvas</x-sub-title>

<x-p>
    Для того, чтобы по клику на кнопку произошел вызов offcanvas, воспользуйтесь методом <code>inOffCanvas()</code>.
</x-p>

<x-code>
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Click me',
            url: 'https://moonshine-laravel.com',
        )
            ->inOffCanvas(
                fn() => 'OffCanvas title',
                fn() => form()->fields([Text::make('Text')]),
                isLeft: false
            ) // [tl! focus:-4]
    ];
}
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')
    ->inOffCanvas(fn() => 'OffCanvas title', fn() => form()->fields([MoonShine\Fields\Text::make('Text')])) !!}

<x-sub-title id="group">Группы</x-sub-title>

<x-p>
    Если Вам необходимо выстроить логику с несколькими <code>ActionButton</code>,
    при этом некоторые должны быть скрыты или отображаться в выпадающем меню,
    в таком случае воспользуйтесь компонентом <code>ActionGroup</code>
</x-p>

<x-code>
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\ActionGroup; // [tl! focus]

public function components(): array
{
    return [
        ActionGroup::make([
            ActionButton::make('Button 1', '/')->canSee(fn() => false),
            ActionButton::make('Button 2', '/', $model)->canSee(fn($model) => $model->active)
        ]) // [tl! focus:-3]
    ];
}
</x-code>

<x-moonshine::divider label="Отображение" />

<x-p>
    Вы также благодаря <em>ActionGroup</em> можете изменить отображение кнопок,
    отображать их в линию или же в выпадающем меню для экономии места.
</x-p>

<x-code>
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\ActionGroup;

public function components(): array
{
    return [
        ActionGroup::make([
            ActionButton::make('Button 1', '/')->showInLine(),
            ActionButton::make('Button 2', '/')->showInDropdown()
        ])
    ];
}
</x-code>

<x-sub-title id="bulk">Bulk</x-sub-title>

<x-p>
    Метод <code>bulk()</code> позволяет создать кнопку для массовых действий для <em>ModelResource</em>.
</x-p>

<x-code>
public function indexButtons(): array
{
    return [
        ActionButton::make('Link', '/endpoint')->bulk(),
    ];
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Метод <code>bulk()</code>, используется только внутри <em>ModelResource</em>.
</x-moonshine::alert>

<x-sub-title id="async">Асинхронный режим</x-sub-title>

<x-p>
    Метод <code>async()</code> позволяет реализовать асинхронный режим работы для <em>ActionButton</em>.
</x-p>

<x-code language="php">
async(
    string $method = 'GET',
    ?string $selector = null,
    array $events = []
    ?string $callback = null
)
</x-code>

<x-ul>
    <li><code>$method</code> - метод асинхронного запроса;</li>
    <li><code>$selector</code> - selector элемента у которого будет изменяться контент;</li>
    <li><code>$events</code> - вызываемые события после успешного запроса;</li>
    <li><code>$callback</code> - js callback функция после получения ответа.</li>
</x-ul>

<x-code language="php">
public function components(): array
{
    return [
        ActionButton::make(
            'Click me',
            '/endpoint'
        )
            ->async() // [tl! focus]
    ];
}
</x-code>

<x-moonshine::divider label="Уведомления" />

<x-p>
    Если Вам необходимо после клика отобразить уведомление или сделать редирект,
    то достаточно реализовать json ответ по структуре:
</x-p>

<x-code language="json">
{message: 'Toast', type: 'success', redirect: '/url'}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Параметр <code>redirect</code> не является обязательным.
</x-moonshine::alert>

<x-moonshine::divider label="HTML контент" />

<x-p>
    Если требуется по клику заменить область с html, то вы можете в ответе вернуть HTML контент или json с ключом html:
</x-p>

<x-code language="json">
{html: 'Html content'}
</x-code>

<x-code language="php">
public function components(): array
{
    return [
        ActionButton::make(
            'Click me',
            '/endpoint'
        )
            ->async(selector: '#my-selector') // [tl! focus]
    ];
}
</x-code>

<x-moonshine::divider label="События" />

<x-p>
    После успешного запроса можно вызывать события:
</x-p>

<x-code language="php">
public function components(): array
{
    return [
        ActionButton::make(
            'Click me',
            '/endpoint'
        )
            ->async(events: ['table-updated-index-table']) // [tl! focus]
    ];
}
</x-code>

<x-moonshine::divider label="Callback" />

<x-p>
    Если необходимо обработать ответ иным способом, то необходимо реализовать функцию-обработчик
    и указать ее в методе <code>async()</code>.
</x-p>

<x-code language="php">
public function components(): array
{
    return [
        ActionButton::make(
            'Click me',
            '/endpoint'
        )
            ->async(callback: 'myFunction') // [tl! focus]
    ];
}
</x-code>

<x-code language="javascript">
window.myFunction = function(response, element, events, component)
{
    if(response.confirmed === true) {
        component.$dispatch('toast', {type: 'success', text: 'Success'})
    } else {
        component.$dispatch('toast', {type: 'error', text: 'Error'})
    }
}
</x-code>

<x-sub-title id="method">Вызов методов</x-sub-title>

<x-p>
    <code>method()</code> позволяют указать название метода в ресурсе и асинхронно вызывать его при клике по
    <em>ActionButton</em> без необходимости создавать дополнительные контроллеры.
</x-p>

<x-code language="php">
public function components(): array
{
    return [
        ActionButton::make('Click me')
            ->method('updateSomething'), // [tl! focus]
    ];
}
</x-code>

<x-code language="php">
// With toast
public function updateSomething(MoonShineRequest $request)
{
    // $request->getResource();
    // $request->getResource()->getItem();
    // $request->getPage();

    MoonShineUI::toast('MyMessage', 'success');

    return back();
}

// Exception
public function updateSomething(MoonShineRequest $request)
{
    throw new \Exception('My message');
}

// Custom json response
public function updateSomething(MoonShineRequest $request)
{
    return MoonShineJsonResponse::make()->toast('MyMessage', ToastType::SUCCESS);
}
</x-code>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    Методы в вызываемые через <em>ActionButton</em> в ресурсе должны быть публичными!
</x-moonshine::alert>

</x-page>
