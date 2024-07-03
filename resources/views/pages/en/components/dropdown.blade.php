<x-page
    title="Dropdown Component"
    :sectionMenu="[
        'Section' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#toggler', 'label' => 'Toggler'],
            ['url' => '#items', 'label' => 'Items'],
            ['url' => '#searchable', 'label' => 'Search item'],
            ['url' => '#content', 'label' => 'Content'],
            ['url' => '#placement', 'label' => 'Placement'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Dropdown</em> component allows you to create drop-down blocks.
</x-p>

<x-p>
    You can create a <em>Dropdown</em> using the static <code>make()</code> method
    class <code>Dropdown</code>.
</x-p>

<x-code language="php">
make(
    ?string $title = null,
    Closure|string $toggler = '',
    Closure|View|string $content = '',
    bool $isSearchable = false,
    Closure|array $items = [],
    string $placement = 'bottom-start'
)
</x-code>

<x-ul>
    <li><code>$title</code> - title of the dropdown,</li>
    <li><code>$toggler</code> - switch,</li>
    <li><code>$content</code> - content</li>
    <li><code>$isSearchable</code> - search by elements</li>
    <li><code>$items</code> - block elements,</li>
    <li><code>$placement</code> - location of the dropdown.</li>
</x-ul>

<x-code language="php">
use MoonShine\Components\Dropdown;
use MoonShine\Components\Link;

Dropdown::make(
    title: 'Title',
    toggler: 'Click me',
    items: [
        Link::make('#', 'Link 1'),
        Link::make('#', 'Link 2'),
        Link::make('#', 'Link 3'),
    ],
    placement: 'top',
) // [tl! focus:-9]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!!
                MoonShine\Components\Dropdown::make(
                    title: 'Title',
                    toggler: 'Click me',
                    items: [
                        MoonShine\Components\Link::make('#', 'Link 1'),
                        MoonShine\Components\Link::make('#', 'Link 2'),
                        MoonShine\Components\Link::make('#', 'Link 3'),
                    ],
                    placement: 'top',
                )
            !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="toggler">Toggler</x-sub-title>

<x-p>
    The <code>toggler()</code> method allows you to specify an element that, when clicked, will open <code>Dropdown</code>.
</x-p>

<x-code language="php">
toggler(Closure|string $toggler)
</x-code>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\Dropdown;

Dropdown::make(
    title: 'Dropdown',
    content: fn() => fake()->text()
)
    ->toggler(fn() => ActionButton::make('Click me')) // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!!
                MoonShine\Components\Dropdown::make(
                    title: 'Dropdown',
                    toggler: fn() => MoonShine\ActionButtons\ActionButton::make('Click me'),
                    content: fn() => '<div class="m-4">' . fake()->text() . '</div>'
                )
            !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="items">Items</x-sub-title>

<x-p>
    The <code>items()</code> method allows you to add items to the dropdown list.
</x-p>

<x-code language="php">
items(Closure|array $items)
</x-code>

<x-code language="php">
use MoonShine\Components\Dropdown;
use MoonShine\Components\Link;

Dropdown::make(
    toggler: 'Click me',
)
    ->items([
        Link::make('#', 'Link 1'),
        Link::make('#', 'Link 2'),
        Link::make('#', 'Link 3'),
    ]) // [tl! focus:-4]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!!
                MoonShine\Components\Dropdown::make(
                    toggler: 'Click me',
                )
                    ->items([
                        MoonShine\Components\Link::make('#', 'Link 1'),
                        MoonShine\Components\Link::make('#', 'Link 2'),
                        MoonShine\Components\Link::make('#', 'Link 3'),
                    ])
                !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="searchable">Search item</x-sub-title>

<x-p>
    The <code>searchable()</code> method allows you to add a search for elements in the dropdown.
</x-p>

<x-code language="php">
searchable(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Components\Dropdown;
use MoonShine\Components\Link;

Dropdown::make(
    toggler: 'Click me',
)
    ->items([
        Link::make('#', 'Link 1'),
        Link::make('#', 'Link 2'),
        Link::make('#', 'Link 3'),
    ])
    ->searchable() // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!!
                MoonShine\Components\Dropdown::make(
                    toggler: 'Click me',
                )
                    ->items([
                        MoonShine\Components\Link::make('#', 'Link 1'),
                        MoonShine\Components\Link::make('#', 'Link 2'),
                        MoonShine\Components\Link::make('#', 'Link 3'),
                    ])
                    ->searchable()
                !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-moonshine::divider label="Placeholder" />

<x-p>
    The <code>searchPlaceholder()</code> method allows you to change the placeholder in the search field.
</x-p>

<x-code language="php">
searchPlaceholder(Closure|string $placeholder)
</x-code>

<x-code language="php">
use MoonShine\Components\Dropdown;
use MoonShine\Components\Link;

Dropdown::make(
    toggler: 'Click me',
)
    ->items([
        Link::make('#', 'Link 1'),
        Link::make('#', 'Link 2'),
        Link::make('#', 'Link 3'),
    ])
    ->searchable()
    ->searchPlaceholder('Search item') // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!!
                MoonShine\Components\Dropdown::make(
                    toggler: 'Click me',
                )
                    ->items([
                        MoonShine\Components\Link::make('#', 'Link 1'),
                        MoonShine\Components\Link::make('#', 'Link 2'),
                        MoonShine\Components\Link::make('#', 'Link 3'),
                    ])
                    ->searchable()
                    ->searchPlaceholder('Search item')
                !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="content">Content</x-sub-title>

<x-p>
    The <code>content()</code> method allows you to display arbitrary content in the revealing block.
</x-p>

<x-code language="php">
content(Closure|View|string $content)
</x-code>

<x-code language="php">
use MoonShine\Components\Dropdown;

Dropdown::make(
    toggler: 'Click me',
)
    ->content(fake()->text()) // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!!
                MoonShine\Components\Dropdown::make(
                    toggler: 'Click me',
                )
                    ->content('<div class="m-4">' . fake()->text() . '</div>')
            !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="placement">Placement</x-sub-title>

<x-p>
    The <code>placement()</code> method allows you to change the location of the dropdown.
</x-p>

<x-code language="php">
placement(string $placement)
</x-code>

@include('pages.en.ui.shared.placement')

<x-code language="php">
use MoonShine\Components\Dropdown;

Dropdown::make(
    toggler: 'Click me',
    content: fake()->text(),
)
    ->placement('right') // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!!
                MoonShine\Components\Dropdown::make(
                    toggler: 'Click me',
                    content: '<div class="m-4">' . fake()->text() . '</div>',
                )
                    ->placement('right')
            !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.book-open">
        Additional location options can be found in the official documentation
        <x-link link="https://atomiks.github.io/tippyjs/v6/all-props/#placement" target="_blank">tippy.js</x-link>.
    </x-moonshine::alert>
</x-p>

</x-page>
