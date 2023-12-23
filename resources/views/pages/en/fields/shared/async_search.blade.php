<x-sub-title id="async-search">Asynchronous search</x-sub-title>

<x-p>
    To implement asynchronous search for values, use the <code>asyncSearch()</code> method.
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
    The search will be carried out using the resource relationship field <code>column</code>. By default <code>column=id</code>.
</x-moonshine::alert>

<x-p>
    You can pass parameters to the <code>asyncSearch()</code> method:
</x-p>

<x-ul>
    <li><code>$asyncSearchColumn</code> - the field in which the search takes place;</li>
    <li><code>$asyncSearchCount</code> - number of elements in the search results;</li>
    <li><code>$asyncSearchQuery</code> - callback-function for filtering values;</li>
    <li><code>$asyncSearchValueCallback</code> - callback-function for customizing output;</li>
    <li><code>$associatedWith</code> - the field with which to establish a connection;</li>
    <li><code>$url</code> - url to process the asynchronous request.</li>
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
                asyncSearchQuery: function (Builder $query, Field $field) {
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
    When building a query in <code>asyncSearchQuery()</code>, you can use the current form values.
    To do this, you need to pass <code>Request</code> to the callback function.
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
