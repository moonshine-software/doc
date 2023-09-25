<x-page
    title="Диапазон"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#attributes', 'label' => 'Аттрибуты'],
            ['url' => '#dates', 'label' => 'Диапазон дат'],
        ]
    ]"
>

<x-extendby :href="route('moonshine.custom_page', 'fields-number')">
    Number
</x-extendby>

<x-p>
    Поле <em>RangeField</em> является расширением <em>Number</em>,
    позволяет задавать значения для двух логически связанных полей.
</x-p>

<x-p>
    Так как диапазон имеет два значения, то необходимо указать их с помощью метода <code>fromTo()</code>.
</x-p>

<x-code language="php">
fromTo(string $fromField, string $toField)
</x-code>

<x-code language="php">
use MoonShine\Fields\RangeField; // [tl! focus]

//...

public function fields(): array
{
    return [
        RangeField::make('Age') // [tl! focus]
            ->fromTo('age_from', 'age_to') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/range.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/range_dark.png') }}"></x-image>

<x-sub-title id="attributes">Аттрибуты</x-sub-title>

<x-p>
    Если требуется добавить кастомные аттрибуты для полей, то можно воспользоваться соответствующими методами
    <code>fromAttributes()</code> и <code>toAttributes()</code>.
</x-p>

<x-code language="php">
fromAttributes(array $attributes)
</x-code>

<x-code language="php">
toAttributes(array $attributes)
</x-code>

<x-code language="php">
use MoonShine\Fields\RangeField;

//...

public function fields(): array
{
    return [
        RangeField::make('Age')
            ->fromTo('age_from', 'age_to')
            ->fromAttributes(['placeholder'=> 'from']) // [tl! focus]
            ->toAttributes(['placeholder'=> 'to']) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="attributes">Диапазон дат</x-sub-title>

<x-p>
    Для выбора диапазон дат необходимо воспользоваться методом <code>dates()</code>
</x-p>

<x-code language="php">
dates()
</x-code>

<x-code language="php">
use MoonShine\Fields\RangeField;

//...

public function fields(): array
{
    return [
        RangeField::make('Dates')
            ->fromTo('age_from', 'age_to')
            ->dates() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/range-date.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/range-date_dark.png') }}"></x-image>

</x-page>
