<x-sub-title id="filter">Фильтр</x-sub-title>

<x-p>
    При использовании поля <em>{{ $field }}</em> для построения фильтра метод <code>fromTo()</code> не используется,
    так как фильтрация происходит по одному полю в таблице базы данных.
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
