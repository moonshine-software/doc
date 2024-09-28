https://moonshine-laravel.com/docs/resource/models-resources/resources-index?change-moonshine-locale=en

------

# Basics

- [Basics](#basics)
- [Creating a section](#creating-a-section)
- [Basic section properties](#basic-section-properties)
- [Declaring a section in the system](#declaring-a-section-in-the-system)
- [Current element/model](#current-elementmodel)
- [Modal windows](#modal-windows)
- [Redirects](#redirects)
- [Active actions](#active-actions)
- [Buttons](#buttons)
- [Modification](#modification)
- [Components](#components)
- [Boot](#boot)

<a name="basics"></a>
## Basics

At any admin panel heart are sections for editing data. **MoonShine** is no exception to this and uses `Eloquent` models to work with the database, and for sections there are standard Laravel resource controllers and resource routes.

If you were developing on your own, then create resource controllers and resource routes can be as follows:

```php
php artisan make:controller Controller --resource
```

```php
Route::resource('resources', Controller::class);
```

However, this work can be entrusted to the **MoonShine** admin panel, which will generate and declare them independently.

`ModelResource` is the main component for creating a section in the admin panel when working with the database.

<a name="creating-a-section"></a>
## Creating a section

```php
php artisan moonshine:resource Post
```

- change your resource name if required
- select resource type

There are several options available when creating a *ModelResource*:
- [Default model resource](https://moonshine-laravel.com/docs/resource/models-resources/resources-fields#default) - model resource with common fields
- [Separate model resource](https://moonshine-laravel.com/docs/resource/models-resources/resources-fields#separate) - model resource with field separation
- [Model resource with pages](https://moonshine-laravel.com/docs/resource/models-resources/resources-pages) - model resource with pages.

As a result, a `PostResource` class will be created, which will be a new section basis in the panel. It is located, by default, in the `app/MoonShine/Resources` directory.  
MoonShine will automatically, based on the name, link the resource to the `app/Models/Post` model. The section title will also be generated automatically and will be “Posts”.

You can immediately specify the model binding and section title for the command:

```php
php artisan moonshine:resource Post --model=CustomPost --title="Articles"
```

```php
php artisan moonshine:resource Post --model="App\Models\CustomPost" --title="Articles"
```

<a name="basic-section-properties"></a>
## Basic section properties

Basic parameters that can be changed for a resource to customize its operation

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class; // Model

    protected string $title = 'Posts'; // Section title

    protected array $with = ['category']; // Eager load

    protected string $column = 'id'; // Field to display values in links and breadcrumbs

    //...
}
```

![resource_paginate](https://moonshine-laravel.com/screenshots/resource_paginate.png)
![resource_paginate_dark](https://moonshine-laravel.com/screenshots/resource_paginate_dark.png)

<a name="declaring-a-section-in-the-system"></a>
## Declaring a section in the system

Register the resource in the system and immediately add a link to the section in the navigation menu you can use the service provider `MoonShineServiceProvider`.

```php
namespace App\Providers;

use App\MoonShine\Resources\PostResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...

    protected function menu(): array
    {
        return [
            MenuItem::make('Posts', new PostResource())
        ];
    }

    //...
}
```

> [!TIP]
> You can learn about advanced settings in the section [Menu](https://moonshine-laravel.com/docs/resource/menu/menu).

If you only need to register the resource in the system without adding it to the navigation menu:

```php
namespace App\Providers;

use App\MoonShine\Resources\PostResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function resources(): array
    {
        return [
            new PostResource()
        ];
    }

    //...
}
```

<a name="current-elementmodel"></a>
## Current element/model

If the url of the detail page or editing page contains the `resourceItem` parameter, then in a resource you can access the current item through the `getItem()` method.

```php
$this->getItem();
```

You can access the model through the `getModel()` method.

```php
$this->getModel();
```

<a name="modal-windows"></a>
## Modal windows

Ability to add, edit and view entries directly on the list page in a modal window.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $createInModal = false;

    protected bool $editInModal = false;

    protected bool $detailInModal = false;

    //...
}
```

<a name="redirects"></a>
## Redirects

By default, when creating and editing a record, a redirect is made to the page with the form, but this behaviour can be controlled.

```php
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
```

<a name="active-actions"></a>
## Active actions

It often happens that it is necessary to create a resource in which the ability to delete will be excluded, or add or edit. In addition, here we are not talking about authorization, but about the global exclusion of these sections. This is done extremely simply using the `getActiveActions` method in the resource.

```php
namespace MoonShine\Resources;

class PostResource extends ModelResource
{
    //...

    public function getActiveActions(): array
    {
        return ['create', 'view', 'update', 'delete', 'massDelete'];
    }

    //...
}
```

<a name="buttons"></a>
## Buttons

By default, the model resource index page only has a button to create.  
The `actions()` method allows you to add additional [buttons](https://moonshine-laravel.com/docs/resource/actionbutton/action_button).

```php
namespace MoonShine\Resources;

class PostResource extends ModelResource
{
    //...

    public function actions(): array
    {
        return [
            ActionButton::make('Refresh', '#')
                ->dispatchEvent(AlpineJs::event(JsEvent::TABLE_UPDATED, 'index-table'))
        ];
    }

    //...
}
```
#### Display

You can also change the display of the buttons, display them in a line or in a drop-down menu to save space.

```php
namespace MoonShine\Resources;

class PostResource extends ModelResource
{
    //...

    public function actions(): array
    {
        return [
            ActionButton::make('Button 1', '/')
                ->showInLine(),
            ActionButton::make('Button 2', '/')
                ->showInDropdown()
        ];
    }

    //...
}
```


<a name="modification"></a>
## Modification

To modify the main **IndexPage**, **FormPage** or **DetailPage** component pages from a resource, you can override the corresponding `modifyListComponent()`, `modifyFormComponent()` and `modifyDetailComponent()` methods.

```php
public function modifyListComponent(MoonShineRenderable $component): MoonShineRenderable
{
    return parent::modifyListComponent($component)->customAttributes([
        'data-my-attr' => 'value'
    ]);
}
```

```php
public function modifyFormComponent(MoonShineRenderable $component): MoonShineRenderable
{
    return parent::modifyFormComponent($component)->fields([
        FlexibleRender::make('Top'),
        ...parent::modifyFormComponent($component)->getFields()->toArray(),
        FlexibleRender::make('Bottom'),
    ])->submit('Go');
}
```

```php
public function modifyDetailComponent(MoonShineRenderable $component): MoonShineRenderable
{
    return parent::modifyDetailComponent($component)->customAttributes([
        'data-my-attr' => 'value'
    ]);
}
```

<a name="components"></a>
## Components

The best way to change page components is to publish the pages and interact through them, but if you want to quickly add components to pages, then you can use the methods of the `pageComponents` resource, `indexPageComponents`, `formPageComponents`, `detailPageComponents`.

```php
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
```

> [!TIP]
> The components will be added to the `bottomLayer`

<a name="boot"></a>
## Boot

If you need to add logic to a resource operation when it is active and loaded, then use the `onBoot` method.

```php
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
```

> [!TIP]
> Recipe: [Changing breadcrumbs from a resource](https://moonshine-laravel.com/docs/resource/recipes/recipes#custom-breadcrumbs).

You can also connect trait to a resource and inside trait add a method according to the naming convention - `boot{TraitName}` and through the trait will access the boot resource

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;
use App\Traits\WithPermissions;

class PostResource extends ModelResource
{
    use WithPermissions;
}
```

```php
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
```
