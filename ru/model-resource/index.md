# TODO (WIP)

- [ ] onBoot/onLoad с кейсами
- [ ] alias (uriKey)
- [ ] thead,tfoot,tbody
- [ ] cursorPaginate
- [ ] CrudResource

# Основы

- [Основы](#basics)
- [Создание](#creating-a-section)
- [Базовые свойства](#basic-section-properties)
- [Объявление в системе](#declaring-a-section-in-the-system)
- [Добавление в меню](#declaring-a-section-in-the-menu)
- [Current element/model](#current-elementmodel)
- [Modal windows](#modal-windows)
- [Redirects](#redirects)
- [Active actions](#active-actions)
- [Buttons](#buttons)
- [Modification](#modification)
- [Components](#components)
- [Boot](#boot)

<a name="basics"></a>
## Основы

`ModelResource` - расширяет `CrudResource` и предоставляет функциональность для работы с моделями Eloquent. Он обеспечивает основу для создания ресурсов, связанных с моделями базы данных. `ModelResource` предоставляет методы для выполнения CRUD-операций, управления отношениями, применения фильтров и многое другое.

> [!TIP]
> Вы также можете ознакомится с разделом [CrudResource](/docs/3.x/advanced/crud-resource).
> `CrudResource` это абстрактный класс предоставляющий базовый интерфейс для `CRUD` операций без привязки к хранилищу и типу данных

Под капотом `ModelResource` расширяет `CrudResource` и сразу включает возможность работы с `Eloquent`, если углублятся в детали MoonShine, то вы увидите все теже стандартные `Controller`, `Model` и `blade views`

Если бы вы разрабатывали самостоятельно, то создать ресурс контроллеры и ресурс маршруты можно следующим образом:

```php
php artisan make:controller Controller --resource
```

```php
Route::resource('resources', Controller::class);
```

Но эту работу можно поручить админ-панели `MoonShine`, которая будет их генерировать и объявлять самостоятельно.

`ModelResource` является основным компонентом для создания раздела в админ-панели при работе с базой данных.

<a name="creating-a-section"></a>
## Создание

```php
php artisan moonshine:resource Post
```

- измените название вашего ресурса, если требуется
- выберите тип ресурса

При создания `ModelResource` доступно несколько вариантов:

- [Default model resource](/docs/3.x/model-resource/fields) - с объявлением полей внутри методов ресурса (`indexFields`, `formFields`, `detailFields`)
- [Model resource with pages](/docs/3.x/model-resource/pages) - c публикацией страниц (`IndexPage`, `FormPage`, `DetailPage`)

В результате создастся класс `PostResource`, который будет основой нового раздела в панели.
Располагается он, по умолчанию, в директории `app/MoonShine/Resources`.
MoonShine автоматически, исходя из названия, привяжет ресурс к модели `app/Models/Post`.
Заголовок раздела так же сгенерируется автоматически и будет "Posts".

Можно сразу указать команде привязку к модели и заголовок раздела:

```php
php artisan moonshine:resource Post --model=CustomPost --title="Articles"
```

```php
php artisan moonshine:resource Post --model="App\Models\CustomPost" --title="Articles"
```

<a name="basic-section-properties"></a>
## Базовые свойства

Базовые параметры, которые можно менять у ресурса, чтобы кастомизировать его работу

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<Post>
 */
class PostResource extends ModelResource
{
    protected string $model = Post::class; // Модель

    protected string $title = 'Posts'; // Заголовок раздела

    protected array $with = ['category']; // Eager load

    protected string $column = 'id'; // Поле для отображения значений в связях и хлебных крошках 

    //...
}
```

![resource_paginate](https://moonshine-laravel.com/screenshots/resource_paginate.png)
![resource_paginate_dark](https://moonshine-laravel.com/screenshots/resource_paginate_dark.png)

<a name="declaring-a-section-in-the-system"></a>
## Объявление в системе

Ресурс автоматически регистрируется в `MoonShineServiceProvider` при вызове команды `php artisan moonshine:resource`.
Но если вы создаете раздел вручную, то вам необходимо самостоятельно его объявить в системе в `MoonShineServiceProvider`

```php
namespace App\Providers;

use App\MoonShine\Resources\ArticleResource;
use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\CommentResource;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Core\ResourceContract;
use MoonShine\Laravel\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return array<class-string<ResourceContract>>
     */
    protected function resources(): array
    {
        return [
            MoonShineUserResource::class,
            MoonShineUserRoleResource::class,
            ArticleResource::class,
            CategoryResource::class,
            CommentResource::class,
        ];
    }

    // ...
}
```

<a name="declaring-a-section-in-the-menu"></a>
## Добавление в меню

Все страницы в `MoonShine` имеют `Layout` и у каждой странцы он может быть свой, но по умолчанию при установке `MoonShine` добавляет базовый `MoonShineLayout` в директорию `app/MoonShine/Layouts`. В `Layout` кастомизируется все что отвечает за внешний вид ваших страниц и это касается также и навигации.

Чтобы добавить раздел в меню, необходимо объявить его через метод `menu()` по средствам `MenuManager`:

```php
namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\CompactLayout;
use MoonShine\Laravel\Resources\MoonShineUserResource;
use MoonShine\Laravel\Resources\MoonShineUserRoleResource;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\PostResource;

final class MoonShineLayout extends CompactLayout
{
    // ...

    protected function menu(): array
    {
        return [
            MenuGroup::make(static fn () => __('moonshine::ui.resource.system'), [
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.admins_title'),
                    MoonShineUserResource::class
                ),
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.role_title'),
                    MoonShineUserRoleResource::class
                ),
                MenuItem::make('Posts', PostResource::class),
            ]),
        ];
    }
```

> [!TIP]
> О расширенных настройках `Layout` можно узнать в разделе [Layout](/docs/3.x/appearance/layout).

> [!TIP]
> О расширенных настройках `MenuManager` можно узнать в разделе [Menu](/docs/3.x/appearance/menu).

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
