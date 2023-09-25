<x-page title="Диапазон слайдер">

<x-extendby :href="route('moonshine.custom_page', 'fields-range')">
    RangeField
</x-extendby>

<x-p>
    <x-p>
        Поле <em>SlideField</em> является расширением <em>RangeField</em> и
        дополнительно имеет возможность изменять значения с помощью ползунка.
    </x-p>
</x-p>

<x-code language="php">
use MoonShine\Fields\SlideField; // [tl! focus]

//...

public function fields(): array
{
    return [
        SlideField::make('Age') // [tl! focus]
            ->fromTo('age_from', 'age_to') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/slide.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/slide_dark.png') }}"></x-image>

</x-page>
