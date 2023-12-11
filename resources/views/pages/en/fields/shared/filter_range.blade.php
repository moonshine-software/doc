<x-sub-title id="filter">Filter</x-sub-title>

<x-p>
    When using the <em>{{ $field }}</em> field to build a filter, the <code>fromTo()</code> method is not used,
    since filtering occurs by one field in the database table.
</x-p>

<x-code language="php">
use MoonShine\Fields\{{ $field }}; // [tl! focus]

//...

public function filters(): array
{
    return [
        {{ $field }}::make('{{ $field === 'DateRange' ? 'Dates' : 'Age'}}',  '{{ $field === 'DateRange' ? 'dates' : 'age'}}') // [tl! focus]
    ];
}

//...
</x-code>
