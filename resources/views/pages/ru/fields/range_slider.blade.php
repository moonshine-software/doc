<x-page
    title="Диапазон слайдер"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#filter', 'label' => 'Фильтр'],
        ]
    ]"
>

<x-extendby :href="to_page('fields-range')">
    Range
</x-extendby>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    <x-p>
        Поле <em>RangeSlider</em> является расширением <em>Range</em> и
        дополнительно имеет возможность изменять значения с помощью ползунка.
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

@include('pages.ru.fields.shared.filter_range', ['field' => 'RangeSlider'])

</x-page>
