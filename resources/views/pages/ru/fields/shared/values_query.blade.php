<x-sub-title id="values-query">Запрос для значений</x-sub-title>

<x-p>Для фильтрации значений, воспользуйтесь методом <code>valuesQuery</code></x-p>

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
