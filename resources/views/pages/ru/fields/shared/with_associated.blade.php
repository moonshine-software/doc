<x-sub-title id="associated">Связанные поля</x-sub-title>

<x-p>
    Для связывания значений селектов между полями можно воспользоваться методом <code>associatedWith()</code>.
</x-p>

<x-code language="php">
associatedWith(string $column, ?Closure $asyncSearchQuery = null)
</x-code>

<x-p>
    <ul>
        <li><code>$column</code> - поле с которым устанавливается связь;</li>
        <li><code>$asyncSearchQuery</code> - callback-функция для фильтрации значений.</li>
    </ul>
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\{{ $field }};

//...

public function fields(): array
{
    return [
        {{ $field }}::make('{{ $field === 'BelongsToMany' ? 'Cities' : 'City' }}', '{{ $field === 'BelongsToMany' ? 'cities' : 'city' }}', resource: new CityResource())
            ->associatedWith('country_id') // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Для более сложной настройки можно использовать <code>asyncSearch()</code>.
</x-moonshine::alert>
