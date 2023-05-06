<x-page title="HasMany">

<x-p>Field for relationships in Laravel, hasMany type</x-p>

<x-code language="php">
use MoonShine\Fields\HasMany;

//...
public function fields(): array
{
    return [
        HasMany::make('Comments')
            ->fields([
                ID::make(),
                BelongsTo::make('Article'),
                BelongsTo::make('User'),
                Text::make('Text')->required(),,
            ])
            ->removable()
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
    but display the fields completely,
    you can use the fullPage() method, and the fields will get a standard shape
</x-p>

<x-image theme="light" src="{{ asset('screenshots/has_many.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_many_dark.png') }}"></x-image>

<x-p>
    Anyway, the table and fullPage modes are more suitable for relations with primitive fields, such modes
    do not support Json, HasOne, HasMany fields and many others.
    But you can switch the field to <code>ResourceMode</code> to render a list of related records, or a related form
    as a standalone resource.
    To do this, you need to specify the <code>resourceMode()</code> method for the field and in this case you shouldn't specify the field set
    in the <code>fields()</code> method, but the resource associated with the fields will be required
</x-p>

<x-code language="php">
use MoonShine\Fields\HasMany;

//...
public function fields(): array
{
    return [
        HasMany::make('Rates', 'prices', new PriceResource())
            ->resourceMode()
    ];
}
//...
</x-code>

<x-p>
    Pay attention that the presence of a resource in this mode is a mandatory criterion.
    However, it can be omitted if it does not violate the naming convention. As a result of which, it will be found automatically.
</x-p>

<x-image theme="light" src="{{ asset('screenshots/resource_mode.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_mode_dark.png') }}"></x-image>

</x-page>
