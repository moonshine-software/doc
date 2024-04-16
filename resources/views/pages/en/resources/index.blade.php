<x-page
    title="Basics"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#create', 'label' => 'Creation'],
            ['url' => '#variables', 'label' => 'Basic properties'],
            ['url' => '#define', 'label' => 'Announcement'],
            ['url' => '#item', 'label' => 'Current element/model'],
            ['url' => '#modal', 'label' => 'Modal windows'],
            ['url' => '#redirects', 'label' => 'Redirects'],
            ['url' => '#active_actions', 'label' => 'Active actions'],
            ['url' => '#actions', 'label' => 'Buttons'],
            ['url' => '#components', 'label' => 'Components'],
            ['url' => '#boot', 'label' => 'Boot'],
        ]
    ]"
    :videos="[]"
>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    At any admin panel heart are sections for editing data.
    <strong>MoonShine</strong> is no exception to this
    and uses <code>Eloquent</code> models to work with the database,
    and for sections there are standard Laravel resource controllers and resource routes.
</x-p>

<x-p>
    If you were developing on your own, then create resource controllers and resource
    routes can be as follows:
</x-p>

<x-code language="shell">
    php artisan make:controller Controller --resource
</x-code>

<x-code language="php">
    Route::resource('resources', Controller::class);
</x-code>

<x-p>
    However, this work can be entrusted to the <strong>MoonShine</strong> admin panel,
    which will generate and declare them independently.
</x-p>

<x-p>
    <code>ModelResource</code> is the main component for creating a section
    in the admin panel when working with the database.
</x-p>

<x-sub-title id="create">Creating a section</x-sub-title>

<x-code language="shell">
    php artisan moonshine:resource Post
</x-code>

<x-p>
    <x-ul
        :items="[
            'change your resource name if required<',
            'select resource type',
        ]"
    />
</x-p>

<x-p>
    There are several options available when creating a <em>ModelResource</em>:
    <x-ul>
        <li>
            <x-link :link="to_page('resources-fields') . '#default'" ><strong>Default model resource</strong></x-link>
            - model resource with common fields
        </li>
        <li>
            <x-link :link="to_page('resources-fields') . '#separate'" ><strong>Separate model resource</strong></x-link>
            - model resource with field separation
        </li>
        <li>
            <x-link :link="to_page('resources-pages')" ><strong>Model resource with pages</strong></x-link>
            - model resource with pages.
        </li>
    </x-ul>
</x-p>

<x-p>
    As a result, a <code>PostResource</code> class will be created, which will be a new section basis in the panel.<br />
    It is located, by default, in the <code>app/MoonShine/Resources</code> directory.<br />
    MoonShine will automatically, based on the name, link the resource to the <code>app/Models/Post</code> model.<br />
    The section title will also be generated automatically and will be “Posts”.
</x-p>

<x-p>
    You can immediately specify the model binding and section title for the command:
</x-p>

<x-code language="shell">
    php artisan moonshine:resource Post --model=CustomPost --title="Articles"
</x-code>

<x-code language="shell">
    php artisan moonshine:resource Post --model="App\Models\CustomPost" --title="Articles"
</x-code>

<x-sub-title id="variables">Basic section properties</x-sub-title>

<x-p>
    Basic parameters that can be changed for a resource to customize its operation
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class; // Model [tl! focus]

    protected string $title = 'Posts'; // Section title [tl! focus]

    protected array $with = ['category']; // Eager load [tl! focus]

    protected string $column = 'id'; // Field to display values in links and breadcrumbs [tl! focus]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_paginate.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_paginate_dark.png') }}"></x-image>

<x-sub-title id="define">Declaring a section in the system</x-sub-title>

<x-p>
    Register the resource in the system and immediately add a link to the section in the navigation menu
    you can use the service provider <code>MoonShineServiceProvider</code>.
</x-p>

<x-code language="php">
namespace App\Providers;

use App\MoonShine\Resources\PostResource; // [tl! focus]
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...

    protected function menu(): array
    {
        return [
            MenuItem::make('Posts', new PostResource())
        ];
    } // [tl! focus:-4]

    //...
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    You can learn about advanced settings in the section
    <x-link :link="to_page('menu')" ><code>Menu</code></x-link>.
</x-moonshine::alert>

<x-p>
    If you only need to register the resource in the system without adding it to the navigation menu:
</x-p>

<x-code language="php">
namespace App\Providers;

use App\MoonShine\Resources\PostResource; // [tl! focus]
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function resources(): array
    {
        return [
            new PostResource()
        ];
    } // [tl! focus:-4]

    //...
}
</x-code>

<x-sub-title id="item">Current element/model</x-sub-title>

<x-p>
    If the url of the detail page or editing page contains the <code>resourceItem</code> parameter,
    then in a resource you can access the current item through the <code>getItem()</code> method.
</x-p>

<x-code language="php">
$this->getItem();
</x-code>

<x-p>
    You can access the model through the <code>getModel()</code> method.
</x-p>

<x-code language="php">
    $this->getModel();
</x-code>

<x-sub-title id="modal">Modal windows</x-sub-title>

<x-p>
    Ability to add, edit and view entries directly on the list page in a modal window.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $createInModal = false; // [tl! focus]

    protected bool $editInModal = false; // [tl! focus]

    protected bool $detailInModal = false; // [tl! focus]

    //...
}
</x-code>

<x-sub-title id="redirects">Redirects</x-sub-title>

<x-p>
    By default, when creating and editing a record, a redirect is made to the page with the form,
    but this behaviour can be controlled
</x-p>

<x-code>
// Via a property in a resource
protected ?PageType $redirectAfterSave = PageType::FORM;

// or through methods (redirect after deletion is also available)

public function redirectAfterSave(): string
{
    return '/';
}

public function redirectAfterDelete(): string
{
    return to_page(CustomPage::class);
}
</x-code>

<x-sub-title id="active_actions">Active actions</x-sub-title>

<x-p>
    It often happens that it is necessary to create a resource in which the ability to delete will be excluded,
    or add or edit. In addition, here we are not talking about authorization, but about the global exclusion of these sections.
    This is done extremely simply using the <code>getActiveActions</code> method in the resource
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

class PostResource extends ModelResource
{
    //...

    public function getActiveActions(): array // [tl! focus:start]
    {
        return ['create', 'view', 'update', 'delete', 'massDelete'];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="actions">Buttons</x-sub-title>

<x-p>
    By default, the model resource index page only has a button to create.<br />
    The <code>actions()</code> method allows you to add additional <x-link link="{{ to_page('action_button') }}">buttons</x-link>.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

class PostResource extends ModelResource
{
    //...

    public function actions(): array // [tl! focus:start]
    {
        return [
            ActionButton::make('Refresh', '#')
                ->dispatchEvent(AlpineJs::event(JsEvent::TABLE_UPDATED, 'index-table'))
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-moonshine::divider label="Display" />

<x-p>
    You can also change the display of the buttons,
    display them in a line or in a drop-down menu to save space.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

class PostResource extends ModelResource
{
    //...

    public function actions(): array
    {
        return [
            ActionButton::make('Button 1', '/')
                ->showInLine(),  // [tl! focus]
            ActionButton::make('Button 2', '/')
                ->showInDropdown()  // [tl! focus]
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="components">Components</x-sub-title>

<x-p>
    The best way to change page components is to publish the pages
    and interact through them, but if you want to quickly add components to pages,
    then you can use the methods of the <code>pageComponents</code> resource,
    <code>indexPageComponents</code>,
    <code>formPageComponents</code>,
    <code>detailPageComponents</code>
</x-p>

<x-code>
// or indexPageComponents/formPageComponents/detailPageComponents
public function pageComponents(): array
{
    return [
        Modal::make(
            'My Modal'
            components: PageComponents::make([
                FormBuilder::make()->fields([
                    Text::make('Title')
                ])
            ])
        )
        ->name('demo-modal')
    ];
}
</x-code>

<x-moonshine::alert type="primary" icon="heroicons.outline.book-open">
    The components will be added to the <code>bottomLayer</code>
</x-moonshine::alert>

<x-sub-title id="boot">Boot</x-sub-title>

<x-p>
    If you need to add logic to a resource operation when it is active and loaded,
    then use the <code>onBoot</code> method
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...
    protected function onBoot(): void
    {
        //
    }
    // ...
}
</x-code>

<x-moonshine::alert type="primary" icon="heroicons.outline.book-open">
    Recipe:
    <x-link link="{{ to_page('recipes') }}#custom-breadcrumbs">
        Changing breadcrumbs from a resource
    </x-link>.
</x-moonshine::alert>

<x-p>
    You can also connect trait to a resource and inside trait add a method according to the naming convention -
    boot{TraitName} and through the trait will access the boot resource
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;
use App\Traits\WithPermissions;

class PostResource extends ModelResource
{
    use WithPermissions;
}
</x-code>

<x-code language="php">
trait WithPermissions
{
    protected function bootWithPermissions(): void
    {
        $this->getPages()
            ->findByUri(PageType::FORM->value)
            ->pushToLayer(
                layer: Layer::BOTTOM,
                component: Permissions::make(
                    label: 'Permissions',
                    resource: $this,
                )
            );
    }
}
</x-code>

</x-page>
