<x-page title="BelongsTo" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#searchable', 'label' => 'Searching values'],
		['url' => '#async-search', 'label' => 'Async search'],
        ['url' => '#values-query', 'label' => 'Values query'],
        ['url' => '#nullable', 'label' => 'Empty value'],
    ]
]">

<x-extendby :href="route('moonshine.page', 'fields-select')">
    Select
</x-extendby>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>Field for relationships in Laravel, <code>BelongsTo</code> type. Displayed as select.</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsTo; // [tl! focus]

//...
public function fields(): array
{
    return [
        // indicating the relationship
        BelongsTo::make('Country', 'country', 'name') // [tl! focus]
        // or you can field
        BelongsTo::make('Country', 'country_id', 'name') // [tl! focus]
    ];
}
//...
</x-code>

<x-p>The third argument with the "name" value is a field in the linked "countries" table to display the values.</x-p>

<x-image theme="light" src="{{ asset('screenshots/belongs_to.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_dark.png') }}"></x-image>

<x-p>You can also pass a resource with a field to display as a third parameter</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsTo;
use App\MoonShine\Resources\CountryResource;  // [tl! focus]

//...
public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country', new CountryResource()) // [tl! focus]
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

<x-p>If you need a more complex value to display, you can pass a function to the third argument</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsTo;

//...
public function fields(): array
{
    return [
        BelongsTo::make(
            'Country',
            'country',
            fn($item) => "$item->id.) $item->name" // [tl! focus]
        )
    ];
}
//...
</x-code>

<x-sub-title id="searchable">Searching values</x-sub-title>

<x-p>
    If you need to search among values, then you need to add the <code>searchable()</code> method.
</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsTo;
use App\MoonShine\Resources\CountryResource;

//...
public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country', new CountryResource())
            ->searchable() // [tl! focus]
    ];
}
//...
</x-code>

@include('pages.en.fields.shared.async_search', ['field' => 'BelongsTo'])

@include('pages.en.fields.shared.values_query', ['field' => 'BelongsTo'])

<x-sub-title id="nullable">Empty value</x-sub-title>

<x-p>
    If you need the default value <code>Null</code>
</x-p>

<x-code language="php">
use MoonShine\Fields\BelongsTo;

//...
public function fields(): array
{
    return [
        BelongsTo::make('Country', 'country')
            ->nullable() // [tl! focus]
    ];
}
//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Don't forget to specify in the database table that the field can be <code>Null</code>.
</x-moonshine::alert>

</x-page>
