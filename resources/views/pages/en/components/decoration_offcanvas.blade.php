<x-page
    title="Component Offcanvas"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#events', 'label' => 'Events'],
            ['url' => '#open', 'label' => 'Default state'],
            ['url' => '#position', 'label' => 'Position'],
            ['url' => '#toggler-attributes', 'label' => 'Toggler attributes'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Offcanvas</em> decorator allows you to create sidebars.
</x-p>

<x-p>
    You can create <em>Offcanvas</em> using the static <code>make()</code> method.
</x-p>

<x-code language="php">
make(Closure|string $title, Closure|View|string $content, Closure|string $toggler = '', Closure|string|null $asyncUrl = '')
</x-code>

<x-ul>
    <li><code>$title</code> - sidebar title,</li>
    <li><code>$content</code> - sidebar content,</li>
    <li><code>$toggler</code> - title for button,</li>
    <li><code>$asyncUrl</code> - url for asynchronous content.</li>
</x-ul>

<x-code language="php">
use MoonShine\Components\FormBuilder;
use MoonShine\Components\Offcanvas; // [tl! focus]
use MoonShine\Fields\Password;

//...

public function components(): array
{
    return [
        Offcanvas::make( // [tl! focus:start]
            'Confirm',
            static fn() => FormBuilder::make(route('password.confirm'))
                ->async()
                ->fields([
                    Password::make('Password')->eye(),
                ])
                ->submit('Confirm'),
            'Show canvas'
        ) // [tl! focus:end]
    ];
}

//...
</x-code>

{!!
    MoonShine\Components\Offcanvas::make(
        'Confirm',
        static fn() => MoonShine\Components\FormBuilder::make(route('async'))
            ->async()
            ->fields([
                MoonShine\Fields\Password::make('Password')->eye(),
            ])
            ->submit('Confirm'),
        'Show canvas'
    )
!!}

<x-sub-title id="events">Events</x-sub-title>

<x-p>
    You can show or hide a sidebar not from a component through <em>javascript</em> events.<br />
    To have access to events, you must set a unique name for the sidebar using the <code>name()</code> method.
</x-p>

<x-code language="php">
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make(
            'Title',
            'Content...'
        )
            ->name('my-canvas') // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::divider label="calling an event via ActionButton" />

<x-p>
    The sidebar event can be triggered using the <em>ActionButton</em> component.
</x-p>
<x-code language="php">
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make(
            'Title',
            'Content...',
        )
            ->name('my-canvas'),

        ActionButton::make(
            'Show canvas',
            '/endpoint'
        )
            ->async(events: ['offcanvas-toggled-my-canvas']) // [tl! focus:-4]
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
    this.dispatchEvent(new Event("offcanvas-toggled-my-canvas"))
})
</x-code>

<x-moonshine::divider label="calling an event using the Alpine.js method" />

<x-p>
    Or use the magic <code>$dispatch()</code> method from <em>Alpine.js</em>:
</x-p>

<x-code language="javascript">
this.$dispatch('offcanvas-toggled-my-canvas')
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    More detailed information can be obtained from the official Alpine.js documentation in the sections
    <x-link link="https://alpinejs.dev/essentials/events" target="_blank">Events</x-link> and
    <x-link link="https://alpinejs.dev/magics/dispatch" target="_blank">$dispatch</x-link>.
</x-moonshine::alert>

<x-sub-title id="open">Default state</x-sub-title>

<x-p>
    The <code>open()</code> method allows you to show the sidebar when the page loads.
</x-p>

<x-code language="php">
open(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make('Title', 'Content...', 'Show canvas')
            ->open() // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    By default, the sidebar will be hidden when the page loads.
</x-moonshine::alert>

<x-sub-title id="position">Position</x-sub-title>

<x-p>
    By default, the sidebar is located on the right side of the screen,
    the <code>left()</code> method allows you to position the panel on the left side.
</x-p>

<x-code language="php">
left(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make('Title', 'Content...', 'Show canvas')
            ->left() // [tl! focus]
    ];
}

//...
</x-code>

{!!
    MoonShine\Components\Offcanvas::make('Title', 'Content...', 'Show canvas')
        ->left()
!!}

<x-sub-title id="toggler-attributes">Toggler attributes</x-sub-title>

<x-p>
    The <code>toggler Attributes()</code> method allows you to set additional attributes for the <code>$toggler</code> toggle.
</x-p>

<x-code language="php">
togglerAttributes(array $attributes)
</x-code>

<x-code language="php">
use MoonShine\Components\Offcanvas;

//...

public function components(): array
{
    return [
        Offcanvas::make('Title', 'Content...', 'Show canvas')
            ->togglerAttributes([
                'class' => 'mt-2'
            ]), // [tl! focus:-2]
    ];
}

//...
</x-code>

</x-page>
