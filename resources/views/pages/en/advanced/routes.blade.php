<x-page
    title="Routes"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Resource routes'],
            ['url' => '#resolve', 'label' => 'Custom routes'],
        ]
    ]"
>

<x-sub-title id="basics">Resource routes</x-sub-title>

<x-p>
    In MoonShine, the resource has many routes registered for various actions:
</x-p>

<x-code language="php">
$this->route('index'); // GET|HEAD - list of items
$this->route('create'); // GET|HEAD - create a new item
$this->route('store'); // POST - save a new item
$this->route('edit', $resourceItem); // GET|HEAD - edit an item
$this->route('update', $resourceItem); // PUT|PATCH - save an item
$this->route('destroy', $resourceItem); // DELETE - delete an item
$this->route('show', $resourceItem); // GET|HEAD - view an item
$this->route('query-tag', $queryTag); // GET|HEAD - filtered list of items by query filter / tag
$this->route('update-column', $resourceItem); // PUT - save an item`s field
</x-code>

<x-sub-title id="resolve">Custom routes</x-sub-title>

<x-p>
    Through the <code>resolveRoutes()</code> method, you can add or override default routes.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\Resource;

class PostResource extends Resource
{
    public static string $model = Post::class;

    // ...

    public function resolveRoutes(): void // [tl! focus:start]
    {
        parent::resolveRoutes();

        Route::prefix('resource')->group(function (): void {
            Route::get("{$this->uriKey()}/restore/{resourceItem}", function (Post $item) {
                $item->restore();

                return redirect()->back();
            });
        });
    } // [tl! focus:end]

    // ...
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    To access a route outside of a resource, use <code>(new Resource())->route('index')</code>.
</x-moonshine::alert>

</x-page>
