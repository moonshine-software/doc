<x-page
    title="Basics"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#variables', 'label' => 'Main features'],
            ['url' => '#create', 'label' => 'Creating'],
            ['url' => '#define', 'label' => 'Announcement'],
            ['url' => '#item', 'label' => 'Current item/model'],
            ['url' => '#routes', 'label' => 'Resource routes'],
            ['url' => '#modal', 'label' => 'Modal windows'],
            ['url' => '#after', 'label' => 'Route after save'],
            ['url' => '#simple-pagination', 'label' => 'Simple pagination'],
            ['url' => '#disable-pagination', 'label' => 'Disable pagination'],
            ['url' => '#views', 'label' => 'Customization of views'],
        ]
    ]
">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    What is an administrative panel? Basically, these are partitions based on data from the database, based on eloquent models.
</x-p>

<x-p>
    MoonShine is based on standard Laravel resource controllers and resource routes

    <x-code language="shell">
        php artisan make:controller Controller --resource
    </x-code>

    <x-code language="php">
        Route::resources('resources', Controller::class);
    </x-code>

    But system will generate and declare them independently.
</x-p>

<x-p>
    Therefore, the MoonShine resources (admin panel sections) are based on the eloquent model.
</x-p>

<x-sub-title id="create">Creating a section in the admin panel</x-sub-title>

<x-code language="shell">
    php artisan moonshine:resource Post
</x-code>

<x-p>
    This will create a Resource class that will be the basis of the new section in the panel.
    By default, it is located in the <code>app/MoonShine/Resources/PostResource</code> directory.
    And it will be automatically bound to the <code>app/Models/Post</code> model.
    The section title will keep the Posts name
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

<x-sub-title id="variables">Main properties of the section</x-sub-title>
<x-p>
    The main parameters of the resource that could be changed in order to customize its work
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
    <code>MoonShine\MoonShine</code>.
</x-p>

<x-code language="php">
namespace App\Providers;

use App\MoonShine\Resources\PostResource; // [tl! focus]

class MoonShineServiceProvider extends ServiceProvider
{
    //...

    public function boot()
    {
        app(MoonShine::class)->resources([
            new PostResource(),
        ])  // [tl! focus: -2]
    }
</x-code>

<x-p>
    To add a resource link to the navigation menu, the resource can be registered using the <code>menu()</code> method.
</x-p>

<x-code language="php">
namespace App\Providers;

use App\MoonShine\Resources\PostResource; // [tl! focus]
use Illuminate\Support\ServiceProvider;
use MoonShine\Menu\MenuItem; // [tl! focus]
use MoonShine\MoonShine; // [tl! focus]
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends ServiceProvider
{
    //...

    public function boot()
    {
        app(MoonShine::class)->menu([ // [tl! focus]
            MenuItem::make('Admins', new MoonShineUserResource()),
            MenuItem::make('Roles', new MoonShineUserRoleResource()),
            MenuItem::make('Posts', new PostResource()), // [tl! focus]
        ]); // [tl! focus]
    }
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/menu.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/menu_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For advanced settings, see <x-link :link="route('moonshine.custom_page', 'advanced-menu')" ><code>Digging Deeper > Menu</code></x-link>.
</x-moonshine::alert>

<x-sub-title id="item">Current item/model</x-sub-title>

<x-p>
    In the resource you have access to the current element and model via the relevant methods.
</x-p>

<x-code language="php">
    $this->getItem();
</x-code>

<x-code language="php">
    $this->getModel();
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    If the element does not yet exist (action create), then the <code>getItem()</code> method will return <code>NULL</code>.
</x-moonshine::alert>

<x-sub-title id="routes">Resource routes</x-sub-title>

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

<x-sub-title id="modal">Modal windows</x-sub-title>

<x-p>
    Ability to add, edit and view entries directly on the list page in a modal window.
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

    protected bool $showInModal = true; // [tl! focus]

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

<x-sub-title id="disable-pagination">Disable pagination</x-sub-title>

<x-p>
    If you do not plan to use pagination, then you can turn it off.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\Resource;

class PostResource extends Resource
{
    public static string $model = Post::class;

    protected bool $usePagination = false; // [tl! focus]

    // ...
}
</x-code>

<x-sub-title id="views">Customization of views</x-sub-title>

<x-p>
    You can customize the display of the list and form through
    the properties <code>itemsView</code>, <code>formView</code> and <code>detailView</code>.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\Resource;

class PostResource extends Resource
{
    public static string $model = Post::class;

    protected string $itemsView = 'moonshine::crud.shared.table'; // [tl! focus]

    protected string $formView = 'moonshine::crud.shared.form'; // [tl! focus]

    protected string $detailView = 'moonshine::crud.shared.detail-card'; // [tl! focus]

    // ...
}
</x-code>

<x-p>
    Or by overriding the appropriate methods
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

    public function formView(): string
    {
        return $this->formView;
    } // [tl! focus:-3]

    public function detailView(): string
    {
        return $this->detailView;
    } // [tl! focus:-3]

    // ...
}
</x-code>

</x-page>
