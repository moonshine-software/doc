<x-page title="BelongsTo" :sectionMenu="[
    'Sections' => [
        ['url' => '#searchable', 'label' => 'Searching values'],
		['url' => '#async-search', 'label' => 'Async search'],
        ['url' => '#values-query', 'label' => 'Values query'],
        ['url' => '#nullable', 'label' => 'Empty value'],
    ]
]">

<x-extendby :href="route('moonshine.custom_page', 'fields-select')">
    Select
</x-extendby>

<x-p>Field for relationships in Laravel, belongsTo type</x-p>

<x-p>Displayed as select, you can also add a value search using this method:
<code>searchable</code></x-p>

<x-code language="php">
use MoonShine\Fields\BelongsTo;

//...
public function fields(): array
{
    return [
        // indicating the relationship
        BelongsTo::make('Country', 'country', 'name')
        // or you can field
        BelongsTo::make('Country', 'country_id', 'name')
    ];
}
//...
</x-code>

<x-p>The third argument with the "name" value is a field in the linked "countries" table to display the values</x-p>

<x-sub-title id="searchable">Searching values</x-sub-title>

<x-p>You can also pass a resource with a field to display as a third parameter</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsTo;
use App\MoonShine\Resources\CountryResource;

//...
public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country', new CountryResource())
            ->searchable()
    ];
}
//...
</x-code>

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\Resource;
use App\Models\Country;

class CountryResource extends Resource
{
//...

public string $titleField = 'name'; // [tl! focus]

//...
}
</x-code>

@include('pages.en.fields.shared.async_search', ['field' => 'BelongsTo'])

<x-image theme="light" src="{{ asset('screenshots/belongs_to.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_dark.png') }}"></x-image>

<x-p>If you need a more complex value to display, you can pass a function to the third argument</x-p>
<x-code language="php">
use MoonShine\Fields\BelongsTo;

//...
public function fields(): array
{
return [
    BelongsTo::make('Country', 'country', fn($item) => "$item->id.) $item->name")
];
}
//...
</x-code>

@include('pages.en.fields.shared.values_query', ['field' => 'BelongsTo'])

<x-sub-title id="nullable">Empty value</x-sub-title>
<x-p>If you need the default value Null</x-p>
<x-code language="php">
use MoonShine\Fields\BelongsTo;

//...
public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country')
            ->nullable()
    ];
}
//...
</x-code>

<x-p>Don't forget to specify that the field can be Null at the table level in the database as well</x-p>

</x-page>
