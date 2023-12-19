<x-page title="ActionButton"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#methods', 'label' => 'Methods'],
            ['url' => '#modal', 'label' => 'Modal'],
            ['url' => '#offcanvas', 'label' => 'Offcanvas'],
            ['url' => '#group', 'label' => 'Group methods'],
            ['url' => '#async', 'label' => 'Asynchronous mode'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    When you need to add a button with a specific action, ActionButtons come to the rescue.
    In MoonShine they are already used - in forms, tables, on pages
</x-p>

<x-code language="php">
make(
    Closure|string $label,
    Closure|string|null $url = null,
    mixed $item = null
)
</x-code>

<x-ul>
    <li><code>label</code> - Button text,</li>
    <li><code>url</code> - Url,</li>
    <li><code>item</code> - Optional button data available in closures.</li>
</x-ul>

<x-code>
public function components(): array
{
    return [
        ActionButton::make(
            label: 'Button title',
            url: 'https://moonshine-laravel.com',
        ),
    ];
}
</x-code>

<x-p>
    A helper is also available that can be used in blade
</x-p>

<x-code>
<div>
    @{!! actionBtn('Click me', 'https://moonshine-laravel.com') !!}
</div>
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com') !!}

<x-sub-title id="methods">Methods</x-sub-title>

<x-moonshine::divider label="blank" />

<x-p>
    Open in new window
</x-p>
<x-code>
ActionButton::make(
    label: 'Click me',
    url: 'https://moonshine-laravel.com',
)->blank(),
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')->blank() !!}

<x-moonshine::divider label="icon" />

<x-p>
    Icon
</x-p>
<x-code>
ActionButton::make(
    label: 'Click me',
    url: 'https://moonshine-laravel.com',
)->icon('heroicons.outline.pencil'),
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')->icon('heroicons.outline.pencil') !!}

<x-moonshine::divider label="Attributes" />

<x-p>
    You can set any html attributes for a button using the customAttributes method
</x-p>
<x-code>
ActionButton::make(
    label: 'Click me',
    url: 'https://moonshine-laravel.com',
)->customAttributes(['class' => 'btn-primary']),
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')->customAttributes(['class' => 'btn-primary']) !!}

<x-moonshine::divider label="Colors" />

<x-p>
    In order not to keep in mind the classes for changing the button color, we have prepared ready-made classes for you
</x-p>
<x-code>
ActionButton::make(
    label: 'Click me',
    url: 'https://moonshine-laravel.com',
)->primary(), //secondary, warning, success, error
</x-code>

{!! actionBtn('Primary', 'https://moonshine-laravel.com')->primary() !!}
{!! actionBtn('Secondary', 'https://moonshine-laravel.com')->secondary() !!}
{!! actionBtn('Warning', 'https://moonshine-laravel.com')->warning() !!}
{!! actionBtn('Success', 'https://moonshine-laravel.com')->success() !!}
{!! actionBtn('Error', 'https://moonshine-laravel.com')->error() !!}

<x-moonshine::divider label="onClick" />

<x-p>
    Ability to execute js on click
</x-p>

<x-code>
ActionButton::make(
    label: 'Click me',
    url: 'https://moonshine-laravel.com',
)->onClick(fn() => 'alert("Example")', 'prevent'),
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')->onClick(fn() => 'alert("Example")', 'prevent') !!}

<x-sub-title id="modal">Modal</x-sub-title>
<x-moonshine::divider label="Basics" />

<x-p>
    To trigger a modal window when a button is clicked, use the method <code>inModal</code>
</x-p>

<x-code>
ActionButton::make(
    label: 'Click me',
    url: 'https://moonshine-laravel.com',
)->inModal(
    title: fn() => 'Modal title',
    content: fn() => 'Modal content',
    buttons: [
        ActionButton::make('Click me in modal', 'https://moonshine-laravel.com')
    ],
    async: false
),
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')
    ->inModal(fn() => 'Modal title', fn() => 'Modal content', [
        actionBtn('Click me in modal', 'https://moonshine-laravel.com')
]) !!}

<x-moonshine::divider label="withConfirm" />

<x-p>
    A quick way to create a confirmation button <code>withConfirm</code>
</x-p>

<x-code>
ActionButton::make(
    label: 'Click me',
    url: 'https://moonshine-laravel.com',
)->withConfirm(
    'Confirm modal title',
    'Confirm modal content',
    'Confirm modal button',
),
</x-code>

<x-moonshine::divider label="Async" />

<x-p>
    If you need to load content into the modal window asynchronously, then switch the async parameter to true
</x-p>

@fragment('action-btn-fragment')
<x-code>
ActionButton::make(
    label: 'Click me',
    url: route('moonshine.page', ['pageUri' => 'action_button', '_fragment-load' => 'doc-content']),
)->inModal(
    title: fn() => 'Modal title',
    async: true
),
</x-code>
@endfragment

{!! actionBtn('Example', route('moonshine.page', ['pageUri' => 'action_button', '_fragment-load' => 'doc-content']))->inModal(
    title: fn() => 'Modal title',
    async: true
) !!}

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.book-open">
        You can learn about Fragment in the "Decoration" section
    </x-moonshine::alert>
</x-p>

<x-sub-title id="offcanvas">Offcanvas</x-sub-title>

<x-p>
    To call offcanvas when a button is clicked, use the <code>inOffCanvas</code> method
</x-p>

<x-code>
ActionButton::make(
    label: 'Click me',
    url: 'https://moonshine-laravel.com',
)->inOffCanvas(fn() => 'OffCanvas title', fn() => form()->fields([Text::make('Text')]), isLeft: false) ,
</x-code>

{!! actionBtn('Example', 'https://moonshine-laravel.com')
    ->inOffCanvas(fn() => 'OffCanvas title', fn() => form()->fields([MoonShine\Fields\Text::make('Text')])) !!}

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.book-open">
        You can learn about FormBuilder in the "Advanced" section
    </x-moonshine::alert>
</x-p>

<x-sub-title id="group">Group Methods</x-sub-title>

<x-p>
    If you need to build logic with several <code>ActionButton</code>, while some should be hidden or displayed in the drop-down menu,
     in this case, use the <code>ActionGroup</code> component
</x-p>

<x-moonshine::divider label="canSee" />

<x-p>
    Display condition
</x-p>

<x-code>
public function components(): array
{
    return [
        ActionGroup::make([
            ActionButton::make('Button 1', '/')->canSee(fn() => false),
            ActionButton::make('Button 2', '/', $model)->canSee(fn($model) => $model->active)
        ])
    ];
}
</x-code>

<x-moonshine::divider label="Display" />

<x-p>
    Thanks to ActionGroup, you can also change the display of buttons, display them in a line or in a drop-down menu to save space
</x-p>

<x-code>
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

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.book-open">
        <code>bulk()</code> method, used only inside ModelResource
    </x-moonshine::alert>
</x-p>

<x-sub-title id="async">Asynchronous mode</x-sub-title>

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
{message: 'Toast', type: 'success', redirect: '/url'}
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
window.myFunction = function(response, element, events, component)
{
    if(response.confirmed === true) {
        component.$dispatch('toast', {type: 'success', text: 'Success'})
    } else {
        component.$dispatch('toast', {type: 'error', text: 'Error'})
    }
}
</x-code>

</x-page>
