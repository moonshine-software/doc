<x-sub-title id="filter">Filter</x-sub-title>

<x-p>
    While using the <em>{{ $field }}</em> field to construct a filter, method <code>fromTo()</code> is not used,
    because filtering occurs on one field in the database table.
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
