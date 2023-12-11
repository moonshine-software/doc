<x-page
    title="Select"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#default', 'label' => 'Default value'],
            ['url' => '#nullable', 'label' => 'Nullable'],
            ['url' => '#placeholder', 'label' => 'Placeholder'],
            ['url' => '#groups', 'label' => 'Groups'],
            ['url' => '#multiple', 'label' => 'Multiple values'],
            ['url' => '#searchable', 'label' => 'Search'],
            ['url' => '#async', 'label' => 'Asynchronous search'],
            ['url' => '#update-on-preview', 'label' => 'Editing in preview'],
		    ['url' => '#with-image', 'label' => 'Values with picture'],
		    ['url' => '#options', 'label' => 'Options'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Select</em> field includes all the basic methods.
</x-p>

<x-code language="php">
use MoonShine\Fields\Select; // [tl! focus]

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ]) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_dark.png') }}"></x-image>

<x-sub-title id="default">Default value</x-sub-title>

<x-p>
    You can use the <code>default()</code> method if you need to specify a default value for a field.
</x-p>

<x-code language="php">
default(mixed $default)
</x-code>

<x-code language="php">
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->default('value 2') // [tl! focus]
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
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->nullable() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_nullable.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_nullable_dark.png') }}"></x-image>

@include('pages.ru.fields.shared.placeholder', ['field' => 'Select'])

<x-sub-title id="groups">Groups</x-sub-title>

<x-p>
    You can combine values into groups.
</x-p>

<x-code language="php">
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('City', 'city_id')
            ->options([
                'Italy' => [
                    1 => 'Rome',
                    2 => 'Milan'
                ],
                'France' => [
                    3 => 'Paris',
                    4 => 'Marseille'
                ]
            ]) // [tl! focus:-9]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_group.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_group_dark.png') }}"></x-image>

<x-sub-title id="multiple">Selecting Multiple Values</x-sub-title>

<x-p>
    To select multiple values, you need the <code>multiple()</code> method
</x-p>

<x-code language="php">
multiple(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->multiple() // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    When using <code>multiple()</code> for the <em>Eloquent</em> model, a field in the database type text or json is required.<br>
    You also need to add <em>cast</em> - json or array or collection.
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/select_multiple.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_multiple_dark.png') }}"></x-image>

<x-sub-title id="searchable">Search</x-sub-title>

<x-p>
    If you need to add a search among values, then you need to add the <code>searchable()</code> method
</x-p>

<x-code language="php">
searchable()
</x-code>

<x-code language="php">
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->searchable() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_searchable.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_searchable_dark.png') }}"></x-image>

<x-sub-title id="async">Asynchronous search</x-sub-title>

<x-p>
    You can also organize an asynchronous search for the <em>Select</em> field.
    To do this, you need to pass <em>url</em> to the <code>async()</code> method,
    to which a request with a <em>query</em> search parameter will be sent.
</x-p>

<x-code language="php">
async(?string $asyncUrl = null)
</x-code>

<x-p>
    The returned response with search results must be in <em>json</em> format.
</x-p>

<x-code language="json">
[
    {
        "value": 1,
        "label": "Option 1"
    },
    {
        "value": 2,
        "label": "Option 2"
    }
]
</x-code>

<x-code language="php">
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->searchable() // [tl! focus]
            ->async('/search') // [tl! focus]
    ];
}

//...
</x-code>

@include('pages.ru.fields.shared.update_on_preview', ['field' => 'Select'])

<x-sub-title id="with-image">Values with picture</x-sub-title>

<x-p>
    The <code>optionProperties()</code> method allows you to add an image to a value.
</x-p>

<x-code language="php">
optionProperties(Closure|array $data)
</x-code>

<x-code language="php">
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                1 => 'Andorra',
                2 => 'United Arab Emirates',
                //...
            ])->optionProperties(fn() => [
                1 => ['image' => '{{ config('app.url') }}/images/ad.png'],
                2 => ['image' => '{{ config('app.url') }}/images/ae.png'],
                //...
            ]) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to_image.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_image_dark.png') }}"></x-image>

@include('pages.ru.fields.shared.choices_options', ['field' => 'Select'])

</x-page>
