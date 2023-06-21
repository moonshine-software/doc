<x-page
    title="Основы"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#variables', 'label' => 'Основные свойства'],
            ['url' => '#create', 'label' => 'Создание'],
            ['url' => '#define', 'label' => 'Объявление'],
            ['url' => '#item', 'label' => 'Текущий элемент/модель'],
            ['url' => '#routes', 'label' => 'Маршруты ресурса'],
            ['url' => '#modal', 'label' => 'Модальные окна'],
            ['url' => '#after', 'label' => 'Переход после сохранения'],
            ['url' => '#simple-pagination', 'label' => 'Simple pagination'],
            ['url' => '#disable-pagination', 'label' => 'Отключение пагинации'],
            ['url' => '#views', 'label' => 'Кастомизация отображений'],
        ]
    ]"
    :videos="[
        ['url' => 'https://www.youtube.com/embed/pHSaMeBjVDk', 'title' => 'Screencasts: Ресурсы и меню'],
        ['url' => 'https://www.youtube.com/embed/jMsH8hTkPI4', 'title' => 'Screencasts: Кастомизация'],
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Что есть административная панель? Само собой это разделы, основанные на данных из базы, на основе eloquent моделей.
</x-p>

<x-p>
    В основе MoonShine стандартные Laravel ресурс контроллеры и ресурс роуты

    <x-code language="shell">
        php artisan make:controller Controller --resource
    </x-code>

    <x-code language="php">
        Route::resources('resources', Controller::class);
    </x-code>

    Но система будет их генерировать и объявлять самостоятельно.
</x-p>

<x-p>
    Поэтому в основе ресурсов MoonShine (разделов админ-панели) eloquent модель.
</x-p>

<x-sub-title id="create">Создание раздела админ-панели</x-sub-title>

<x-code language="shell">
    php artisan moonshine:resource Post
</x-code>

<x-p>
    В результате будет создан Resource класс, который будет основой нового раздела в панели.
    Располагается он по умолчанию в директории <code>app/MoonShine/Resources/PostResource</code>.
    И будет автоматически привязан к модели <code>app/Models/Post</code>.
    Заголовок раздела останется с названием Posts.
</x-p>

<x-p>
    Можно изменить привязку к модели и заголовок раздела вместе с выполнением команды

    <x-code language="shell">
        php artisan moonshine:resource Post --model=CustomPost --title="Статьи"
    </x-code>

    <x-code language="shell">
        php artisan moonshine:resource Post --model="App\Models\CustomPost" --title="Статьи"
    </x-code>
</x-p>

<x-sub-title id="variables">Основные свойства раздела</x-sub-title>
<x-p>
    Основные параметры, которые можно менять у ресурса, чтобы кастомизировать его работу
</x-p>
<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Models\MoonshineUser;

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class; // Модель [tl! focus]

    public static string $title = 'Статьи'; // Название раздела [tl! focus]

    public static string $subTitle = 'Управление статьями'; // Текст под заголовком раздела [tl! focus]

    public static array $with = ['category']; // Eager load [tl! focus]

    public static bool $withPolicy = false; // Авторизация [tl! focus]

    public static string $orderField = 'id'; // Поле сортировки по умолчанию [tl! focus]

    public static string $orderType = 'DESC'; // Тип сортировки по умолчанию [tl! focus]

    public static int $itemsPerPage = 25; // Количество элементов на странице [tl! focus]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_paginate.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_paginate_dark.png') }}"></x-image>

<x-sub-title id="define">Объявление раздела в системе</x-sub-title>

<x-p>
    Добавляются новые ресурсы к системе в <code>service provider</code> с помощью singleton класса
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
    Для добавления ссылки на ресурс в навигационное меню, ресурс можно зарегистрировать используя метод <code>menu()</code>.
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
    О расширенных настройках можно узнать в разделе <x-link :link="route('moonshine.custom_page', 'advanced-menu')" ><code>Digging Deeper > Меню</code></x-link>.
</x-moonshine::alert>

<x-sub-title id="item">Текущий элемент/модель</x-sub-title>

<x-p>
    В ресурсе вы имеете доступ к текущему элементу и модели через соответствующие методы.
</x-p>

<x-code language="php">
    $this->getItem();
</x-code>

<x-code language="php">
    $this->getModel();
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если элемента еще не существует (action create), то метод <code>getItem()</code> вернет <code>NULL</code>.
</x-moonshine::alert>

<x-sub-title id="routes">Маршруты ресурса</x-sub-title>

<x-p>
    В MoonShine у ресурса для различных действий зарегистрировано множество маршрутов:
</x-p>

<x-code language="php">
$this->route('index'); // GET|HEAD - список записей
$this->route('create'); // GET|HEAD - создание новой записи
$this->route('store'); // POST - сохранение новой записи
$this->route('edit', $resourceItem); // GET|HEAD - редактирование записи
$this->route('update', $resourceItem); // PUT|PATCH - сохранение записи
$this->route('destroy', $resourceItem); // DELETE - удаление записи
$this->route('show', $resourceItem); // GET|HEAD - просмотр записи
$this->route('query-tag', $queryTag); // GET|HEAD - список записей с применением быстрого фильтра / тега
$this->route('update-column', $resourceItem); // PUT - сохранение поля записи
</x-code>

<x-p>
    Через метод <code>resolveRoutes()</code> можно добавить или переопределять роуты по умолчанию.
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
    Для доступа к маршруту вне ресурса можно следующим способом <code>(new Resource())->route('index')</code>.
</x-moonshine::alert>

<x-sub-title id="modal">Модальные окна</x-sub-title>

<x-p>
    Возможность добавлять, редактировать и просматривать записи прямо на странице со списком в модальном окне.
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

<x-sub-title id="after">Переход после сохранения</x-sub-title>

<x-p>
    После сохранения ресурса можно указать, по какому маршруту сделать переход:
    на страницу списка, детальную страницу или же на страницу редактирования.
</x-p>

<x-p>По умолчанию <code>index</code></x-p>

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
    Если вы не планируете отображать общее количество страниц, воспользуйтесь <code>Simple Pagination</code>.
    Это позволит избежать дополнительных запросов на общее количество записей в базе данных.
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

<x-sub-title id="disable-pagination">Отключение пагинации</x-sub-title>

<x-p>
    Если вы не планируете использовать разбиение на страницы, то его можно отключить.
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

<x-sub-title id="views">Кастомизация отображений</x-sub-title>

<x-p>
    Можно кастомизировать отображение списка и формы через
    свойства <code>itemsView</code>, <code>formView</code> и <code>detailView</code>.
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
    Или переопределив соответствующие методы
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
