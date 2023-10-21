<x-sub-title id="values-query">Запрос для значений</x-sub-title>

<x-p>
    Методом <code>valuesQuery()</code> позволяет изменить запрос на получение значений.
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
        {{ $field }}::make({!! $field === 'BelongsToMany' ? 'Categories' : 'Category' !!}, resource: new CategoryResource())
            ->valuesQuery(fn(Builder $query) => $query->where('active', true)) // [tl! focus]
    ];
}

//...
</x-code>
