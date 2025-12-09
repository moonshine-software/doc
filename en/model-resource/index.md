---
video: https://youtu.be/5o8qSf94Bf0?si=9dLj_SiXA1-w6hFo
---

# Basics

- [Basics](#basics)
- [Creating](#creating)
- [Basic Properties](#basic-properties)
- [Declaring in the System](#declaring-in-the-system)
- [Autoloading](#autoloading)
- [Sorting](#sorting)
- [Pagination](#pagination)
- [Async mode](#is-async)
- [Adding to the Menu](#adding-to-the-menu)
- [Alias](#alias)
- [Current Element/Model](#current-element-model)
- [Modal Windows](#modal-windows)
- [Redirects](#redirects)
- [Active Actions](#active-actions)
- [Lifecycle](#lifecycle)
    - [Active Resource](#on-load)
    - [Creating an Instance](#on-boot)
- [Assets](#assets)
- [Response modifiers](#response-modifiers)
- [CRUD operation handlers](#crud-operations-handlers)

---

<a name="basics"></a>
## Basics

`ModelResource` extends `CrudResource` and provides functionality for working with Eloquent models.
It serves as a foundation for creating resources associated with database models.
`ModelResource` offers methods for performing CRUD operations, managing relationships, applying filters, and much more.

> [!TIP]
> You can also refer to the section on [CrudResource](/docs/{{version}}/advanced/crud-resource).
> `CrudResource` is an abstract class providing a basic interface for `CRUD` operations without binding to a storage and data type.

Under the hood, `ModelResource` extends `CrudResource` and immediately includes the capability to work with Eloquent.
If you delve into the details of **MoonShine**, you will see all the standard Controller, Model, and Blade views.

If you were developing independently, you could create resource controllers and resource routes as follows:

```shell
php artisan make:controller Controller --resource
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use Illuminate\Support\Facades\Route;

Route::resource('resources', Controller::class);
```

But this work can be entrusted to the admin panel **MoonShine**, which will generate and declare them automatically.

`ModelResource` is the primary component for creating a section in the admin panel when working with databases.

<a name="creating"></a>
## Creating

```shell
php artisan moonshine:resource Post
```

> [!NOTE]
> For more details, refer to the [Commands](/docs/{{version}}/advanced/commands#resource).

<a name="basic-properties"></a>
## Basic Properties

Basic parameters that can be changed for a resource to customize its functionality.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<Post>
 */
class PostResource extends ModelResource
{
    // Model
    protected string $model = Post::class;

    // Section title
    protected string $title = 'Posts';

    // Eager load
    protected array $with = ['category'];

    // Field for displaying values in relationships and breadcrumbs
    protected string $column = 'id';

    // ...
}
```

![resource_paginate](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_paginate.png#light)
![resource_paginate_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_paginate_dark.png#dark)

<a name="declaring-in-the-system"></a>
## Declaring in the System

The resource is automatically registered in `MoonShineServiceProvider` when executing the command `php artisan moonshine:resource`.
However, if you create a section manually, you need to declare it in the system within `MoonShineServiceProvider`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\Providers;

use App\MoonShine\Resources\ArticleResource;

use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\ConfiguratorContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator; // [tl! collapse:end]

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     *
     */
    public function boot(
        CoreContract $core,
        ConfiguratorContract $config,
    ): void
    {
        $core
            ->resources([
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                ArticleResource::class,
                // ...
            ])
            ->pages([
                ...$config->getPages(),
            ])
        ;
    }
}
```

<a name="autoloading"></a>
## Autoloading

Autoloading of pages and resources is also available in **MoonShine**.
It is disabled by default and to activate it you need to call the `autoload()` method in `MoonShineServiceProvider` instead of specifying links to pages and resources.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\Providers;

use App\MoonShine\Resources\ArticleResource;

use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\ConfiguratorContract; // [tl! collapse:end]

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(
        CoreContract $core,
        ConfiguratorContract $config,
    ): void
    {
        $core->autoload();
    }
}
```

When deploying a project to production in Laravel 11+ [it is recommended](https://laravel.com/docs/11.x/packages#optimize-commands) to call the `php artisan optimize` console command.
In addition to its basic functions, it will also perform **MoonShine** resource caching.

When using Laravel 10, you must manually call the `php artisan moonshine:optimize` console command to optimize the admin panel initialization process.

You can clear the panel cache either with the `php artisan optimize:clear` command in Laravel 11
or by directly calling the `php artisan moonshine:optimize-clear` console command.

> [!WARNING]
> If the application does not see them after creating the classes, update the composer cache with the `composer dump-autoload` command.

<a name="sorting"></a>
## Sorting

By default, table records are sorted by the `id` field in descending order.
You can change the sorting using the `$sortColumn` and `$sortDirection` properties.

```php filename:PostResource.php
protected string $sortColumn = 'created_at';

protected string $sortDirection = 'DESC';
```

<a name="pagination"></a>
## Pagination

By default, **MoonShine** uses Laravel's standard pagination.
You can switch to cursor pagination or simple pagination using the `$cursorPaginate` and `$simplePaginate` properties.

```php filename:PostResource.php
protected bool $cursorPaginate = true;
```

```php filename:PostResource.php
protected bool $simplePaginate = true;
```

> [!NOTE]
> Learn more about pagination types in the [Laravel documentation](https://laravel.com/docs/pagination).

<a name="is-async"></a>
## Async Mode

By default, the resource is set to Asynchronous mode.
To disable it, override the `$isAsync` property in the resource or on individual CRUD pages.

```php filename:PostIndexPage.php
protected bool $isAsync = false;
```

> [!TIP]
> For more information about asynchronous table loading, see [TableBuilder](/docs/{{version}}/components/table-builder#async-loading).

> [!TIP]
> For more information about asynchronous form submission, see [FormBuilder](/docs/{{version}}/components/form-builder#asynchronous-mode).

<a name="adding-to-the-menu"></a>
## Adding to the Menu

All pages in **MoonShine** have a `Layout`, and each page can have its own.
By default, when **MoonShine** is installed, a base `MoonShineLayout` is added to the directory `app/MoonShine/Layouts`.
In `Layout`, everything related to the appearance of your pages, including navigation, is customized.

To add a section to the menu, you need to declare it via the `menu()` method in `Layout`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\MoonShine\Layouts;

use App\MoonShine\Resources\PostResource;

use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\Laravel\Resources\MoonShineUserResource;
use MoonShine\Laravel\Resources\MoonShineUserRoleResource;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;
// [tl! collapse:end]

final class MoonShineLayout extends AppLayout
{
    // ...

    protected function menu(): array
    {
        return [
            MenuGroup::make(__('moonshine::ui.resource.system'), [
                MenuItem::make(MoonShineUserResource::class),
                MenuItem::make(MoonShineUserRoleResource::class),
            ]),
            MenuItem::make(PostResource::class),
            // ...
        ];
    }
}
```

> [!TIP]
> You can learn about advanced `Layout` settings in the section [Layout](/docs/{{version}}/appearance/layout).

> [!TIP]
> You can learn about advanced `MenuManager` settings in the section [Menu](/docs/{{version}}/appearance/menu).

<a name="alias"></a>
## Alias

By default, the alias of the resource used in the `url` is generated based on the class name in `kebab-case`, for example:
`MoonShineUserResource` -> `moon-shine-user-resource`.

To change the `alias`, you can use the resource property `$alias` or the method `getAlias()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected ?string $alias = 'custom-alias';

    // ...
}
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    public function getAlias(): ?string
    {
        return 'custom-alias';
    }
}
```

<a name="current-element-model"></a>
## Current Element/Model

If the `resourceItem` parameter is present in the `url` of the detail or editing page, you can access the current element in the resource using the `getItem()` method.

```php
$this->getItem();
```

You can access the model through the `getModel()` method.

```php
$this->getModel();
```

<a name="modal-windows"></a>
## Modal Windows

You can add, edit, and view records directly on the listing page in a modal window.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = true;

    // ...
}
```

### Modal Modifiers

You can customize the appearance and behavior of modal windows in the resource by overriding modifier methods.

#### Create Modal

The `modifyCreateModal()` method allows you to modify the create modal window.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\UI\ModalContract;

protected function modifyCreateModal(ModalContract $modal): ModalContract
{
    return $modal->full();
}
```

#### Edit Modal

The `modifyEditModal()` method allows you to modify the edit modal window.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\UI\ModalContract;

protected function modifyEditModal(ModalContract $modal): ModalContract
{
    return $modal->full();
}
```

#### Detail Modal

The `modifyDetailModal()` method allows you to modify the detail modal window.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\UI\ModalContract;

protected function modifyDetailModal(ModalContract $modal): ModalContract
{
    return $modal->full();
}
```

#### Delete Modal

The `modifyDeleteModal()` method allows you to modify the delete confirmation modal.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\UI\ModalContract;

protected function modifyDeleteModal(ModalContract $modal): ModalContract
{
    return $modal->auto();
}
```

#### Mass Delete Modal

The `modifyMassDeleteModal()` method allows you to modify the mass delete confirmation modal.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\UI\ModalContract;

protected function modifyMassDeleteModal(ModalContract $modal): ModalContract
{
    return $modal->auto();
}
```

#### Filters OffCanvas

The `modifyFiltersOffCanvas()` method allows you to modify the filters off-canvas panel.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\UI\OffCanvasContract;

protected function modifyFiltersOffCanvas(OffCanvasContract $offCanvas): OffCanvasContract
{
    return $offCanvas->full()->autoClose(false);
}
```

> [!TIP]
> All modifier methods are applied to the corresponding modal windows and off-canvas panels, allowing you to flexibly customize their appearance and behavior.

<a name="redirects"></a>
## Redirects

By default, when creating and editing a record, a redirect to the form page is performed, but this behavior can be controlled.

Through a property in the resource:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Support\Enums\PageType;

protected ?PageType $redirectAfterSave = PageType::FORM;
```

Through methods:

```php
public function getRedirectAfterSave(): string
{
    return '/';
}
```

Redirect after deletion is also available:

```php
public function getRedirectAfterDelete(): string
{
    return $this->getIndexPageUrl();
}
```

<a name="active-actions"></a>
## Active Actions

Often, it is necessary to create a resource where the ability to delete, add, or edit is excluded.
This is not about authorization, but rather a global exclusion of these sections.
This can be done easily through the `activeActions()` method in the resource.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:5]
namespace App\MoonShine\Resources;

use MoonShine\Support\ListOf;
use MoonShine\Support\Enums\Action;
use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->except(Action::VIEW, Action::MASS_DELETE)
            // ->only(Action::VIEW)
        ;
    }
}
```

You can also create a new list, for example:
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\Enums\Action;
use MoonShine\Support\ListOf;

protected function activeActions(): ListOf
{
    return new ListOf(Action::class, [Action::VIEW, Action::UPDATE]);
}
```

<a name="lifecycle"></a>
## Lifecycle

`Resource` has several different methods to connect to various parts of its lifecycle. Let's walk through them:

<a name="on-load"></a>
### Active Resource

The `onLoad()` method allows integration at the moment when the resource is loaded and currently active.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    protected function onLoad(): void
    {
        // ...
    }
}
```

> [!TIP]
> Recipe: [Changing breadcrumbs from a resource](/docs/{{version}}/recipes/custom-breadcrumbs).

You can also attach a `trait` to the resource and within the `trait`, add a method according to the naming convention - `load{TraitName}` and use the trait to access the `onLoad` of the resource.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
namespace App\MoonShine\Resources;

use App\Traits\WithPermissions;
use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    use WithPermissions;

    // ...
}
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\Enums\Layer;
use MoonShine\Support\Enums\PageType;

trait WithPermissions
{
    protected function loadWithPermissions(): void
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

<a name="on-boot"></a>
### Creating an Instance

The `onBoot()` method allows integration at the moment when **MoonShine** is creating an instance of the resource within the system.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    protected function onBoot(): void
    {
        // ...
    }
}
```

You can also attach a `trait` to the resource and within the `trait`, add a method according to the naming convention - `boot{TraitName}` and use the trait to access the `onBoot()` of the resource.

<a name="assets"></a>
## Assets

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;

protected function onLoad(): void
{
    $this->getAssetManager()
        ->add(Css::make('/css/app.css'))
        ->append(Js::make('/js/app.js'));
}
```

<a name="response-modifiers"></a>
## Response modifiers

If the resource is in "async" mode, then you can modify the answer:

```php
use Symfony\Component\HttpFoundation\Response;
use MoonShine\Crud\JsonResponse;

public function modifyDestroyResponse(JsonResponse $response): JsonResponse
{
    return $response;
}

public function modifyMassDeleteResponse(JsonResponse $response): JsonResponse
{
    return $response;
}

public function modifySaveResponse(JsonResponse $response): JsonResponse
{
    return $response;
}

public function modifyErrorResponse(Response $response, Throwable $exception): Response
{
    return $response;
}
```

<a name="crud-operations-handlers"></a>
## CRUD operation handlers

You can change the logic of save, delete, and mass delete operations in `ModelResource` using `SaveHandler`, `DestroyHandler` and `MassDestroyHandler` attributes and your custom handlers.

The `$data` array, which has already passed through the `apply()` method of the form fields, is passed into the save operation handler.

Usage example:

```php
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Crud\Attributes\DestroyHandler;
use MoonShine\Crud\Attributes\MassDestroyHandler;
use MoonShine\Crud\Attributes\SaveHandler;

#[DestroyHandler(MoonShineUserRoleHandlers::class, 'destroy')]
#[MassDestroyHandler(MoonShineUserRoleHandlers::class, 'massDestroy')]
#[SaveHandler(MoonShineUserRoleHandlers::class, 'save')]
class MoonShineUserRoleResource extends ModelResource
{
//...
}
```

A class with methods for processing operations might look like this:

```php
final readonly class MoonShineUserRoleHandlers
{
    public function save(MoonshineUserRole $model, array $data): MoonshineUserRole
    {
        $model->fill($data);
        $model->save();

        return $model;
    }

    public function destroy(MoonshineUserRole $model): bool
    {
        return $model->delete();
    }

    public function massDestroy(array $ids): void
    {
        foreach ($ids as $id) {
            MoonshineUserRole::query()->whereKey($id)->delete();
        }
    }
}
```

You can also use handler classes instead of methods, in which case they must implement the `__invoke()` method:

```php
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Crud\Attributes\DestroyHandler;
use MoonShine\Crud\Attributes\MassDestroyHandler;
use MoonShine\Crud\Attributes\SaveHandler;

#[SaveHandler(MoonShineUserRoleSaveHandler::class)]
#[DestroyHandler(MoonShineUserRoleDestroyHandler::class)]
#[MassDestroyHandler(MoonShineUserRoleMassDestroyHandler::class)]
class MoonShineUserRoleResource extends ModelResource
{
//..
}
```

```php
final readonly class MoonShineUserRoleSaveHandler
{
    public function __invoke(MoonshineUserRole $model, array $data): MoonshineUserRole
    {
        $model->fill($data);
        $model->save();

        return $model;
    }
}
final readonly class MoonShineUserRoleDestroyHandler
{
    public function __invoke(MoonshineUserRole $model): bool
    {
        return $model->delete();
    }
}
final readonly class MoonShineUserRoleMassDestroyHandler
{
    public function __invoke(array $ids): void
    {
        foreach ($ids as $id) {
            MoonshineUserRole::query()->whereKey($id)->delete();
        }
    }
}
```
