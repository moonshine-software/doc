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
use Leeto\MoonShine\Decorations\Flex;

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

<x-sub-title id="grid-column">Grid/Column</x-sub-title>

<x-p>
    Grid with speakers
</x-p>

<x-code language="php">
use Leeto\MoonShine\Decorations\Grid;
use Leeto\MoonShine\Decorations\Column;

//...
public function fields(): array
{
    return [
        Grid::make([
            Column::make([
                Block::make('Main information', [
                    // Fields here
                ])
            ])->columnSpan(6), // 6 from 12 - half screen

            Column::make([
                Block::make('Contact information', [
                    // Fields here
                ])
            ])->columnSpan(6), // 6 of 12 - half of the screen
        ])
    ];
}
//...
</x-code>

<x-p>
    The result is two columns with blocks
</x-p>
</x-page>
