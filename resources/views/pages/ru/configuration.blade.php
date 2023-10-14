<x-page title="Конфигурация" :sectionMenu="[]">

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
        # По какому url будет доступна панель управления
        # Если оставить значение пустым, то панель будет доступна от /
        'prefix' => env('MOONSHINE_ROUTE_PREFIX', 'admin'), // [tl! focus]
        # Префикс формирования url для страниц
        'single_page_prefix' => 'page', // [tl! focus]
        # Начальный маршрут в админ-панели
        'index_route' => env('MOONSHINE_INDEX_ROUTE', 'moonshine.index'), // [tl! focus]
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

    'forms' => [ // [tl! focus]
        # форма аунтификации
        'login' => LoginForm::class // [tl! focus]
    ], // [tl! focus]

    'pages' => [ // [tl! focus]
        # Страница дашборда
        'dashboard' => '', // [tl! focus]
        # Страница профиля
        'profile' => ProfilePage::class // [tl! focus]
    ], // [tl! focus]

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
</x-page>
