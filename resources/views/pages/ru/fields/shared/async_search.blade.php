<x-sub-title id="async-search">Асинхронный поиск</x-sub-title>

<x-p>
    Для реализации асинхронного поиска значений воспользуйтесь методом <code>asyncSearch()</code>.
</x-p>

<x-p>
    Параметр <code>asyncSearchQuery()</code> используется для фильтрации значений,
    а <code>asyncSearchValueCallback()</code> для кастомизации вывода.
</x-p>

<x-code language="php">
use Illuminate\Contracts\Database\Eloquent\Builder; // [tl! focus]
use MoonShine\Fields\{{ $field }}; // [tl! focus]

//...
public function fields(): array
{
    return [
        {{ $field }}::make('Contacts')->asyncSearch(
            'title', // search column
            asyncSearchQuery: function (Builder $query) {
                return $query->where('id', '!=', 2);
            },
            asyncSearchValueCallback: function ($contact) {
                return $contact->id . ' | ' . $contact->title;
            }
        ){!!$field === 'BelongsToMany' ? "->fields([Text::make('Contact', 'text')])" : ""!!} // [tl! focus:-8]
    ];
}
//...
</x-code>

<x-p>
    При построении запроса для <code>asyncSearchQuery()</code> можно использовать <code>Request</code>,
    для этого необходимо передать его в callback-функции
</x-p>

<x-code language="php">
use Illuminate\Contracts\Database\Eloquent\Builder; // [tl! focus]
use Illuminate\Http\Request; // [tl! focus]
use MoonShine\Fields\{{ $field }};
use MoonShine\Fields\Select;

//...
public function fields(): array
{
    return [
        Select::make('Country', 'country_id'), // [tl! focus]
        {{ $field }}::make('City')->asyncSearch(
            'title',
            asyncSearchQuery: function (Builder $query, Request $request): Builder {
                return $query->where('country_id', $request->get('country_id'));
            } // [tl! focus:-2]
        )
    ];
}
//...
</x-code>
