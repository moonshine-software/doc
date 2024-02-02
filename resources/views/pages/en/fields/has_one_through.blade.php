<x-page title="HasOneThrough">

<x-extendby :href="to_page('fields-has_one')">
    HasMany
</x-extendby>

<x-p>
    The <em>HasOneThrough</em> field is designed to work with the relation of the same name in Laravel,
    inherits from the <em>HasOne</em> field and includes all its methods.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\HasOneThrough; // [tl! focus]

//...

public function fields(): array
{
    return [
        HasOneThrough::make('Car owner', 'carOwner', resource: new OwnerResource()) // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
