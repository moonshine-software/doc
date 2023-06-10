<x-sub-title id="async-search">Async search</x-sub-title>

<x-p>
    Async search for values is provided by the <code>asyncSearch()</code> method.
</x-p>

<x-p>
    The <code>asyncSearchQuery()</code> parameter is used to filter values,
    and <code>asyncSearchValueCallback()</code> to customize the output
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
    When building a request for <code>asyncSearchQuery()</code>, you can use <code>Request</code>,
    to do this, you need to pass it to the callback function
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
