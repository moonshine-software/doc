---
video: https://youtu.be/bcFOkXuPSRk?si=LIXgfO1LpjfqwWyR
---

# Основы

- [Основы](#basics)
- [Создание](#creating)
- [Базовые свойства](#basic-properties)
- [Объявление в системе](#declaring-in-the-system)
- [Автозагрузка](#autoloading)
- [Сортировка](#sorting)
- [Пагинация](#pagination)
- [Асинхронный режим](#is-async)
- [Добавление в меню](#adding-to-the-menu)
- [Alias](#alias)
- [Текущий элемент/модель](#current-element-model)
- [Модальные окна](#modal-windows)
- [Редиректы](#redirects)
- [Активные действия](#active-actions)
- [Жизненный цикл](#lifecycle)
    - [Активный ресурс](#on-load)
    - [Создание экземпляра](#on-boot)
- [Assets](#assets)
- [Response модификаторы](#response-modifiers)
- [Обработчики CRUD-операций](#crud-operations-handlers)

---

<a name="basics"></a>
## Основы

`ModelResource` расширяет `CrudResource` и предоставляет функциональность для работы с моделями Eloquent.
Он обеспечивает основу для создания ресурсов, связанных с моделями базы данных.
`ModelResource` предоставляет методы для выполнения CRUD-операций, управления отношениями, применения фильтров и многое другое.

> [!TIP]
> Вы также можете ознакомиться с разделом [CrudResource](/docs/{{version}}/advanced/crud-resource).
> `CrudResource` - это абстрактный класс предоставляющий базовый интерфейс для `CRUD` операций без привязки к хранилищу и типу данных.

Под капотом, `ModelResource` расширяет `CrudResource` и сразу включает возможность работы с Eloquent.
Если углубляться в детали **MoonShine**, то вы увидите все те же стандартные Controller, Model и Blade views.

Если бы вы разрабатывали самостоятельно, то создать ресурс контроллеры и ресурс маршруты можно следующим образом:

```shell
php artisan make:controller Controller --resource
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use Illuminate\Support\Facades\Route;

Route::resource('resources', Controller::class);
```

Но эту работу можно поручить админ-панели **MoonShine**, которая будет их генерировать и объявлять самостоятельно.

`ModelResource` является основным компонентом для создания раздела в админ-панели при работе с базой данных.

<a name="creating"></a>
## Создание

```shell
php artisan moonshine:resource Post
```

> [!NOTE]
> Для более подробной информации обратитесь к разделу [Команды](/docs/{{version}}/advanced/commands#resource).

<a name="basic-properties"></a>
## Базовые свойства

Базовые параметры, которые можно менять у ресурса, чтобы кастомизировать его работу.

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
    // Модель
    protected string $model = Post::class;

    // Заголовок раздела
    protected string $title = 'Posts';

    // Eager load
    protected array $with = ['category'];

    // Поле для отображения значений в связях и хлебных крошках
    protected string $column = 'id';

    // ...
}
```

![resource_paginate](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_paginate.png#light)
![resource_paginate_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_paginate_dark.png#dark)

<a name="declaring-in-the-system"></a>
## Объявление в системе

Ресурс автоматически регистрируется в `MoonShineServiceProvider` при вызове команды `php artisan moonshine:resource`.
Но если вы создаете раздел вручную, то вам необходимо самостоятельно его объявить в системе в `MoonShineServiceProvider`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\Providers;

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
## Автозагрузка

В **MoonShine** также доступна автозагрузка страниц и ресурсов.
Она выключена по-умолчанию и для активации нужно вызвать метод `autoload()` в `MoonShineServiceProvider` вместо указания ссылок на страницы и ресурсы.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\Providers;

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

При деплое проекта на продакшен в Laravel 11+ [рекомендуется](https://laravel.com/docs/11.x/packages#optimize-commands) вызывать консольную команду `php artisan optimize`.
Помимо её основных функций, она также выполнит кэширование ресурсов **MoonShine**.

При использовании Laravel 10 необходимо вручную вызывать консольную команду `php artisan moonshine:optimize` для оптимизации процесса инициализации админ панели.

Очистить кэш панели можно как командой `php artisan optimize:clear` в Laravel 11,
так и прямым вызовом консольной команды `php artisan moonshine:optimize-clear`.

> [!WARNING]
> Если после создания классов приложение их не видит - обновите кэш композера командой `composer dump-autoload`.

<a name="sorting"></a>
## Сортировка

По умолчанию записи в таблице ресурса сортируются по полю `id` в порядке убывания.
Вы можете изменить сортировку с помощью свойств `$sortColumn` и `$sortDirection`.

```php filename:PostResource.php
protected string $sortColumn = 'created_at';

protected string $sortDirection = 'DESC';
```

<a name="pagination"></a>
## Пагинация

По умолчанию **MoonShine** использует стандартную пагинацию Laravel.
Вы можете переключиться на cursor pagination или simple pagination с помощью свойств `$cursorPaginate` и `$simplePaginate`.

```php filename:PostResource.php
protected bool $cursorPaginate = true;
```

```php filename:PostResource.php
protected bool $simplePaginate = true;
```

> [!NOTE]
> Подробнее о типах пагинации можно узнать в [документации Laravel](https://laravel.com/docs/pagination).

<a name="is-async"></a>
## Асинхронный режим

По умолчанию в ресурсе включен "Асинхронный режим".
Чтобы его выключить, переопределите свойство `$isAsync` в ресурсе или на отдельных CRUD страницах.

```php filename:PostIndexPage.php
protected bool $isAsync = false;
```

> [!TIP]
> Подробнее об асинхронной загрузке таблицы можно узнать в разделе [TableBuilder](/docs/{{version}}/components/table-builder#async-loading).

> [!TIP]
> Подробнее об асинхронной отправке форм можно узнать в разделе [FormBuilder](/docs/{{version}}/components/form-builder#asynchronous-mode).

<a name="adding-to-the-menu"></a>
## Добавление в меню

Все страницы в **MoonShine** имеют `Layout` и у каждой страницы он может быть свой.
По умолчанию при установке **MoonShine** добавляет базовый `MoonShineLayout` в директорию `app/MoonShine/Layouts`.
В `Layout` кастомизируется всё, что отвечает за внешний вид ваших страниц и это касается также и навигации.

Чтобы добавить раздел в меню, необходимо объявить его через метод `menu()` в `Layout`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem; // [tl! collapse:end]

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
> О расширенных настройках `Layout` можно узнать в разделе [Layout](/docs/{{version}}/appearance/layout).

> [!TIP]
> О расширенных настройках `MenuManager` можно узнать в разделе [Menu](/docs/{{version}}/appearance/menu).

<a name="alias"></a>
## Alias

По умолчанию alias ресурса, который используется в `url`, генерируется на основе наименования класс в `kebab-case`, например:
`MoonShineUserResource` -> `moon-shine-user-resource`.

Для того чтобы изменить `alias`, можно воспользоваться свойством ресурса `$alias` или методом `getAlias()`.

```php
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
## Текущий элемент/модель

Если в `url` детальной страницы или страницы редактирования присутствует параметр `resourceItem`,
то в ресурсе вы можете получить доступ к текущему элементу через метод `getItem()`.

```php
$this->getItem();
```

Через метод `getModel()` можно получить доступ к модели.

```php
$this->getModel();
```

<a name="modal-windows"></a>
## Модальные окна

Вы можете добавлять, редактировать и просматривать записи прямо на странице со списком в модальном окне.

```php
class PostResource extends ModelResource
{
    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = true;

    // ...
}
```

### Модификаторы модальных окон

Вы можете настраивать внешний вид и поведение модальных окон в ресурсе, переопределив методы-модификаторы.

#### Create Modal

Метод `modifyCreateModal()` позволяет изменить модальное окно создания записи.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\ModalContract;

protected function modifyCreateModal(ModalContract $modal): ModalContract
{
    return $modal->full();
}
```

#### Edit Modal

Метод `modifyEditModal()` позволяет изменить модальное окно редактирования записи.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\ModalContract;

protected function modifyEditModal(ModalContract $modal): ModalContract
{
    return $modal->full();
}
```

#### Detail Modal

Метод `modifyDetailModal()` позволяет изменить модальное окно детального просмотра.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\ModalContract;

protected function modifyDetailModal(ModalContract $modal): ModalContract
{
    return $modal->full();
}
```

#### Delete Modal

Метод `modifyDeleteModal()` позволяет изменить модальное окно удаления записи.

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

Метод `modifyMassDeleteModal()` позволяет изменить модальное окно массового удаления.

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

Метод `modifyFiltersOffCanvas()` позволяет изменить боковую панель фильтров.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\OffCanvasContract;

protected function modifyFiltersOffCanvas(OffCanvasContract $offCanvas): OffCanvasContract
{
    return $offCanvas->full()->autoClose(false);
}
```

> [!TIP]
> Все методы модификаторов применяются к соответствующим модальным окнам и боковым панелям, позволяя гибко настроить их внешний вид и поведение.

<a name="redirects"></a>
## Редиректы

По умолчанию при создании и редактировании записи осуществляется редирект на страницу с формой, но это поведение можно контролировать.

Через свойство в ресурсе:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Support\Enums\PageType;

protected ?PageType $redirectAfterSave = PageType::FORM;
```

Через метод:

```php
public function getRedirectAfterSave(): string
{
    return '/';
}
```

Также доступен редирект после удаления:

```php
public function getRedirectAfterDelete(): string
{
    return $this->getIndexPageUrl();
}
```

<a name="active-actions"></a>
## Активные действия

Часто бывает, что необходимо создать ресурс, в котором будет исключена возможность удалять, или добавлять, или редактировать.
И здесь речь не об авторизации, а о глобальном исключении этих разделов.
Делается это крайне просто за счет метода `activeActions()` в ресурсе.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\Enums\Action;
use MoonShine\Support\ListOf;

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

Также можно просто создать новый список, например:
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
## Жизненный цикл

`Resource` имеет несколько различных методов подключения к различным частям своего жизненного цикла. Давайте пройдемся по ним:

<a name="on-load"></a>
### Активный ресурс

Метод `onLoad()` дает возможность интегрироваться в момент когда ресурс загружен и в данный момент является активным.

```php
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
> Рецепт: [Изменение breadcrumbs из ресурса](/docs/{{version}}/recipes/custom-breadcrumbs).

Вы также можете подключить `trait` к ресурсу и внутри `trait` добавить метод согласно конвенции наименований - `load{TraitName}`
и через трейт обратиться к `onLoad()` ресурса.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use App\Traits\WithPermissions;

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
### Создание экземпляра

Метод `onBoot()` дает возможность интегрироваться в момент когда **MoonShine** создает экземпляр ресурса в системе.

```php
class PostResource extends ModelResource
{
    // ...

    protected function onBoot(): void
    {
        // ...
    }
}
```

Вы также можете подключить `trait` к ресурсу и внутри `trait` добавить метод согласно конвенции наименований - `boot{TraitName}`
и через трейт обратиться к `onBoot()` ресурса.

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
## Response модификаторы

Если ресурс в режиме "async", то вы можете модифицировать ответ:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
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
## Обработчики CRUD-операций

Вы можете изменить логику операций сохранения, удаления и массового удаления записей в `ModelResource`
с помощью своих обработчиков и атрибутов `SaveHandler`, `DestroyHandler` и `MassDestroyHandler`.

В обработчик операции сохранения прокидывается массив `$data`, который уже прошёл через метод `apply()` у полей формы.

Пример использования:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\Crud\Attributes\DestroyHandler;
use MoonShine\Crud\Attributes\MassDestroyHandler;
use MoonShine\Crud\Attributes\SaveHandler;

#[DestroyHandler(MoonShineUserRoleHandlers::class, 'destroy')]
#[MassDestroyHandler(MoonShineUserRoleHandlers::class, 'massDestroy')]
#[SaveHandler(MoonShineUserRoleHandlers::class, 'save')]
class MoonShineUserRoleResource extends ModelResource
{
    // ...
}
```

Класс с методами для обработки операций может выглядеть так:

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

Вы также можете использовать классы-обработчики вместо методов — в этом случае они должны реализовывать метод `__invoke()`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\Crud\Attributes\DestroyHandler;
use MoonShine\Crud\Attributes\MassDestroyHandler;
use MoonShine\Crud\Attributes\SaveHandler;

#[SaveHandler(MoonShineUserRoleSaveHandler::class)]
#[DestroyHandler(MoonShineUserRoleDestroyHandler::class)]
#[MassDestroyHandler(MoonShineUserRoleMassDestroyHandler::class)]
class MoonShineUserRoleResource extends ModelResource
{
    // ...
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
