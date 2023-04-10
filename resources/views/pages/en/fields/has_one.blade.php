<x-page title="HasOne">

<x-extendby :href="route('moonshine.custom_page', 'fields-has_many')">
    HasMany
</x-extendby>

<x-p>The relationship field in laravel of type hasOne</x-p>

<x-p>Creates a new record in the linked table and binds it to the current record</x-p>

<x-p>If there is a connection, the record is edited</x-p>

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
    ID in fields is required
</x-moonshine::alert>

<x-p>
    It often happens that there are a lot of fields for communication and in the table they are displayed small and not convenient. In many cases it is necessary to remove such a link to a separate resource, but if you want to leave it within the current resource, but display fields fully, then use the method <code>fullPage()</code> and fields will take the standard form
</x-p>

<x-image theme="light" src="{{ asset('screenshots/has_one_1.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_one_1_dark.png') }}"></x-image>

<x-image theme="light" src="{{ asset('screenshots/has_one_2.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_one_2_dark.png') }}"></x-image>

<x-p>
    Also available <code>resourceMode</code>, details in the HasMany field
</x-p>

</x-page>
