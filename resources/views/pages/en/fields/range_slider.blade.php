<x-page
    title="Range slider"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#filter', 'label' => 'Filter'],
        ]
    ]"
>

<x-extendby :href="to_page('fields-range')">
    Range
</x-extendby>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    <x-p>
        The <em>RangeSlider</em> field is an extension of <em>Range</em> and
        additionally has the ability to change values using a slider.
    </x-p>
</x-p>

<x-code language="php">
use MoonShine\Fields\RangeSlider; // [tl! focus]

//...

public function fields(): array
{
    return [
        RangeSlider::make('Age') // [tl! focus]
            ->fromTo('age_from', 'age_to') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/slide.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/slide_dark.png') }}"></x-image>

@include('pages.en.fields.shared.filter_range', ['field' => 'RangeSlider'])

</x-page>
