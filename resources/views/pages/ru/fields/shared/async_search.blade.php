<x-sub-title id="async-search">Асинхронный поиск</x-sub-title>

<x-p>
    Для реализации асинхронного поиска значений воспользуйтесь методом <code>asyncSearch()</code>.
</x-p>

<x-code language="php">
asyncSearch(
    string $asyncSearchColumn = null,
    int $asyncSearchCount = 15,
    ?Closure $asyncSearchQuery = null,
    ?Closure $asyncSearchValueCallback = null,
    ?string $associatedWith = null,
    ?string $url = null,
)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $field === 'BelongsToMany' ? 'Countries' : 'Country' }}', '{{ $field === 'BelongsToMany' ? 'countries' : 'country' }}', resource: new CountryResource())
            ->asyncSearch() // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Поиск будет осуществляться по полю отношения ресурса <code>column</code>. По умолчанию <code>column=id</code>.
</x-moonshine::alert>

<x-p>
    В метод <code>asyncSearch()</code> можно передавать параметры:
</x-p>

<x-ul>
    <li><code>$asyncSearchColumn</code> - поле по которому происходит поиск;</li>
    <li><code>$asyncSearchCount</code> - количество элементов в выдаче;</li>
    <li><code>$asyncSearchQuery</code> - callback-функция для фильтрации значений;</li>
    <li><code>$asyncSearchValueCallback</code> - callback-функция для кастомизации вывода;</li>
    <li><code>$associatedWith</code> - поле с которым необходимо установить связь;</li>
    <li><code>$url</code> - url для обработки асинхронного запроса.</li>
</x-ul>

<x-code language="php">
use Illuminate\Contracts\Database\Eloquent\Builder; // [tl! focus]
use MoonShine\Fields\Relationships\{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $field === 'BelongsToMany' ? 'Countries' : 'Country' }}', '{{ $field === 'BelongsToMany' ? 'countries' : 'country' }}', resource: new CountryResource())
            ->asyncSearch(
                'title',
                10,
                asyncSearchQuery: function (Builder $query, Request $request, Field $field) {
                    return $query->where('id', '!=', 2);
                },
                asyncSearchValueCallback: function ($country, Field $field) {
                    return $country->id . ' | ' . $country->title;
                },
                '{{ route('async') }}'
            ) // [tl! focus:-10]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    При построении запроса в <code>asyncSearchQuery()</code> можно использовать текущие значения формы.
    Для этого необходимо передать <code>Request</code> в callback-функции.
</x-moonshine::alert>

<x-code language="php">
use Illuminate\Contracts\Database\Eloquent\Builder; // [tl! focus]
use Illuminate\Http\Request; // [tl! focus]
use MoonShine\Fields\Relationships\{{ $field }};
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id'), // [tl! focus]
        {{ $field }}::make('{{ $field === 'BelongsToMany' ? 'Cities' : 'City' }}', '{{ $field === 'BelongsToMany' ? 'cities' : 'city' }}',  resource: new CityResource())
            ->asyncSearch(
                'title',
                asyncSearchQuery: function (Builder $query, Request $request, Field $field): Builder {
                    return $query->where('country_id', $request->get('country_id'));
                } // [tl! focus:-2]
            )
    ];
}

//...
</x-code>
