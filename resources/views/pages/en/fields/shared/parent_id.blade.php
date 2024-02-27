<x-sub-title id="parent-id">Parent ID</x-sub-title>

<x-p>
    If the relationship has a resource, and you want to get the ID of the parent element,
    then you can use the <em>ResourceWithParent</em> trait.
</x-p>

<x-code language="php">
use MoonShine\Resources\ModelResource;
use MoonShine\Traits\Resource\ResourceWithParent; // [tl! focus]

class PostImageResource extends ModelResource
{
    use ResourceWithParent; // [tl! focus]

    //...
}
</x-code>

<x-p>
    When using a trait, it is necessary to define methods:
</x-p>

<x-code language="php">
protected function getParentResourceClassName(): string
{
    return PostResource::class;
}

protected function getParentRelationName(): string
{
    return 'post';
}
</x-code>

<x-p>
    To get the parent ID, use the <code>getParentId()</code> method.
</x-p>

<x-code language="php">
    $this->getParentId();
</x-code>

<x-moonshine::alert type="primary" icon="heroicons.outline.book-open">
    Recipe: <x-link link="{{ to_page('recipes') }}#hasmany-parent-id">saving files</x-link>
    <em>HasMany</em> connections in the directory with the parent ID.
</x-moonshine::alert>
