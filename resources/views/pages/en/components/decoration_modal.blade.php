<x-page
    title="Component Modal"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#events', 'label' => 'Events'],
            ['url' => '#open', 'label' => 'Default state'],
            ['url' => '#close-outside', 'label' => 'Click outside'],
            ['url' => '#wide', 'label' => 'Width'],
            ['url' => '#outer-attributes', 'label' => 'Outer attributes'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Modal</em> decorator allows you to create modal windows.
</x-p>

<x-p>
    You can create <em>Modal</em> using the static method <code>make()</code>.
</x-p>

<x-code language="php">
make(Closure|string $title, Closure|View|string $content, Closure|View|ActionButton|string $outer = '', Closure|string|null $asyncUrl = '')
</x-code>

<x-p>
    <ul>
        <li><code>$title</code> - modal window title,</li>
        <li><code>$content</code> - modal window content,</li>
        <li><code>$outer</code> - external block with window call handler,</li>
        <li><code>$asyncUrl</code> - url for asynchronous content.</li>
    </ul>
</x-p>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\FormBuilder;
use MoonShine\Components\Modal; // [tl! focus]
use MoonShine\Fields\Password;

//...

public function components(): array
{
    return [
        Modal::make( // [tl! focus:start]
            'Confirm',
            static fn() => FormBuilder::make(route('password.confirm'))
                ->async()
                ->fields([
                    Password::make('Password')->eye(),
                ])
                ->submit('Confirm'),
            ActionButton::make('Show modal', '#')
        ) // [tl! focus:end]
    ];
}

//...
</x-code>

{!!
    MoonShine\Components\Modal::make(
        'Confirm',
        static fn() => MoonShine\Components\FormBuilder::make(route('async'))
            ->async()
            ->fields([
                MoonShine\Fields\Password::make('Password')->eye(),
            ])
            ->submit('Confirm'),
        '<a class="btn">Show modal</a>'
    )
!!}

<x-sub-title id="events">Events</x-sub-title>

<x-p>
    You can open or close a modal window not using component via <em>javascript</em> events.<br />
    To have access to events, you must set a unique name for the modal window using the <code>name()</code> method.
</x-p>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make(
            'Title',
            'Content...',
        )
            ->name('my-modal'), // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::divider label="calling an event via ActionButton" />

<x-p>
    The modal window event can be triggered using the <em>ActionButton</em> component.
</x-p>
<x-code language="php">
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make(
            'Title',
            'Content...',
        )
            ->name('my-modal'),

        ActionButton::make(
            'Show modal',
            '/endpoint'
        )
            ->async(events: ['modal-toggled-my-modal']) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-moonshine::divider label="calling an event using native methods" />

<x-p>
    Events can be triggered using native <em>javascript</em> methods:
</x-p>

<x-code language="javascript">
document.addEventListener("DOMContentLoaded", () => {
    this.dispatchEvent(new Event("modal-toggled-my-modal"))
})
</x-code>

<x-moonshine::divider label="calling an event using the Alpine.js method" />

<x-p>
    Or using the magic <code>$dispatch()</code> method from <em>Alpine.js</em>:
</x-p>

<x-code language="javascript">
this.$dispatch('modal-toggled-my-modal')
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    More detailed information can be obtained from the official Alpine.js documentation in the sections
    <x-link link="https://alpinejs.dev/essentials/events" target="_blank">Events</x-link> and
    <x-link link="https://alpinejs.dev/magics/dispatch" target="_blank">$dispatch</x-link>.
</x-moonshine::alert>

<x-sub-title id="open">Default state</x-sub-title>

<x-p>
    The <code>open()</code> method allows you to open a modal window when loading the page.
</x-p>

<x-code language="php">
open(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Title', 'Content...', view('path'))
            ->open(), // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    By default, the modal window will remain closed when the page loads..
</x-moonshine::alert>

<x-sub-title id="close-outside">Click outside</x-sub-title>

<x-p>
    By default, a modal window closes when clicked outside the window area.<br />
    The <code>closeOutside()</code> method allows you to override this behavior.
</x-p>

<x-code language="php">
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Title', 'Content...', '<a class="btn">Show modal</a>')
            ->closeOutside(false), // [tl! focus]
    ];
}

//...
</x-code>

{!!
    MoonShine\Components\Modal::make('Title', 'Content...', '<a class="btn">Show modal</a>')->closeOutside(false)
!!}

<x-sub-title id="wide">Wide</x-sub-title>

<x-moonshine::divider label="wide" />

<x-p>
    The <code>wide()</code> method of the <em>Modal</em> component sets the maximum width of the modal window.
</x-p>

<x-code language="php">
wide(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Title', 'Content...', '<a class="btn">Show modal</a>')
            ->wide(), // [tl! focus]
    ];
}

//...
</x-code>

{!!
    MoonShine\Components\Modal::make('Title', 'Content...', '<a class="btn">Show modal</a>')->wide()
!!}

<x-moonshine::divider label="auto" />

<x-p>
    The <code>auto()</code> method of the <em>Modal</em> component sets the width of the modal window based on the content.
</x-p>

<x-code language="php">
auto(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Title', 'Content...', '<a class="btn">Show modal</a>')
            ->auto(), // [tl! focus]
    ];
}

//...
</x-code>

{!!
    MoonShine\Components\Modal::make('Title', 'Content...', '<a class="btn">Show modal</a>')->auto()
!!}

<x-sub-title id="outer-attributes">Outer attributes</x-sub-title>

<x-p>
    The <code>outer Attributes()</code> method allows you to set additional attributes for the outer <code>$outer</code> block.
</x-p>

<x-code language="php">
outerAttributes(array $attributes)
</x-code>

<x-code language="php">
use MoonShine\Components\Modal;

//...

public function components(): array
{
    return [
        Modal::make('Title', 'Content...', '<a class="btn">Show modal</a>')
            ->outerAttributes([
                'class' => 'mt-2'
            ]), // [tl! focus:-2]
    ];
}

//...
</x-code>

</x-page>
