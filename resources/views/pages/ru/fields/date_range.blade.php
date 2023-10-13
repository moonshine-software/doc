<x-page
    title="Диапазон дат"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#with-time', 'label' => 'Дата и время'],
            ['url' => '#format', 'label' => 'Формат'],
            ['url' => '#attributes', 'label' => 'Аттрибуты'],
        ]
    ]"
>

<x-p>
    Поле <em>DateRange</em> включает в себя все базовые методы и позволяет выбрать диапазон дат.
</x-p>

<x-p>
    Так как диапазон дат имеет два значения, то необходимо указать их с помощью метода <code>fromTo()</code>.
</x-p>

<x-code language="php">
fromTo(string $fromField, string $toField)
</x-code>

<x-code language="php">
use MoonShine\Fields\DateRange; // [tl! focus]

//...

public function fields(): array
{
    return [
        DateRange::make('Dates') // [tl! focus]
            ->fromTo('date_from', 'date_to') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/date-range.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/date-range_dark.png') }}"></x-image>

<x-sub-title id="with-time">Дата и время</x-sub-title>

<x-p>
    Использование метода <code>withTime()</code> дает возможность вводить в поля дату и время.
</x-p>

<x-code language="php">
withTime()
</x-code>

<x-code language="php">
use MoonShine\Fields\DateRange;

//...

public function fields(): array
{
    return [
        DateRange::make('Dates')
            ->fromTo('date_from', 'date_to')
            ->withTime() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="format">Формат</x-sub-title>

<x-p>
    Метод <code>format()</code> позволяет изменить формат отображения значений полей в preview.
</x-p>

<x-code language="php">
format(string $format)
</x-code>

<x-code language="php">
use MoonShine\Fields\DateRange;

//...

public function fields(): array
{
    return [
        DateRange::make('Dates')
            ->fromTo('date_from', 'date_to')
            ->format('d.m.Y') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="attributes">Аттрибуты</x-sub-title>

<x-p>
    Поле <em>DateRange</em> имеет аттрибуты? которые можно задать через соответствующие методы.
</x-p>

<x-p>
    Методы <code>min()</code> и <code>max()</code>
    используются для задания минимального и максимального значения даты.
</x-p>


<x-code language="php">
min(string $min)
</x-code>

<x-code language="php">
max(string $max)
</x-code>

<x-p>
    Метод <code>step()</code> используются для задания шага даты у поля.
</x-p>

<x-code language="php">
step(int|float|string $step)
</x-code>

<x-code language="php">
use MoonShine\Fields\DateRange;

//...
public function fields(): array
{
    return [
        DateRange::make('Dates')
            ->fromTo('date_from', 'date_to')
            ->min('2023-01-01') // [tl! focus]
            ->max('2023-12-31') // [tl! focus]
            ->step(5) // [tl! focus]
    ];
}

//...
</x-code>

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
use MoonShine\Fields\DateRange;

//...

public function fields(): array
{
    return [
        DateRange::make('Dates')
            ->fromTo('date_from', 'date_to')
            ->fromAttributes(['placeholder'=> 'from']) // [tl! focus]
            ->toAttributes(['placeholder'=> 'to']) // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
