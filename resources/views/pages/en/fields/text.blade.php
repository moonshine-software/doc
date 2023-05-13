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

<x-image theme="light" src="{{ asset('screenshots/input.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/input_dark.png') }}"></x-image>

<x-sub-title id="mask">Mask</x-sub-title>

<x-p>
    Use the <code>mask</code> method if you want to add a mask to the field
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

<x-image theme="light" src="{{ asset('screenshots/mask.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/mask_dark.png') }}"></x-image>

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
            ->locked()
            // Expansion
            ->expansion('kg')
            // Switch type password/text
            ->eye()
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/expansion.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/expansion_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    The <code>copy</code> method uses the <code>Clipboard API</code> which is only available for HTTPS or localhost
</x-moonshine::alert>

</x-page>
