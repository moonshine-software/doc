<x-page
    title="Scenery Layout"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#flex', 'label' => 'Flex'],
            ['url' => '#grid-column', 'label' => 'Grid/Column'],
        ]
    ]"
>

<x-p>
    Sometimes, for ease of perception, it is necessary to divide the form into several blocks. By default they
    are located one below the other, but with the help of <code>Layout</code> decorations you can easily change the display order.
</x-p>

<x-sub-title id="flex">Flex</x-sub-title>

<x-p>
    The <em>Flex</em> decoration gives elements the appropriate positioning.
</x-p>

<x-code language="php">
use MoonShine\Decorations\Flex; // [tl! focus]

//...

public function components(): array
{
    return [
        Flex::make([ // [tl! focus]
            Text::make('Title'),
            Text::make('Slug'),
        ]) // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/flex.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/flex_dark.png') }}"></x-image>

<x-moonshine::divider label="Additional options" />

<x-code language="php">
use MoonShine\Decorations\Flex;

//...

public function components(): array
{
    return [
        Flex::make([
            Text::make('Title'),
            Text::make('Slug'),
        ])
            ->withoutSpace() // Eliminate indentation [tl! focus]
            ->justifyAlign('start') // Based on tailwind classes justify-[param] [tl! focus]
            ->itemsAlign('start') // Based on tailwind classes items-[param] [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::table
    :simple="true"
    :columns="['param', 'justifyAlign()', 'itemsAlign()']"
    :values="[
        ['normal', 'justify-content: normal;', null],
        ['start', 'justify-content: flex-start;', 'align-items: flex-start;'],
        ['end', 'justify-content: flex-end;', 'align-items: flex-end;'],
        ['center', 'justify-content: center;', 'align-items: center;'],
        ['between', 'justify-content: space-between;', null],
        ['around', 'justify-content: space-around;', null],
        ['evenly', 'justify-content: space-evenly;', null],
        ['baseline', null, 'align-items: baseline;'],
        ['stretch', 'justify-content: stretch;', 'align-items: stretch;'],
    ]"
/>

<x-sub-title id="grid-column">Grid/Column</x-sub-title>

<x-p>
    The <em>Grid</em> and <em>Column</em> decorators allow you to organize a grid with columns.
</x-p>

<x-p>
    The <code>columnSpan()</code> method allows you to set the width of a block in a <em>Grid</em> grid.
</x-p>

<x-code language="php">
columnSpan(
    int $columnSpan,
    int $adaptiveColumnSpan = 12
)
</x-code>

<x-p>
    <code>$columnSpan</code> - value for desktop version,<br>
    <code>$adaptiveColumnSpan</code> - meaning for the mobile version.
</x-p>

<x-code language="php">
use MoonShine\Decorations\Grid; // [tl! focus]
use MoonShine\Decorations\Column; // [tl! focus]

//...
public function components(): array
{
    return [
        Grid::make([ // [tl! focus:1]
            Column::make([
                // ...
            ])
                ->columnSpan(6), // [tl! focus:-1]

            Column::make([ // [tl! focus]
                // ...
            ])
                ->columnSpan(6) // [tl! focus:-1]
        ])
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    The <strong>MoonShine</strong> admin panel uses a 12-column grid.
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/grid.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/grid_dark.png') }}"></x-image>

</x-page>
