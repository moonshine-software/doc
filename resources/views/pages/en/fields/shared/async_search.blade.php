<x-sub-title id="async-search">Async search</x-sub-title>

<x-p>
    Async search for values is provided by the <code>asyncSearch()</code> method.
</x-p>

<x-code language="php">
use MoonShine\Fields\{{ $field }}; // [tl! focus]

//...
public function fields(): array
{
    return [
        {{ $field }}::make('Contacts') // [tl! focus]
            ->asyncSearch(){!!$field === 'BelongsToMany' ? "->fields([Text::make('Contact', 'text')])" : ""!!} // [tl! focus]
    ];
}
//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    The search will be performed on the resource relation field <code>titleField</code>. The default is <code>titleField=id</code>.
</x-moonshine::alert>

<x-p>
    You can pass parameters to the <code>asyncSearch()</code> method:
</x-p>

<x-p>
    <ul>
        <li><code>title</code> - search field</li>
        <li><code>count</code> - amount of items in output</li>
        <li><code>asyncSearchQuery()</code> - callback function for filtering values</li>
        <li><code>asyncSearchValueCallback()</code> - callback function for output customization.</li>
    </ul>
</x-p>

<x-code language="php">
use Illuminate\Contracts\Database\Eloquent\Builder; // [tl! focus]
use MoonShine\Fields\{{ $field }}; // [tl! focus]

//...
public function fields(): array
{
    return [
        {{ $field }}::make('Contacts')->asyncSearch(
            'title',
            10,
            asyncSearchQuery: function (Builder $query) {
                return $query->where('id', '!=', 2);
            },
            asyncSearchValueCallback: function ($contact) {
                return $contact->id . ' | ' . $contact->title;
            }
        ){!!$field === 'BelongsToMany' ? "->fields([Text::make('Contact', 'text')])" : ""!!} // [tl! focus:-9]
    ];
}
//...
</x-code>

<x-p>
    When building a query in <code>asyncSearchQuery()</code>, you can use the current form values.
    To do this, you need to pass <code>Request</code> to the callback functions.
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
