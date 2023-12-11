<x-page title="BelongsTo" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#default', 'label' => 'Default value'],
        ['url' => '#nullable', 'label' => 'Nullable'],
        ['url' => '#placeholder', 'label' => 'Placeholder'],
        ['url' => '#searchable', 'label' => 'Finding values'],
        ['url' => '#values-query', 'label' => 'Query for values'],
		['url' => '#async-search', 'label' => 'Asynchronous search'],
		['url' => '#associated', 'label' => 'Related fields'],
		['url' => '#with-image', 'label' => 'Values with picture'],
        ['url' => '#options', 'label' => 'Options'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

@include('pages.ru.fields.shared.relation_make', ['field' => 'BelongsTo', 'label' => 'Country'])


<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    When using the <em>BelongsTo</em> field to sort or filter positions, you must use the method
    <code>setColumn()</code> set a field in a database table or override a method
    <x-link :link="route('moonshine.page', 'resources-query') . '#order'" >
         sorting
    </x-link> at the model resource.
</x-moonshine::alert>

<x-sub-title id="default">Default value</x-sub-title>

<x-p>
    You can use the <code>default()</code> method if you need to specify a default value for a field.
</x-p>

<x-code language="php">
default(mixed $default)
</x-code>

<x-p>
    You must pass a model object as the default value.
</x-p>

<x-code language="php">
use App\Models\Country;
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', resource: new CountryResource())
            ->default(Country::find(1)) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="nullable">Nullable</x-sub-title>

<x-p>
    Like all fields, if you need to store NULL, you need to add the <code>nullable()</code> method
</x-p>

<x-code language="php">
nullable(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsTo;

//...

public function fields(): array
{
    return [
        BelongsTo::make('Country', resource: new CountryResource())
            ->nullable() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_nullable.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_nullable_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Don't forget to indicate in the database table that the field can take the value <code>Null</code>.
</x-moonshine::alert>

@include('pages.ru.fields.shared.placeholder', ['field' => 'BelongsTo'])

<x-sub-title id="searchable">Finding values</x-sub-title>

<x-p>
    If you need to search among values, you need to add the <code>searchable()</code> method.
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

@include('pages.ru.fields.shared.values_query', ['field' => 'BelongsTo'])

@include('pages.ru.fields.shared.async_search', ['field' => 'BelongsTo'])

@include('pages.ru.fields.shared.with_associated', ['field' => 'BelongsTo'])

@include('pages.ru.fields.shared.with_image', ['field' => 'BelongsTo'])

@include('pages.ru.fields.shared.choices_options', ['field' => 'BelongsTo'])

</x-page>
