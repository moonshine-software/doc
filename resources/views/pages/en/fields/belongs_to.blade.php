<x-page title="BelongsTo">

<x-p>Relationship field in laravel like belongsTo</x-p>

<x-p>Displayed as select, it is also possible to add a value search using the method:
<code>searchable</code></x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\BelongsTo;

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

<x-p>The third argument with the value "name" is a field in the linked table to display the values</x-p>

<x-p>You can also pass a resource with a field to display as a third parameter</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\BelongsTo;
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

use Leeto\MoonShine\Resources\Resource;
use App\Models\Country;

class CountryResource extends Resource
{
//...

public string $titleField = 'name'; // [tl! focus]

//...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/belongs_to.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/belongs_to_dark.png') }}"></x-image>

<x-p>If you need a more complex value to display, you can pass a function to the third argument</x-p>
<x-code language="php">
use Leeto\MoonShine\Fields\BelongsTo;

//...
public function fields(): array
{
return [
    BelongsTo::make('Country', 'country', fn($item) => "$item->id.) $item->name")
];
}
//...
</x-code>

<x-p>If the default value is necessary Null</x-p>
<x-code language="php">
use Leeto\MoonShine\Fields\BelongsTo;

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

<x-p>Don't forget, also at the table level in the database, to specify that the field can be Null</x-p>

</x-page>
