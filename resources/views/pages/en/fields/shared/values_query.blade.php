<x-sub-title id="values-query">Values query</x-sub-title>

To filter values, use the <code>valuesQuery</code> method

<x-code language="php">
use Illuminate\Contracts\Database\Eloquent\Builder; // [tl! focus]
use MoonShine\Fields\{{ $field }};

//...
public function fields(): array
{
    return [
        {{ $field }}::make('Categories', 'categories', 'name')
            ->valuesQuery(fn(Builder $query) => $query->where('active', true)) // [tl! focus]
    ];
}
//...
</x-code>
