<x-sub-title id="values-query">Query for values</x-sub-title>

To filter values, use the <code>valuesQuery</code> method

<x-code language="php">
use MoonShine\Fields\{{ $field }};
use Illuminate\Database\Eloquent\Builder;

//...
public function fields(): array
{
    return [
        {{ $field }}::make('Categories', 'categories', 'name')
            ->valuesQuery(fn(Builder $query) => $query->where('active', true))
    ];
}
//...
</x-code>
