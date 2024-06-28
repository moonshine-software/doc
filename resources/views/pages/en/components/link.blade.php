<x-page
    title="Link Component"
    :sectionMenu="[
        'Section' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#icon', 'label' => 'Icon'],
            ['url' => '#badge', 'label' => 'Badge'],
            ['url' => '#button', 'label' => 'Button'],
            ['url' => '#filled', 'label' => 'Filled'],
            ['url' => '#tooltip', 'label' => 'Tooltip'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Link</em> component allows links.
</x-p>

<x-p>
    You can create a <em>Link</em> using the static <code>make()</code> method
    class <code>Link</code>.
</x-p>

<x-code language="php">
make(Closure|string $href, Closure|string $label = '')
</x-code>

<x-ul>
    <li><code>$href</code> - link url,</li>
    <li><code>$label</code> - title.</li>
</x-ul>

<x-code language="php">
use MoonShine\Components\Link; // [tl! focus]

//...

public function components(): array
{
    return [
        Link::make(
            '/endpoint',
            'Link'
        ) // [tl! focus:-3]
    ];
}

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!! MoonShine\Components\Link::make('#', 'Link') !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="icon">Icon</x-sub-title>

<x-p>
    The <code>icon()</code> method allows you to specify an icon for a link.
</x-p>

<x-code language="php">
icon(string $icon)
</x-code>

<x-code language="php">
use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Edit')
    ->icon('heroicons.outline.pencil') // [tl! focus]

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!! MoonShine\Components\Link::make('#', 'Edit')->icon('heroicons.outline.pencil') !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="badge">Badge</x-sub-title>

<x-p>
    The <code>badge()</code> method allows you to add a badge to a link.
</x-p>

<x-code language="php">
badge(Closure|string|int|float|null $value)
</x-code>

<x-code language="php">
use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Comments')
    ->badge(fn() => Comment::count()) // [tl! focus]

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!! MoonShine\Components\Link::make('#', 'Comments')->badge(25) !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="button">Button</x-sub-title>

<x-p>
    The <code>button()</code> method allows you to display a link as a button.
</x-p>

<x-code language="php">
badge()
</x-code>

<x-code language="php">
use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Link')
    ->button() // [tl! focus]

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!! MoonShine\Components\Link::make('#', 'Link')->button() !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="filled">Filled</x-sub-title>

<x-p>
    The <code>filled()</code> method sets the fill for the link.
</x-p>

<x-code language="php">
filled()
</x-code>

<x-code language="php">
use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Link')
    ->filled() // [tl! focus]

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            @include("examples/components/link-filled")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="tooltip">Tooltip</x-sub-title>

<x-p>
    The <code>tooltip()</code> method allows you to set a tooltip for a link.
</x-p>

<x-code language="php">
tooltip(?string $tooltip = null)
</x-code>

<x-code language="php">
use MoonShine\Components\Link;

//...

Link::make('/endpoint', 'Link')
    ->tooltip('Tooltip for link') // [tl! focus]

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!! MoonShine\Components\Link::make('#', 'Link')->tooltip('Tooltip for link') !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
