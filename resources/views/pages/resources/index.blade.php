<x-page title="Основы" :sectionMenu="[
    'Разделы' => [
        ['url' => '#variables', 'label' => 'Основные свойства'],
        ['url' => '#create', 'label' => 'Создание'],
        ['url' => '#define', 'label' => 'Объявление'],
    ]
]">

<x-p>
    Что есть административная панель? Само собой это разделы, основанные на данных из базы, на основе eloquent моделей.
</x-p>

<x-p>
    В основе moonShine стандартные Laravel ресурс контроллеры и ресурс роуты

    <x-code language="shell">
        php artisan make:controller Controller --resource
    </x-code>

    <x-code language="php">
        Route::resources('resources', Controller::class);
    </x-code>

    Но система будет их генерировать и объявлять самостоятельно.
</x-p>

<x-p>
    Поэтому в основе ресурсов moonShine (разделов админ. панели) eloquent модель.
</x-p>

<x-sub-title id="create">Создание раздела админ. панели</x-sub-title>

<x-code language="shell">
    php artisan moonshine:resource Post
</x-code>

<x-p>
    В результате будет создан Resource класс, который будет основой нового раздела в панели.
    Располагается он по умолчанию в директории <code>app/MoonShine/Resources/PostResource</code>.
    И будет автоматически привязан к моделе <code>app/Models/Post</code>.
    Заголовок раздела останется с названием Post.
</x-p>

<x-p>
    Можно изменить привязку к модели и заголовок раздела вместе с выполнением команды
    <x-code language="shell">
        php artisan moonshine:resource Post --model=App\Models\CustomPost --title="Статьи"
    </x-code>
</x-p>

<x-sub-title id="variables">Основные свойства раздела</x-sub-title>
<x-p>
    Основные параметры, которые можно менять у ресурса, чтобы кастомизировать его работу
</x-p>
<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;

class PostResource extends BaseResource
{
    public static string $model = App\Models\Post::class; // Модель [tl! focus]

    public static string $title = 'Статьи'; // Название раздела [tl! focus]

    public static array $with = ['category']; // Eager load [tl! focus]

    public static bool $withPolicy = false; // Eager load [tl! focus]

    public static string $orderField = 'id'; // Поле сортировки по умолчанию [tl! focus]

    public static string $orderType = 'DESC'; // Тип сортировки по умолчани/ [tl! focus]

    public static int $itemsPerPage = 25; // Количество элементов на странице [tl! focus]

    //...
}
</x-code>

<x-sub-title id="define">Объявление раздела в системе</x-sub-title>

<x-p>
    Добавляются новые ресурсы к системе в <code>service provider</code> с помощью singleton класса
    <code>Leeto\MoonShine\MoonShine</code> и метода <code>registerResources</code>
</x-p>
<x-code language="php">
namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

use Leeto\MoonShine\MoonShine;

use Leeto\MoonShine\Resources\MoonShineUserResource; // [tl! focus]
use Leeto\MoonShine\Resources\MoonShineUserRoleResource; // [tl! focus]
use App\MoonShine\Resources\PostResource; // [tl! focus]

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        Model::preventLazyLoading(!app()->isProduction());

        // [tl! focus:start]
        app(MoonShine::class)->registerResources([
            MoonShineUserResource::class, // Системный раздел с администраторами
            MoonShineUserRoleResource::class, // Системный раздел с ролями администраторов
            PostResource::class, // Наш новый раздел
        ]);
        // [tl! focus:end]
    }
}
</x-code>

<x-alert>
    После разделы появятся в меню и будут доступны в панели
</x-alert>

<x-image src="{{ asset('screenshots/main.png') }}"></x-image>

<x-next href="{{ route('section', 'resources-fields') }}">Поля</x-next>

</x-page>



