<x-page
    title="Range"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#attributes', 'label' => 'Attributes'],
            ['url' => '#filter', 'label' => 'Filter'],
        ]
    ]"
>

<x-extendby :href="route('moonshine.page', 'fields-number')">
    Number
</x-extendby>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Range</em> field is an extension of <em>Number</em>,
    allows you to set values for two logically related fields.
</x-p>

<x-p>
    Since the range has two values, you need to specify them using the <code>fromTo()</code> method.
</x-p>

<x-code language="php">
fromTo(string $fromField, string $toField)
</x-code>

<x-code language="php">
use MoonShine\Fields\Range; // [tl! focus]

//...

public function fields(): array
{
    return [
        Range::make('Age') // [tl! focus]
            ->fromTo('age_from', 'age_to') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/range.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/range_dark.png') }}"></x-image>

<x-sub-title id="attributes">Attributes</x-sub-title>

<x-p>
    If you need to add custom attributes for fields, you can use the appropriate methods
    <code>fromAttributes()</code> and <code>toAttributes()</code>.
</x-p>

<x-code language="php">
fromAttributes(array $attributes)
</x-code>

<x-code language="php">
toAttributes(array $attributes)
</x-code>

<x-code language="php">
use MoonShine\Fields\Range;

//...

public function fields(): array
{
    return [
        Range::make('Age')
            ->fromTo('age_from', 'age_to')
            ->fromAttributes(['placeholder'=> 'from']) // [tl! focus]
            ->toAttributes(['placeholder'=> 'to']) // [tl! focus]
    ];
}

//...
</x-code>

@include('pages.en.fields.shared.filter_range', ['field' => 'Range'])

</x-page>
