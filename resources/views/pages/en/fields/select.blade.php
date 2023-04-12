<x-page title="Select field">

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

<x-p>
    If you need to save NULL, then you need to add a method <code>nullable</code>
</x-p>

<x-code language="php">
    Select::make('Country', 'country_id')
    ->nullable() // [tl! focus]
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_nullable.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_nullable_dark.png') }}"></x-image>

<x-p>
    To select multiple values, you need the method <code>multiple</code>
</x-p>

<x-code language="php">
Select::make('Country', 'country_id')
    ->multiple() // [tl! focus]
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_multiple.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_multiple_dark.png') }}"></x-image>

<x-p>
    If you want to add a search among values, you need to add the method <code>searchable</code>
</x-p>

<x-code language="php">
    Select::make('Country', 'country_id')
    ->searchable() // [tl! focus]
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_searchable.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_searchable_dark.png') }}"></x-image>

</x-page>
