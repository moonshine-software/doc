<x-page title="Select field" :sectionMenu="[
    'Sections' => [
        ['url' => '#nullable', 'label' => 'Nullable'],
        ['url' => '#groups', 'label' => 'Groups'],
        ['url' => '#multiple', 'label' => 'Multiple select'],
        ['url' => '#searchable', 'label' => 'Search'],
    ]
]">

<x-p>
    The text field includes all the basic methods and additional methods for select fields
</x-p>

<x-code language="php">
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 2',
                'value 2' => 'Option Label 2'
            ])
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_dark.png') }}"></x-image>

<x-sub-title id="nullable">Nullable</x-sub-title>

<x-p>
    If you need to save NULL, then you need to add a <code>nullable</code> method
</x-p>

<x-code language="php">
    Select::make('Country', 'country_id')
    ->nullable() // [tl! focus]
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_nullable.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_nullable_dark.png') }}"></x-image>

<x-sub-title id="groups">Groups</x-sub-title>

<x-p>
    You can combine values into groups
</x-p>

<x-code language="php">
Select::make('City')->options([
    'Italy' => [
        1 => 'Rome',
        2 => 'Milan'
    ],
    'France' => [
        3 => 'Paris',
        4 => 'Marseille'
    ],
]),
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_group.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_group_dark.png') }}"></x-image>

<x-sub-title id="multiple">Multiple select</x-sub-title>

<x-p>
    To select multiple values, you need the <code>multiple</code> method
</x-p>

<x-code language="php">
Select::make('Country', 'country_id')
    ->multiple() // [tl! focus]
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    The field in the database must be of the text or json type.<br>
    You also need to add a cast for the eloquent model - json or array or collection.
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/select_multiple.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_multiple_dark.png') }}"></x-image>

<x-sub-title id="searchable">Search</x-sub-title>

<x-p>
    If you want to add a search among values, you need to add the <code>searchable</code> method
</x-p>

<x-code language="php">
    Select::make('Country', 'country_id')
    ->searchable() // [tl! focus]
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_searchable.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_searchable_dark.png') }}"></x-image>

</x-page>
