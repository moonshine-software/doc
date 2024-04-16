<x-page title="ActionButton"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#blank', 'label' => 'Blank'],
            ['url' => '#icon', 'label' => 'Icon'],
            ['url' => '#color', 'label' => 'Color'],
            ['url' => '#onclick', 'label' => 'onClick'],
            ['url' => '#modal', 'label' => 'Modal'],
            ['url' => '#confirm', 'label' => 'Confirm'],
            ['url' => '#offcanvas', 'label' => 'Offcanvas'],
            ['url' => '#group', 'label' => 'Group'],
            ['url' => '#bulk', 'label' => 'Bulk'],
            ['url' => '#async', 'label' => 'Async mode'],
            ['url' => '#method', 'label' => 'Calling methods'],
            ['url' => '#event', 'label' => 'Dispatch events'],
        ]
    ]"
>

<x-extendby :href="to_page('components-moonshine_component')">
    MoonShineComponent
</x-extendby>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    When you need to add a button with a specific action, ActionButtons come to the rescue.
    In MoonShine they are already used - in forms, tables, on pages.
</x-p>

<x-code language="php">
ActionButton::make(
    Closure|string $label,
    Closure|string|null $url = null,
    mixed $item = null
)
</x-code>

<x-ul>
    <li><code>label</code> - button text,</li>
    <li><code>url</code> - URL of the button link,</li>
    <li><code>item</code> - optional button data available in closures.</li>
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
    The <code>blank()</code> method allows you to open a URL in a new window.
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
    The <code>icon()</code> method allows you to specify an icon for a button.
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

@include('pages.en.shared.alert_icons')

<x-sub-title id="color">Color</x-sub-title>

<x-p>
    For <em>ActionButton</em> there is a set of methods that allow you to set the color of the button:
    <code>primary()</code>, <code>secondary()</code>, <code>warning()</code>, <code>success()</code>
    and <code>error()</code>.
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
    The <code>onClick</code> method allows you to execute js code on click:
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
            ->onClick(fn() => "alert('Example')", 'prevent') // [tl! focus]
    ];
}
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')->onClick(fn() => "alert('Example')", 'prevent') !!}

<x-sub-title id="modal">Modal</x-sub-title>

<x-moonshine::divider label="Basics" />

<x-p>
    To trigger a modal window when a button is clicked, use the <code>inModal()</code> method.
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
    <li><code>title</code> - modal title,</li>
    <li><code>content</code> - modal content,</li>
    <li><code>buttons</code> - modal buttons,</li>
    <li><code>async</code> - async mode,</li>
    <li><code>wide</code> - maximum modal width,</li>
    <li><code>auto</code> - width of modal window by content,</li>
    <li><code>closeOutside</code> - close the modal window when clicking outside the window area,</li>
    <li><code>attributes</code> - additional attributes,</li>
    <li><code>autoClose</code> - auto close modal window after successful request.</li>
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

<x-p>
    You can also open a modal window using the <code>toggleModal</code> method, and if the ActionButton is inside
    modal window then just <code>openModal</code>
</x-p>

<x-code>
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\Modal;

public function components(): array
{
    return [
        MoonShine\Components\Modal::make(
            'Title',
            fn() => 'Content',
        )->name('my-modal')

        ActionButton::make(
            label: 'Open modal',
            url: '#',
        )->toggleModal('my-modal') // [tl! focus:-7]
    ];
}
</x-code>

<x-moonshine::divider label="Async" />

<x-p>
    If you need to load content into the modal window asynchronously,
    then switch the async parameter to <code>true</code>.
</x-p>

<x-code>
use MoonShine\ActionButtons\ActionButton;

public function components(): array
{
    return [
        ActionButton::make(
            label: 'Click me',
            url: to_page('action_button', fragment: 'doc-content'),
        )
            ->inModal(
                title: fn() => 'Modal title',
                async: true // [tl! focus]
            )
    ];
}
</x-code>

{!! actionBtn('Example', to_page('action_button', fragment: 'doc-content'))->inModal(
    title: fn() => 'Modal title',
    async: true
) !!}

<x-moonshine::alert class="my-4" type="default" icon="heroicons.book-open">
    About <x-link link="{{ to_page('components-decoration_fragment') }}">Fragment</x-link>
    can be found in the "Components" section
</x-moonshine::alert>

<x-sub-title id="confirm">Confirm</x-sub-title>

<x-p>
    The <code>withConfirm()</code> method allows you to create a button with confirmation of an action.
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

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    <code>withConfirm</code> does not work with <code>async</code> modes. For asynchronous mode,
    you need to make your own implementation via
    <x-link link="{{ to_page('components-decoration_modal') }}">Modal</x-link> or
    <x-link link="#modal">inModal()</x-link>.
</x-moonshine::alert>

<x-sub-title id="offcanvas">Offcanvas</x-sub-title>

<x-p>
    In order for offcanvas to be called when a button is clicked, use the <code>inOffCanvas()</code> method.
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

<x-sub-title id="group">Group</x-sub-title>

<x-p>
    If you need to build logic with several <code>ActionButton</code>,
    however, some should be hidden or displayed in a drop-down menu,
    in this case, use the <code>ActionGroup</code> component
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

<x-moonshine::divider label="Display" />

<x-p>
    Thanks to <em>ActionGroup</em> you can also change the display of buttons,
    display them in a line or in a drop-down menu to save space.
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
    The <code>bulk()</code> method allows you to create a bulk action button for a <em>ModelResource</em>.
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
    The <code>bulk()</code> method, used only inside <em>ModelResource</em>.
</x-moonshine::alert>

<x-sub-title id="async">Async mode</x-sub-title>

<x-p>
    The <code>async()</code> method allows you to implement asynchronous operation for the <em>ActionButton</em>.
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
    <li><code>$method</code> - asynchronous request method;</li>
    <li><code>$selector</code> - selector of the element whose content will change;</li>
    <li><code>$events</code> - events raised after a successful request;</li>
    <li><code>$callback</code> - js callback function after receiving the response.</li>
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

<x-moonshine::divider label="Notifications" />

<x-p>
    If you need to display a notification or make a redirect after a click,
     then it is enough to implement the json response according to the structure:
</x-p>

<x-code language="json">
{message: 'Toast', messageType: 'success', redirect: '/url'}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    The <code>redirect</code> parameter is optional.
</x-moonshine::alert>

<x-moonshine::divider label="HTML content" />

<x-p>
    If you need to replace an area with html on click, then you can return HTML content or json with the html key in the response:
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

<x-moonshine::divider label="Events" />

<x-p>
    After a successful request, you can raise events:
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

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For the <code>table-updated-index-table</code> event to work
    <x-link link="{{ to_page('resources-table') }}#async">async mode</x-link> must be enabled.
</x-moonshine::alert>

<x-moonshine::divider label="Callback" />

<x-p>
    If you need to process the response in a different way, then you need to implement a handler function
    and specify it in the <code>async()</code> method.
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
document.addEventListener("moonshine:init", () => {
    MoonShine.onCallback('myFunction', function(response, element, events, component) {
        if(response.confirmed === true) {
            component.$dispatch('toast', {type: 'success', text: 'Success'})
        } else {
            component.$dispatch('toast', {type: 'error', text: 'Error'})
        }
    })
})
</x-code>

<x-sub-title id="method">Calling methods</x-sub-title>

<x-p>
    <code>method()</code> allow you to specify the name of a method in a resource and call it asynchronously when you click on it
    <em>ActionButton</em> without having to create additional controllers.
</x-p>

<x-code language="php">
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
</x-code>

<x-ul>
    <li><code>$method</code> - name of the method</li>
    <li><code>$params</code> - parameters for the request,</li>
    <li><code>$message</code> - messages</li>
    <li><code>$selector</code> - selector of the element whose content will change</li>
    <li><code>$events</code> - events to be called after a successful request,</li>
    <li><code>$callback</code> - js callback function after receiving a response</li>
    <li><code>$page</code> - page containing the method</li>
    <li><code>$resource</code> - resource containing the method.</li>
</x-ul>

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
    Methods called via <em>ActionButton</em> in a resource must be public!
</x-moonshine::alert>

<x-moonshine::alert type="error" icon="heroicons.information-circle">
    Для доступа к данным из реквеста, необходимо передать их в параметрах.
</x-moonshine::alert>

<x-moonshine::divider label="Передача текущего элемента" />

<x-p>
    Если в запросе присутствует <em>resourceItem</em>,
    то в ресурсе вы можете получить доступ к текущему элементу через метод <code>getItem()</code>.
</x-p>

<x-ul>
    <li>
        When there is a model in the data and the button is created in the <code>buttons()</code> method
        <x-link link="{{ to_page('advanced-table_builder') }}#buttons">TableBuilder</x-link>,
        <x-link link="{{ to_page('advanced-cards_builder') }}#buttons">CardsBuilder</x-link>
        or <x-link link="{{ to_page('advanced-form_builder') }}#buttons">FormBuilder</x-link>,
        then it is automatically filled with data and the parameters will contain <code>resourceItem</code>.
    </li>
    <li>
        When the button is on the <em>ModelResource</em> form page, you can pass the id of the current element.
<x-code language="php">
ActionButton::make('Click me')
    ->method(
        'updateSomething',
        params: ['resourceItem' => $this->getResource()->getItemID()] // [tl! focus]
    )
</x-code>
    </li>
    <li>
        When the button is in the <em>ModelResource</em> index table, you need to use a closure.
<x-code language="php">
ActionButton::make('Click me')
    ->method(
        'updateSomething',
        params: ['resourceItem' => fn($item) ['resourceItem' => $item->getKey()]] // [tl! focus]
    )
</x-code>
    </li>
</x-ul>

<x-sub-title id="event">Dispatch events</x-sub-title>

<x-p>
    To dispatch javascript events, you can use the <code>dispatchEvent()</code> method.
</x-p>

<x-code language="php">
dispatchEvent(array|string $events)
</x-code>

<x-code language="php">
ActionButton::make('Refresh', '#')
    ->dispatchEvent(AlpineJs::event(JsEvent::TABLE_UPDATED, 'index-table')), // [tl! focus]
</x-code>

</x-page>
