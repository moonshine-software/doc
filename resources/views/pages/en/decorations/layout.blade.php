<x-page title="Layout" :sectionMenu="[
    'Sections' => [
        ['url' => '#flex', 'label' => 'Flex'],
        ['url' => '#grid-column', 'label' => 'Grid/Column'],
    ]
]">
<x-p>
    Sometimes it is necessary to divide the form into several blocks for convenience, by default they go under each other, but with the help of scenery <code>Layout</code> you can easily change the display
</x-p>

<x-sub-title id="flex">Flex</x-sub-title>

<x-p>
    Changing the positioning of the fields in the line
</x-p>

<x-code language="php">
use MoonShine\Decorations\Flex;

    //...
    public function fields(): array
{
    return [
        Flex::make([
            Text::make('Title'),
            Text::make('Slug'),
        ])
            // Additional options
            ->withoutSpace() // Eliminate indentation
            ->justifyAlign('start') // Based on tailwind classes justify-[param]
            ->itemsAlign('start') // Based on tailwind classes items-[param]
    ];
}
//...
</x-code>

<x-moonshine::table
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

<x-image theme="light" src="{{ asset('screenshots/flex.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/flex_dark.png') }}"></x-image>

<x-sub-title id="grid-column">Grid/Column</x-sub-title>

<x-p>
    Grid with speakers
</x-p>

<x-code language="php">
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Column;

//...
public function fields(): array
{
    return [
        Grid::make([
            Column::make([
                Block::make('Main information', [
                    // Fields here
                ])
            ])->columnSpan(6), // 6 out of 12 is half of the screen

            Column::make([
                Block::make('Contact information', [
                    // Fields here
                ])
            ])->columnSpan(6), // 6 out of 12 is half of the screen
        ])
    ];
}
//...
</x-code>

<x-p>
    The result is two columns with blocks
</x-p>

<x-image theme="light" src="{{ asset('screenshots/grid.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/grid_dark.png') }}"></x-image>

</x-page>
