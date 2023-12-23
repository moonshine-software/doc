<x-page
    title="Конфигурация"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#config', 'label' => 'Config'],
            ['url' => '#home-page', 'label' => 'Главная страница'],
        ]
    ]"
>

<x-sub-title id="config">Config</x-sub-title>

<x-code language="php">
use MoonShine\Exceptions\MoonShineNotFoundException;  // [tl! focus:start]
use MoonShine\Forms\LoginForm;
use MoonShine\Http\Middleware\Authenticate;
use MoonShine\Http\Middleware\SecurityHeadersMiddleware;
use MoonShine\Models\MoonshineUser;
use MoonShine\MoonShineLayout;
use MoonShine\Pages\ProfilePage; // [tl! focus:end]

return [ // [tl! focus]
    # Директория, где располагаются ресурсы
    'dir' => 'app/MoonShine', // [tl! focus]
    # При изменении директории необходимо поменять и namespace согласно psr-4
    'namespace' => 'App\MoonShine', // [tl! focus]

    # Заголовок админ-панели
    'title' => env('MOONSHINE_TITLE', 'MoonShine'), // [tl! focus]
    # Вы можете изменить логотип, указав путь (пример - /images/logo.svg)
    'logo' => env('MOONSHINE_LOGO'), // [tl! focus]
    'logo_small' => env('MOONSHINE_LOGO_SMALL'), // [tl! focus]

    'route' => [ // [tl! focus]
        # Если домен отличается от домена сайта
        'domain' => env('MOONSHINE_URL', ''),
        # По какому пути будет доступна панель управления
        # Если оставить значение пустым, то панель будет доступна от /
        'prefix' => env('MOONSHINE_ROUTE_PREFIX', 'admin'), // [tl! focus]
        # Имя роута главной страницы
        'index' => 'moonshine.index', // [tl! focus]
        # Префикс формирования url для страниц
        'single_page_prefix' => 'page', // [tl! focus]
        # Группы middlewares в панели
        'middlewares' => [  // [tl! focus]
            SecurityHeadersMiddleware::class, // [tl! focus]
        ], // [tl! focus]
        # Можно поменять исключение для 404 (для ModelNotFound нужно реализовать самостоятельно)
        'notFoundHandler' => MoonShineNotFoundException::class, // [tl! focus]
    ],

    # Если вы хотите заменить MoonshineUser на свою модель, то можно отключить дефолтные миграции
    'use_migrations' => true, // [tl! focus]
    # Вкл/Выкл уведомления
    'use_notifications' => true, // [tl! focus]

    # Class для рендеринга основного шаблона страницы
    'layout' => MoonShineLayout::class, // [tl! focus]

    # Filesystem Disk по умолчанию
    'disk' => 'public', // [tl! focus]

    'cache' => 'file', // [tl! focus]

    'forms' => [ // [tl! focus]
        # форма аутентификации
        'login' => LoginForm::class // [tl! focus]
    ], // [tl! focus]

    'pages' => [ // [tl! focus]
        # Страница дашборда, дефолтная страница создается при установке MoonShine
        'dashboard' => App\MoonShine\Pages\Dashboard::class, // [tl! focus]
        # Страница профиля
        'profile' => ProfilePage::class // [tl! focus]
    ], // [tl! focus]

    # Импорт и экспорт по умолчанию у ModelResource
    'model_resources' => [ // [tl! focus]
        'default_with_import' => true, // [tl! focus]
        'default_with_export' => true, // [tl! focus]
    ],  // [tl! focus]

    'auth' => [ // [tl! focus]
        # Вкл/Выкл аутентификацию. Если false, то панель будет доступна всем
        'enable' => true, // [tl! focus]
        'middleware' => Authenticate::class, // [tl! focus]
        'fields' => [ // [tl! focus:start]
            'username' => 'email',
            'password' => 'password',
            'name' => 'name',
            'avatar' => 'avatar',
        ], // [tl! focus:end]
        # Если используете собственный guard, provider
        'guard' => 'moonshine', // [tl! focus:start]
        'guards' => [
            'moonshine' => [
                'driver' => 'session',
                'provider' => 'moonshine',
            ],
        ],
        'providers' => [
            'moonshine' => [
                'driver' => 'eloquent',
                'model' => MoonshineUser::class,
            ],
        ], // [tl! focus:end]
    ], // [tl! focus]
    # Возможные варианты переводов
    'locales' => [ // [tl! focus:start]
        'en',
        'ru',
    ], // [tl! focus:end]

    'tinymce' => [ // [tl! focus]
        # Роут файлового менеджера, подробности в разделе Поля
        'file_manager' => false, // [tl! focus]
        'token' => env('MOONSHINE_TINYMCE_TOKEN', ''), // [tl! focus]
        'version' => env('MOONSHINE_TINYMCE_VERSION', '6'), // [tl! focus]
    ], // [tl! focus]

    # Аутентификация через соц. сети и socialite, перечисляем драйверы и указываем логотип
    'socialite' => [ // [tl! focus:start]
        // 'driver' => 'path_to_image_for_button'
    ], // [tl! focus:end]
]; // [tl! focus]
</x-code>

<x-p>
    Для базового использования достаточно отредактировать параметры указанные ниже:
</x-p>

<x-code language="php">
// ...

return [
    // ...

    'title' => env('MOONSHINE_TITLE', 'MoonShine'), // [tl! focus]
    'logo' => env('MOONSHINE_LOGO', ''), // [tl! focus]
    'logo_small' => env('MOONSHINE_LOGO_SMALL'), // [tl! focus]

    'route' => [
        'prefix' => env('MOONSHINE_ROUTE_PREFIX', 'admin'), // [tl! focus]
    ],

    // ...
];
</x-code>

<x-sub-title id="home-page">Главная страница</x-sub-title>

<x-p>
    Если необходимо переопределить главную страницу в админ-панели <strong>MoonShine</strong>,
    это можно сделать воспользовавшись статическим методом <code>home()</code> класса <em>MoonShine</em>
    в сервис провайдере <code>MoonShineServiceProvider</code>.
</x-p>

<x-code language="php">
home(string|Closure $homeClass)
</x-code>

<x-code language="php">
use App\MoonShine\Pages\CustomPage;
use App\MoonShine\Resources\PostResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    public function register(): void
    {
        moonshine()->home(CustomPage::class); // [tl! focus]
        // or
        moonshine()->home(PostResource::class); // [tl! focus]
        // or
        moonshine()->home(function () {
            return PostResource::class;
        }); // [tl! focus:-2]
    }

    //...

}
</x-code>

</x-page>
