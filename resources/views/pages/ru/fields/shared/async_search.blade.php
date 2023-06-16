<x-sub-title id="async-search">Асинхронный поиск</x-sub-title>

<x-p>
    Для реализации асинхронного поиска значений воспользуйтесь методом <code>asyncSearch()</code>.
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
    Поиск будет осуществляться по полю отношения ресурса <code>titleField</code>. По умолчанию <code>titleField=id</code>.
</x-moonshine::alert>

<x-p>
    В метод <code>asyncSearch()</code> можно передавать параметры:
</x-p>

<x-p>
    <ul>
        <li><code>title</code> - поле по которому происходит поиск</li>
        <li><code>count</code> - количество элементов в выдаче</li>
        <li><code>asyncSearchQuery()</code> - callback-функция для фильтрации значений</li>
        <li><code>asyncSearchValueCallback()</code> - callback-функция для кастомизации вывода.</li>
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
    При построении запроса в <code>asyncSearchQuery()</code> можно использовать текущие значения формы.
    Для этого необходимо передать <code>Request</code> в callback-функции.
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

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Отношения, которые применяют в своих полях асинхронный поиск, рекомендуется использовать в режиме <code>ResourceMode</code>.
</x-moonshine::alert>
