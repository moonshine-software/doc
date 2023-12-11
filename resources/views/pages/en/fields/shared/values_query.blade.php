<x-sub-title id="values-query">Query for values</x-sub-title>

<x-p>
    The <code>valuesQuery()</code> method allows you to change the query for obtaining values.
</x-p>

<x-code language="php">
valuesQuery(Closure $callback)
</x-code>

<x-code language="php">
use Illuminate\Contracts\Database\Eloquent\Builder; // [tl! focus]
use MoonShine\Fields\Relationships\{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $field === 'BelongsToMany' ? 'Categories' : 'Category' }}', '{{ $field === 'BelongsToMany' ? 'categories' : 'category' }}', resource: new CategoryResource())
            ->valuesQuery(fn(Builder $query, Field $field) => $query->where('active', true)) // [tl! focus]
    ];
}

//...
</x-code>
