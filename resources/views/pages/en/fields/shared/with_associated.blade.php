<x-sub-title id="associated">Related fields</x-sub-title>

<x-p>
    To associate select values between fields, you can use the <code>associatedWith()</code> method.
</x-p>

<x-code language="php">
associatedWith(string $column, ?Closure $asyncSearchQuery = null)
</x-code>

<x-p>
    <ul>
        <li><code>$column</code> - the field with which the connection is established;</li>
        <li><code>$asyncSearchQuery</code> - callback function for filtering values.</li>
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
    For more complex setup, you can use <code>asyncSearch()</code>.
</x-moonshine::alert>
