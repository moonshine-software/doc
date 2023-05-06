<x-page title="HasOne">

<x-extendby :href="route('moonshine.custom_page', 'fields-has_many')">
    HasMany
</x-extendby>

<x-p>Field for relationships in Laravel, hasOne type</x-p>

<x-p>Creates a new record in the linked table and binds it to the current record</x-p>

<x-p>In case of relationship the record is edited</x-p>

<x-code language="php">
use MoonShine\Fields\HasOne;

//...
public function fields(): array
{
    return [
        HasOne::make('City', 'city', 'name')
            ->fields([
                ID::make(),
                Text::make('Value', 'name'),
            ])
    ];
}
//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    ID in the fields method is required
</x-moonshine::alert>

<x-p>
    It often happens that there are a lot of fields for relations and they look small in the table, and this is inconvenient.
    In many cases, you have to move this relation to a separate resource, however if you must leave it within the current resource,
    but display the fields completely, you can use
    the <code>fullPage()</code> method, and the fields will get a standard shape
</x-p>

<x-image theme="light" src="{{ asset('screenshots/has_one_1.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_one_1_dark.png') }}"></x-image>

<x-image theme="light" src="{{ asset('screenshots/has_one_2.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_one_2_dark.png') }}"></x-image>

<x-p>
    <code>resourceMode</code> is also available, details in the HasMany field
</x-p>

</x-page>
