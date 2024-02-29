<x-page
    title="Основы"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#create', 'label' => 'Создание'],
            ['url' => '#variables', 'label' => 'Основные свойства'],
            ['url' => '#define', 'label' => 'Объявление'],
            ['url' => '#item', 'label' => 'Текущий элемент/модель'],
            ['url' => '#modal', 'label' => 'Модальные окна'],
            ['url' => '#redirects', 'label' => 'Редиректы'],
            ['url' => '#active_actions', 'label' => 'Активные действия'],
            ['url' => '#components', 'label' => 'Компоненты'],
            ['url' => '#boot', 'label' => 'Boot'],
        ]
    ]"
    :videos="[]"
>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    В основе любой админ-панели лежат разделы для редактирования данных.
    <strong>MoonShine</strong> не является исключением в этом
    и для работы с базой данных использует <code>Eloquent</code> модели,
    а для разделов стандартные Laravel ресурс контроллеры и ресурс маршруты.
</x-p>

<x-p>
    Если бы вы разрабатывали самостоятельно, то создать ресурс контроллеры и ресурс
    маршруты можно следующим образом:
</x-p>

<x-code language="shell">
    php artisan make:controller Controller --resource
</x-code>

<x-code language="php">
    Route::resources('resources', Controller::class);
</x-code>

<x-p>
    Но эту работу можно поручить админ-панели <strong>MoonShine</strong>,
    которая будет их генерировать и объявлять самостоятельно.
</x-p>

<x-p>
    <code>ModelResource</code> является основным компонентом для создания раздела
    в админ-панели при работе с базой данных.
</x-p>

<x-sub-title id="create">Создание раздела</x-sub-title>

<x-code language="shell">
    php artisan moonshine:resource Post
</x-code>

<x-p>
    <x-ul
        :items="[
            'измените название вашего ресурса, если требуется',
            'выберите тип ресурса',
        ]"
    />
</x-p>

<x-p>
    При создания <em>ModelResource</em> доступно несколько вариантов:
    <x-ul>
        <li>
            <x-link :link="to_page('resources-fields') . '#default'" ><strong>Default model resource</strong></x-link>
            - ресурс модели с общими полями
        </li>
        <li>
            <x-link :link="to_page('resources-fields') . '#separate'" ><strong>Separate model resource</strong></x-link>
            - ресурс модели с разделением полей
        </li>
        <li>
            <x-link :link="to_page('resources-pages')" ><strong>Model resource with pages</strong></x-link>
            - ресурс модели со страницами.
        </li>
    </x-ul>
</x-p>

<x-p>
    В результате создастся класс <code>PostResource</code>, который будет основой нового раздела в панели.<br />
    Располагается он, по умолчанию, в директории <code>app/MoonShine/Resources</code>.<br />
    MoonShine автоматически, исходя из названия, привяжет ресурс к модели <code>app/Models/Post</code>.<br />
    Заголовок раздела так же сгенерируется автоматически и будет "Posts".
</x-p>

<x-p>
    Можно сразу указать команде привязку к модели и заголовок раздела:
</x-p>

<x-code language="shell">
    php artisan moonshine:resource Post --model=CustomPost --title="Статьи"
</x-code>

<x-code language="shell">
    php artisan moonshine:resource Post --model="App\Models\CustomPost" --title="Статьи"
</x-code>

<x-sub-title id="variables">Основные свойства раздела</x-sub-title>

<x-p>
    Основные параметры, которые можно менять у ресурса, чтобы кастомизировать его работу
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class; // Модель [tl! focus]

    protected string $title = 'Posts'; // Название раздела [tl! focus]

    protected array $with = ['category']; // Eager load [tl! focus]

    protected string $column = 'id'; // Поле для отображения значений в связях и хлебных крошках [tl! focus]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_paginate.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_paginate_dark.png') }}"></x-image>

<x-sub-title id="define">Объявление раздела в системе</x-sub-title>

<x-p>
    Зарегистрировать ресурс в системе и сразу добавить ссылку на раздел в навигационное меню
    можно через сервис провайдер <code>MoonShineServiceProvider</code>.
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
    О расширенных настройках можно узнать в разделе
    <x-link :link="to_page('menu')" ><code>Меню</code></x-link>.
</x-moonshine::alert>

<x-p>
    Если вам необходимо только зарегистрировать ресурс в системе без добавления в навигационное меню:
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

<x-sub-title id="item">Текущий элемент/модель</x-sub-title>

<x-p>
    Если в url детальной страницы или страницы редактирования присутствует параметр <code>resourceItem</code>,
    то в ресурсе вы можете получить доступ к текущему элементу через метод <code>getItem()</code>.
</x-p>

<x-code language="php">
$this->getItem();
</x-code>

<x-p>
    Через метод <code>getModel()</code> можно получить доступ к модели.
</x-p>

<x-code language="php">
    $this->getModel();
</x-code>

<x-sub-title id="modal">Модальные окна</x-sub-title>

<x-p>
    Возможность добавлять, редактировать и просматривать записи прямо на странице со списком в модальном окне.
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

<x-sub-title id="redirects">Редиректы</x-sub-title>

<x-p>
    По умолчанию при создании и редактировании записи осуществляется редирект на страницу с формой,
    но это поведение можно контролировать
</x-p>

<x-code>
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
</x-code>

<x-sub-title id="active_actions">Активные действия</x-sub-title>

<x-p>
    Часто бывает, что необходимо создать ресурс, в котором будет исключена возможность удалять,
    или добавлять, или редактировать. И здесь речь не об авторизации, а о глобальном исключении этих разделов.
    Делается это крайне просто за счет метода <code>getActiveActions</code> в ресурсе
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

<x-sub-title id="components">Components</x-sub-title>

<x-p>
    Лучший способ изменять компоненты страниц это опубликовать страницы
    и взаимодействовать через них, но если вы хотите быстро добавить компоненты на страницы,
    то можете воспользоваться методами ресурса <code>pageComponents</code>,
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
            'My Modal',
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
    Компоненты будут добавлены в <code>bottomLayer</code>
</x-moonshine::alert>

<x-sub-title id="boot">Boot</x-sub-title>

<x-p>
    Если Вам необходимо добавить логику в работу ресурса в момент когда он активен и загружен,
    то воспользуйтесь методом <code>onBoot</code>
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
    Рецепт:
    <x-link link="{{ to_page('recipes') }}#custom-breadcrumbs">
        Изменение breadcrumbs из ресурса
    </x-link>.
</x-moonshine::alert>

<x-p>
    Вы также можете подключить trait к ресурсу и внутри trait добавить метод согласно конвенции наименований -
    boot{TraitName} и через трейт обратится к boot ресурса
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
