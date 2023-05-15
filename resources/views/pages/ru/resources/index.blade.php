<x-page
    title="Основы"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#variables', 'label' => 'Основные свойства'],
            ['url' => '#create', 'label' => 'Создание'],
            ['url' => '#define', 'label' => 'Объявление'],
            ['url' => '#item', 'label' => 'Текущий элемент/модель'],
            ['url' => '#modal', 'label' => 'Модальные окна'],
            ['url' => '#after', 'label' => 'Переход после сохранения'],
            ['url' => '#simple-pagination', 'label' => 'Simple pagination'],
            ['url' => '#items-view', 'label' => 'Отображение элементов'],
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
    <code>MoonShine\MoonShine</code> и метода <code>menu</code>
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
            MoonShineUserResource::class, // Системный раздел с администраторами
            MoonShineUserRoleResource::class, // Системный раздел с ролями администраторов
            PostResource::class, // Наш новый раздел
        ]);
        // [tl! focus:end]
    }
}
</x-code>

<x-p>После разделы появятся в меню и будут доступны в панели</x-p>

<x-image theme="light" src="{{ asset('screenshots/menu.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/menu_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    О расширенных настройках можно узнать в разделе <x-link :link="route('moonshine.custom_page', 'advanced-menu')" ><code>Digging Deeper > Меню</code></x-link>
</x-moonshine::alert>

<x-sub-title id="item">Текущий элемент/модель</x-sub-title>

<x-p>В ресурсе вы имеете доступ к текущему элементу и модели через соответствующие методы</x-p>

<x-code language="php">
    $this->getItem();
</x-code>

<x-code language="php">
    $this->getModel();
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если элемента еще не существует (action create), то метод <code>getItem</code> вернет <code>NULL</code>
</x-moonshine::alert>

<x-sub-title id="modal">Модальные окна</x-sub-title>

<x-p>
    Возможность добавлять записи и редактировать прямо на странице со списком в модальном окне
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

<x-sub-title id="items-view">Отображение элементов</x-sub-title>

<x-p>
    Можно кастомизировать отображение списка элементов через свойство <code>itemsView</code>
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
    Или переопределив соответствующий метод <code>itemsView</code>
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
