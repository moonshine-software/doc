<x-page title="HasManyThrough">

<x-extendby :href="to_page('fields-has_many')">
    HasMany
</x-extendby>

<x-p>
    Поле <em>HasManyThrough</em> предназначено для работы с одноименным отношением в Laravel,
    наследуется от поля <em>HasMany</em> и включает в себя все его методы.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\HasManyThrough; // [tl! focus]

//...

public function fields(): array
{
    return [
        HasManyThrough::make('Deployments', 'deployments', resource: new DeploymentResource()) // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
