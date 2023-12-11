<x-page
    title="Number"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#attributes', 'label' => 'Attributes'],
            ['url' => '#stars', 'label' => 'Stars'],
            ['url' => '#buttons', 'label' => '+/- buttons'],
        ]
    ]"
>

<x-extendby :href="route('moonshine.page', 'fields-text')">
    Text
</x-extendby>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Number</em> field is an extension of <em>Text</em>,
    which by default sets <code>type=number</code> and has additional methods.
</x-p>

<x-code language="php">
use MoonShine\Fields\Number; // [tl! focus]

//...

public function fields(): array
{
    return [
        Number::make('Sort') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="attributes">Attributes</x-sub-title>

<x-p>
    The <em>Number</em> field has additional attributes (besides the standard attributes of the <em>Text</em> field),
    which can be set through the appropriate methods.
</x-p>

<x-p>
    Methods <code>min()</code> and <code>max()</code>
    are used to set the minimum and maximum values for a field.
</x-p>

<x-code language="php">
min(int|float $min)
</x-code>

<x-code language="php">
max(int|float $max)
</x-code>

<x-p>
    The <code>step()</code> method is used to set the value step for a field.
</x-p>

<x-code language="php">
step(int|float $step)
</x-code>

<x-code language="php">
use MoonShine\Fields\Number;

//...
public function fields(): array
{
    return [
        Number::make('Price')
            ->min(0) // [tl! focus]
            ->max(100000) // [tl! focus]
            ->step(5) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="stars">Stars</x-sub-title>

<x-p>
    The <code>stars()</code> method is used to display a numeric value
    when previewing in the form of stars (for example, for ratings).
</x-p>

<x-code language="php">
stars()
</x-code>

<x-code language="php">
use MoonShine\Fields\Number;

//...

public function fields(): array
{
    return [
        Number::make('Rating')
            ->stars() // [tl! focus]
            ->min(1)
            ->max(10)
    ];
}

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box>
            @include("examples/components/rating")
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="buttons">+/- buttons</x-sub-title>

<x-p>
    The <code>buttons()</code> method allows you to add buttons to a field to increase or decrease a value.
</x-p>

<x-code language="php">
buttons()
</x-code>

<x-code language="php">
use MoonShine\Fields\Number;

//...

public function fields(): array
{
    return [
        Number::make('Rating')
            ->buttons() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/number_buttons.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/number_buttons_dark.png') }}"></x-image>

</x-page>
