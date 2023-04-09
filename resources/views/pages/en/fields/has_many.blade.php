<x-page title="HasMany">

<x-p>The relationship field in laravel like hasMany</x-p>

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

<x-p>
    It often happens that there are a lot of fields for communication and in the table they are displayed small and not convenient.
     In many cases, it is necessary to move such a link to a separate resource, but if necessary
     leave within the current resource, but display the fields fully, then use
     using the <code>fullPage()</code> method and the fields will take the standard form
</x-p>

<x-image theme="light" src="{{ asset('screenshots/has_many.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_many_dark.png') }}"></x-image>

<x-p>
    Still, the table and fullPage modes are more suitable for relations with primitive fields, such modes
     do not support Json fields, HasOne, HasMany and many others.
     But you can switch the field to resource mode <code>ResourceMode</code> and thereby render a list of related records, or a related form
     as a complete resource.
     To do this, you need to specify the <code>resourceMode()</code> method for the field and in this case you do not have to specify the field set
     in the <code>fields()</code> method, but the associated resource with the fields will be required
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
    Pay attention to the presence of a resource in this mode is a mandatory criterion. Although it can be omitted if it does not violate the naming convention. it will be found automatically
</x-p>

<x-image theme="light" src="{{ asset('screenshots/resource_mode.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_mode_dark.png') }}"></x-image>

</x-page>
