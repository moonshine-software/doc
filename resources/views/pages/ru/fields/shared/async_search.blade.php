<x-sub-title id="async-search">Асинхронный поиск</x-sub-title>

<x-p>Для реализации поиска значений, воспользуйтесь методом <code>asyncSearch</code></x-p>

<x-p>Параметр <code>asyncSearchQuery</code> используется для фильтрации значений,
    а <code>asyncSearchValueCallback</code> для кастомизации вывода</x-p>

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
