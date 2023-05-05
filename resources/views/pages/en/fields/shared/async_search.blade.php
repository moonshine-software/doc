<x-sub-title id="async-search">Async search</x-sub-title>

<x-p>Search for values is provided by the <code>asyncSearch</code> method</x-p>

<x-p>The <code>asyncSearchQuery</code> parameter is used to filter values,
    and <code>asyncSearchValueCallback</code> to customize the output</x-p>

<x-code language="php">
use MoonShine\Fields\{{ $field }};

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
        ){!!$field === 'BelongsToMany' ? "->fields([Text::make('Contact', 'text')])" : ""!!}
    ];
}
//...
</x-code>
