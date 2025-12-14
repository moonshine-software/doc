# ID родителя в HasMany

Связь `HasMany` хранит данные файлов, которые нужно сохранить в директории по id родителя.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
use App\Models\PostImage;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Traits\Resource\ResourceWithParent; // [tl! collapse:end]

class PostImageResource extends ModelResource
{
    use ResourceWithParent;

    protected string $model = PostImage::class;

    // ...

    protected function getParentResourceClassName(): string
    {
        return PostResource::class;
    }

    protected function getParentRelationName(): string
    {
        return 'post';
    }

    protected function formFields(): iterable
    {
        return [
            ID::make(),
            BelongsTo::make('Post'),
            Image::make('Path')
                ->when(
                    $parentId = $this->getParentId(),
                    static fn(Image $image): string => $image->dir("post_images/$parentId")
                ),
        ];
    }

    // ...
}
```
