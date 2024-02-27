<x-sub-title id="parent-id">ID родителя</x-sub-title>

<x-p>
    Если у связи есть ресурс, и необходимо получить ID родительского элемента,
    то можно воспользоваться трейтом <em>ResourceWithParent</em>.
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
    При использовании трейта, необходимо определить методы:
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
    Для получения ID родителя используется метод <code>getParentId()</code>.
</x-p>

<x-code language="php">
    $this->getParentId();
</x-code>

<x-moonshine::alert type="primary" icon="heroicons.outline.book-open">
    Рецепт: <x-link link="{{ to_page('recipes') }}#hasmany-parent-id">сохранение файлов</x-link>
    в директории с ID родителя.
</x-moonshine::alert>
