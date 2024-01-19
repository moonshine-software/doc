<x-page
    title="Date range"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#with-time', 'label' => 'Date and time'],
            ['url' => '#format', 'label' => 'Format'],
            ['url' => '#attributes', 'label' => 'Attributes'],
            ['url' => '#filter', 'label' => 'Filter'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>DateRange</em> field includes all the basic methods and allows you to select a date range.
</x-p>

<x-p>
    Since the date range has two values, you need to specify them using the <code>fromTo()</code> method.
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

<x-sub-title id="with-time">Date and time</x-sub-title>

<x-p>
    Using the <code>withTime()</code> method allows you to enter date and time into fields.
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

<x-sub-title id="format">Format</x-sub-title>

<x-p>
    The <code>format()</code> method allows you to change the display format of field values in preview.
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

<x-sub-title id="attributes">Attributes</x-sub-title>

<x-p>
    Does the <em>DateRange</em> field have attributes? which can be set through the appropriate methods.
</x-p>

<x-p>
    Methods <code>min()</code> and <code>max()</code>
    are used to set the minimum and maximum date values.
</x-p>


<x-code language="php">
min(string $min)
</x-code>

<x-code language="php">
max(string $max)
</x-code>

<x-p>
    The <code>step()</code> method is used to set the date step for a field.
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

@include('pages.en.fields.shared.filter_range', ['field' => 'DateRange'])

</x-page>
