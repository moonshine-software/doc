# Основы

- [Основы](#basics)
- [Создание раздела](#creating-a-section)
- [Основные свойства раздела](#basic-section-properties)
- [Объявление раздела в системе](#declaring-a-section-in-the-system)
- [Текущий элемент/модель](#current-elementmodel)
- [Модальные окна](#modal-windows)
- [Перенаправления](#redirects)
- [Активные действия](#active-actions)
- [Кнопки](#buttons)
- [Модификация](#modification)
- [Компоненты](#components)
- [Загрузка](#boot)

---

<a name="basics"></a>
## Основы

В сердце любой админ-панели лежат разделы для редактирования данных. **MoonShine** не является исключением и использует модели `Eloquent` для работы с базой данных, а для разделов используются стандартные ресурсные контроллеры и ресурсные маршруты Laravel.

Если бы вы разрабатывали самостоятельно, то создание ресурсных контроллеров и ресурсных маршрутов могло бы выглядеть так:

```php
php artisan make:controller Controller --resource
```

```php
Route::resource('resources', Controller::class);
```

Однако эту работу можно доверить админ-панели **MoonShine**, которая сгенерирует и объявит их самостоятельно.

`ModelResource` является основным компонентом для создания раздела в админ-панели при работе с базой данных.

<a name="creating-a-section"></a>
## Создание раздела

```php
php artisan moonshine:resource Post
```

- измените имя ресурса, если требуется
- выберите тип ресурса

При создании *ModelResource* доступно несколько вариантов:
- [Ресурс модели по умолчанию](https://moonshine-laravel.com/docs/resource/models-resources/resources-fields#default) - ресурс модели с общими полями
- [Отдельный ресурс модели](https://moonshine-laravel.com/docs/resource/models-resources/resources-fields#separate) - ресурс модели с разделением полей
- [Ресурс модели со страницами](https://moonshine-laravel.com/docs/resource/models-resources/resources-pages) - ресурс модели со страницами.

В результате будет создан класс `PostResource`, который станет основой нового раздела в панели. По умолчанию он располагается в директории `app/MoonShine/Resources`.  
MoonShine автоматически, на основе имени, свяжет ресурс с моделью `app/Models/Post`. Заголовок раздела также будет сгенерирован автоматически и будет "Posts".

Вы можете сразу указать привязку модели и заголовок раздела для команды:

```php
php artisan moonshine:resource Post --model=CustomPost --title="Articles"
```

```php
php artisan moonshine:resource Post --model="App\Models\CustomPost" --title="Articles"
```

<a name="basic-section-properties"></a>
## Основные свойства раздела

Основные параметры, которые можно изменить для ресурса, чтобы настроить его работу

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class; // Модель

    protected string $title = 'Posts'; // Заголовок раздела

    protected array $with = ['category']; // Жадная загрузка

    protected string $column = 'id'; // Поле для отображения значений в ссылках и хлебных крошках

    //...
}
```

![resource_paginate](https://moonshine-laravel.com/screenshots/resource_paginate.png)
![resource_paginate_dark](https://moonshine-laravel.com/screenshots/resource_paginate_dark.png)

<a name="declaring-a-section-in-the-system"></a>
## Объявление раздела в системе

Зарегистрировать ресурс в системе и сразу добавить ссылку на раздел в навигационное меню можно с помощью сервис-провайдера `MoonShineServiceProvider`.

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
> О расширенных настройках вы можете узнать в разделе [Меню](https://moonshine-laravel.com/docs/resource/menu/menu).

Если вам нужно только зарегистрировать ресурс в системе, не добавляя его в навигационное меню:

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
## Текущий элемент/модель

Если url страницы детального просмотра или редактирования содержит параметр `resourceItem`, то в ресурсе вы можете получить доступ к текущему элементу через метод `getItem()`.

```php
$this->getItem();
```

Вы можете получить доступ к модели через метод `getModel()`.

```php
$this->getModel();
```

<a name="modal-windows"></a>
## Модальные окна

Возможность добавления, редактирования и просмотра записей прямо на странице со списком в модальном окне.

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
## Перенаправления

По умолчанию при создании и редактировании записи выполняется редирект на страницу с формой, но этим поведением можно управлять.

```php
// Через свойство в ресурсе
protected ?PageType $redirectAfterSave = PageType::FORM;

// или через методы (также доступен редирект после удаления)

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
## Активные действия

Часто бывает, что необходимо создать ресурс, в котором будет исключена возможность удаления, или добавления, или редактирования. Причем речь идет не об авторизации, а о глобальном исключении этих разделов. Делается это предельно просто с помощью метода `getActiveActions` в ресурсе.

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
## Кнопки

По умолчанию на странице индекса ресурса модели есть только кнопка создания.  
Метод `actions()` позволяет добавить дополнительные [кнопки](https://moonshine-laravel.com/docs/resource/actionbutton/action_button).

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
#### Отображение

Вы также можете изменить отображение кнопок, отображать их в строке или в выпадающем меню для экономии места.

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
## Модификация

Для модификации основных компонентов страниц **IndexPage**, **FormPage** или **DetailPage** из ресурса можно переопределить соответствующие методы `modifyListComponent()`, `modifyFormComponent()` и `modifyDetailComponent()`.

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
## Компоненты

Лучший способ изменить компоненты страниц - это опубликовать страницы и взаимодействовать через них, но если вы хотите быстро добавить компоненты на страницы, то можете использовать методы ресурса `pageComponents`, `indexPageComponents`, `formPageComponents`, `detailPageComponents`.

```php
// или indexPageComponents/formPageComponents/detailPageComponents
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
> Компоненты будут добавлены в `bottomLayer`

<a name="boot"></a>
## Загрузка

Если вам нужно добавить логику в работу ресурса, когда он активен и загружен, то используйте метод `onBoot`.

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
> Рецепт: [Изменение хлебных крошек из ресурса](https://moonshine-laravel.com/docs/resource/recipes/recipes#custom-breadcrumbs).

Вы также можете подключить трейт к ресурсу и внутри трейта добавить метод по соглашению об именовании - `boot{TraitName}` и через трейт получить доступ к загрузке ресурса

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

