<x-page title="NoInput" :sectionMenu="[
    'Sections' => [
        ['url' => '#basic', 'label' => 'Basic application'],
        ['url' => '#badge', 'label' => 'Badge'],
        ['url' => '#boolean', 'label' => 'Boolean'],
        ['url' => '#link', 'label' => 'Link'],
    ]
]">

<x-p>
    <b>The field is not for data input/amendment!</b>
</x-p>

<x-sub-title id="basic">Basic application</x-sub-title>

<x-p>
    With this default field, you can display text data from any field in the model,
    or generate text based on the model.
</x-p>

<x-code language="php">
//...
use MoonShine\Fields\NoInput;

public function fields(): array
{
    return [
        NoInput::make('No input field', 'no_input', static fn() => fake()->realText()),
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/no-input.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/no-input_dark.png') }}"></x-image>

<x-sub-title id="badge">Badge</x-sub-title>

<x-p>
    Displays a label, could be used for order status, as an example!
    We use the badge method with a color parameter,
    which can be either a string or a closure with the current element in the parameter
</x-p>

<x-code language="php">
//...
use MoonShine\Fields\NoInput;

public function fields(): array
{
    return [
        NoInput::make('Status')->badge(fn($item) => $item->status_id === 1 ? 'green' : 'gray'),
    ];
}

//...
</x-code>

<x-sub-title id="boolean">Boolean</x-sub-title>

<x-p>
    Display a label (green or red) for boolean values.
    Using the hideTrue and hideFalse options you can hide the label for values input
</x-p>

<x-code language="php">
//...
use MoonShine\Fields\NoInput;

public function fields(): array
{
    return [
        NoInput::make('Active')->boolean(hideTrue: false, hideFalse: false),
    ];
}

//...
</x-code>

<x-sub-title id="link">Link</x-sub-title>

<x-p>
    Displays a link.
    We can show the value and specify the link using the parameter (string or closure with the current element)
</x-p>

<x-code language="php">
//...
use MoonShine\Fields\NoInput;

public function fields(): array
{
    return [
        NoInput::make('Link')->link('https://cutcode.dev', blank: false),
        NoInput::make('Link')->link(fn($item) => $item->link, blank: true),
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/no-input_all.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/no-input_all_dark.png') }}"></x-image>

</x-page>
