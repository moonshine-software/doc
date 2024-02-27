<x-recipe id="hasmany-parent-id" title="{{ $title ?? 'Receipt' }}">

<x-p>
    The <em>HasMany</em> connection stores file data that needs to be saved in a directory by parent id.
</x-p>

<x-code language="php">
use App\Models\PostImage;
use MoonShine\Fields\ID;
use MoonShine\Fields\Image;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Resources\ModelResource;
use MoonShine\Traits\Resource\ResourceWithParent;

class PostImageResource extends ModelResource
{
    use ResourceWithParent;

    public string $model = PostImage::class;

    protected function getParentResourceClassName(): string
    {
        return PostResource::class;
    }

    protected function getParentRelationName(): string
    {
        return 'post';
    }

    public function fields(): array
    {
        return [
            ID::make(),
            Image::make('Path')
                ->when(
                    $parentId = $this->getParentId(),
                    fn(Image $image) => $image->dir('post_images/'.$parentId)
                )
            ,
            BelongsTo::make('Post', 'post', resource: new PostResource())
        ];
    }

    //...
}
</x-code>

</x-recipe>
