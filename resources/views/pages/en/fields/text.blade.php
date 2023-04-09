<x-page title="Text" :sectionMenu="[
    'Sections' => [
        ['url' => '#mask', 'label' => 'Mask'],
        ['url' => '#extensions', 'label' => 'Extensions'],
    ]
]">

<x-p>
    The text field includes all the basic methods
</x-p>

<x-code language="php">
use MoonShine\Fields\Text; // [tl! focus]

//...

public function fields(): array
{
    return [
        Text::make('Title', 'title')  // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="mask">Mask</x-sub-title>

<x-p>
    The method <code>mask</code> if you want to add a mask to the field
</x-p>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title', 'title')
            ->mask('7 (999) 999-99-99') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="extensions">Extensions</x-sub-title>

<x-code language="php">
//...

public function fields(): array
{
    return [
        Text::make('Title', 'title')
            // Copy input value to clipboard
            ->copy()
            // Disable/enable input
            ->lock()
            // Expansion
            ->expansion('kg')
            // Switch type password/text
            ->eye()
    ];
}

//...
</x-code>
</x-page>
