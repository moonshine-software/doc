<x-page title="HasOneThrough">

<x-extendby :href="route('moonshine.page', 'fields-has_one')">
    HasMany
</x-extendby>

<x-p>
    Поле <em>HasOneThrough</em> предназначено для работы с одноименным отношением в Laravel,
    наследуется от поля <em>HasOne</em> и включает в себя все его методы.
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
