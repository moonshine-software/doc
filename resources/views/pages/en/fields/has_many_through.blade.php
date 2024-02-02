<x-page title="HasManyThrough">

<x-extendby :href="to_page('fields-has_many')">
    HasMany
</x-extendby>

<x-p>
    The <em>HasManyThrough</em> field is designed to work with the relation of the same name in Laravel,
    inherits from the <em>HasMany</em> field and includes all its methods.
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
