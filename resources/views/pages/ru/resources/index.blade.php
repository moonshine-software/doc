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
            ['url' => '#simple-pagination', 'label' => 'Simple pagination'],
            ['url' => '#disable-pagination', 'label' => 'Отключение пагинации'],
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
    <ul>
        <li>- измените название вашего ресурса, если требуется</li>
        <li>- выберите тип ресурса <em>Default model resource</em></li>
    </ul>
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

    protected string $sortColumn = ''; // Поле сортировки по умолчанию [tl! focus]

    protected string $sortDirection = 'DESC'; // Тип сортировки по умолчанию [tl! focus]

    protected int $itemsPerPage = 25; // Количество элементов на странице [tl! focus]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_paginate.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_paginate_dark.png') }}"></x-image>

<x-sub-title id="define">Объявление раздела в системе</x-sub-title>

<x-p>
    Зарегистрировать ресурс в системе и сразу добавить ссылку на раздел в навигационное меню
    можно через сервис провайдере <code>MoonShineServiceProvider</code>.
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

<x-image theme="light" src="{{ asset('screenshots/menu.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/menu_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    О расширенных настройках можно узнать в разделе
    <x-link :link="route('moonshine.custom_page', 'advanced-menu')" ><code>Digging Deeper > Меню</code></x-link>.
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

<x-sub-title id="simple-pagination">Simple pagination</x-sub-title>

<x-p>
    Если вы не планируете отображать общее количество страниц, воспользуйтесь <code>Simple Pagination</code>.
    Это позволит избежать дополнительных запросов на общее количество записей в базе данных.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $simplePaginate = true; // [tl! focus]

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
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $usePagination = false; // [tl! focus]

    // ...
}
</x-code>

</x-page>
