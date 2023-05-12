<x-page
    title="Basics"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#variables', 'label' => 'Main features'],
            ['url' => '#create', 'label' => 'Creating'],
            ['url' => '#define', 'label' => 'Announcement'],
            ['url' => '#modal', 'label' => 'Modal windows'],
            ['url' => '#after', 'label' => 'Route after save'],
            ['url' => '#simple-pagination', 'label' => 'Simple pagination'],
            ['url' => '#items-view', 'label' => 'Items view'],
        ]
    ]
">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    What is an administrative panel? Of course these are partitions based on data from the database, based on eloquent models.
</x-p>

<x-p>
    MoonShine is based on standard Laravel resource controllers and resource routers

    <x-code language="shell">
        php artisan make:controller Controller --resource
    </x-code>

    <x-code language="php">
        Route::resources('resources', Controller::class);
    </x-code>

    But the system will generate and announce them independently.
</x-p>

<x-p>
    Therefore, the MoonShine resources (admin panel sections) are based on the eloquent model.
</x-p>

<x-sub-title id="create">Creating a section of the admin panel</x-sub-title>

<x-code language="shell">
    php artisan moonshine:resource Post
</x-code>

<x-p>
    This will create a Resource class that will be the basis of the new section in the panel.
    It is located by default in the <code>app/MoonShine/Resources/PostResource</code> directory.
     And it will be automatically bound to the <code>app/Models/Post</code> model.
     The section title will remain Posts.
</x-p>

<x-p>
    You can change the model binding and section title along with the command

    <x-code language="shell">
        php artisan moonshine:resource Post --model=CustomPost --title="Articles"
    </x-code>

    <x-code language="shell">
        php artisan moonshine:resource Post --model="App\Models\CustomPost" --title="Articles"
    </x-code>
</x-p>

<x-sub-title id="variables">Main section properties</x-sub-title>
<x-p>
    The main parameters that can be changed for a resource in order to customize its work
</x-p>
<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Models\MoonshineUser;

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class; // Model [tl! focus]

    public static string $title = 'Articles'; // Section name [tl! focus]

    public static string $subTitle = 'Article Management'; // Text under section heading [tl! focus]

    public static array $with = ['category']; // Eager load [tl! focus]

    public static bool $withPolicy = false; // Authorization [tl! focus]

    public static string $orderField = 'id'; // Default sort field [tl! focus]

    public static string $orderType = 'DESC'; // Default sort type [tl! focus]

    public static int $itemsPerPage = 25; // Number of items per page [tl! focus]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_paginate.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_paginate_dark.png') }}"></x-image>

<x-sub-title id="define">Declaring a partition in the system</x-sub-title>

<x-p>
    New resources are added to the system in the <code>service provider</code> using the singleton class
     <code>MoonShine\MoonShine</code> and <code>menu</code> method
</x-p>
<x-code language="php">
namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

use MoonShine\MoonShine;

use MoonShine\Resources\MoonShineUserResource; // [tl! focus]
use MoonShine\Resources\MoonShineUserRoleResource; // [tl! focus]
use App\MoonShine\Resources\PostResource; // [tl! focus]

class MoonShineServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        Model::preventLazyLoading(!app()->isProduction());

        // [tl! focus:start]
        app(MoonShine::class)->menu([
            MoonShineUserResource::class, // System partition with administrators
            MoonShineUserRoleResource::class, // System partition with administrator roles
            PostResource::class, // Our new section
        ]);
        // [tl! focus:end]
    }
}
</x-code>

<x-p>After the sections will appear in the menu and will be available in the panel</x-p>

<x-image theme="light" src="{{ asset('screenshots/menu.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/menu_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For advanced settings, see <x-link :link="route('moonshine.custom_page', 'advanced-menu')" ><code>Digging Deeper > Menu</code></x-link>
</x-moonshine::alert>

<x-sub-title id="modal">Modal windows</x-sub-title>

<x-p>
    Ability to add entries and edit directly on the list page in a modal window
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;

use MoonShine\Resources\Resource;

class PostResource extends Resource
{
    public static string $model = Post::class;

    public static string $title = 'Posts';

    protected bool $createInModal = true; // [tl! focus]

    protected bool $editInModal = true; // [tl! focus]

    // ...
</x-code>

<x-sub-title id="after">Route after save</x-sub-title>

<x-p>
    After saving the resource, you can specify which route to go to:
    the list page, the detail page, or the edit page.
</x-p>

<x-p>Default <code>index</code></x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\Resource;

class PostResource extends Resource
{
    public static string $model = Post::class;

    protected string $routeAfterSave = 'index'; // index, show, edit [tl! focus]

    // ...
}
</x-code>

<x-sub-title id="simple-pagination">Simple pagination</x-sub-title>

<x-p>
    If you don't plan to display the total number of pages, use <code>Simple Pagination</code>.
    This will avoid additional queries on the total number of records in the database.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\Resource;

class PostResource extends Resource
{
    public static string $model = Post::class;

    public static bool $simplePaginate = true; // [tl! focus]

    // ...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_simple_paginate.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_simple_paginate_dark.png') }}"></x-image>

<x-sub-title id="items-view">Items view</x-sub-title>

<x-p>
    You can customize the display of the list of items through the property <code>itemsView</code>
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\Resource;

class PostResource extends Resource
{
    public static string $model = Post::class;

    protected string $itemsView = 'moonshine::crud.shared.table'; // [tl! focus]

    // ...
}
</x-code>

<x-p>
    Or by overriding the appropriate <code>itemsView</code> method
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\Resource;

class PostResource extends Resource
{
    public static string $model = Post::class;

    public function itemsView(): string
    {
        return $this->itemsView;
    } // [tl! focus:-3]

    // ...
}
</x-code>

</x-page>
