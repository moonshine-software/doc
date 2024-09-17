https://moonshine-laravel.com/docs/resource/models-resources/resources-filters?change-moonshine-locale=en

------

## Filters 

To create filters, fields are also used: they are displayed only on the section main page.  

To specify which fields to filter data by, enough in your model resource in the `filters()` method,return an array with the required fields.  

> [!NOTE]  
> If the method is missing or returns an empty array, then the filters will not be displayed

> [!NOTE]  
> Some fields cannot participate in constructing a filtering request, therefore they will be automatically excluded from the filter list

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function filters(): array
    {
        return [
            Text::make('Title', 'title'),
        ];
    }

    //...
}
```

![filters](https://moonshine-laravel.com/screenshots/filters.png)
![filters_dark](https://moonshine-laravel.com/screenshots/filters_dark.png)

> [!TIP]
> Fields are a key element in building forms in the **Moonshine** admin panel.
[More about Fields](https://moonshine-laravel.com/docs/resource/fields/fields-index)

If you need to cache the filters state, use the `saveFilterState` property in the resource

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $saveFilterState = true;
//...
}
```
