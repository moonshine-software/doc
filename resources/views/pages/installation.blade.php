<x-page title="Установка" :sectionMenu="[
    'Разделы' => [
        ['url' => '#requirements', 'label' => 'Требования'],
        ['url' => '#composer', 'label' => 'Composer'],
        ['url' => '#install', 'label' => 'Установка'],
        ['url' => '#config', 'label' => 'Конфигурация'],
    ]
]">

<x-sub-title id="requirements">Требования</x-sub-title>

<x-p>
    Для использования moonShine на своём проекте необходимо выполнение следующих требований перед установкой:
</x-p>

<x-ul :items="['php >=8.0', 'laravel >= 9.0', 'composer']"></x-ul>
<x-sub-title id="composer">Composer</x-sub-title>

<x-code language="shell">
    composer require lee-to/moonshine
</x-code>

<x-sub-title id="install">Установка</x-sub-title>

<x-p>
    1. Для начала необходимо опубликовать все ресурсы административной панели, а именно файл с конфигурацией, миграции, локализации и т.д. Для этого выполнить команду
</x-p>

<x-code language="shell">
    php artisan vendor:publish --provider="Leeto\MoonShine\Providers\MoonShineServiceProvider"
</x-code>

<x-alert color="bg-darkblue">
    После выполнения будет добавлен <code>config/moonshine.php</code> с основными настройками.
    <x-link link="#config">Подробнее о config файле</x-link>
</x-alert>

<x-p>
    2. Предустановка директорий административной панели
</x-p>

<x-code language="shell">
    php artisan moonshine:install
</x-code>

<x-p>
    После выполнения будут добавлены основные директории с административной панелью на основе
    параметра <code>dir</code> в <code>config/moonshine.php</code>
</x-p>

<x-alert color="bg-darkblue">
    По умолчанию это <code>app/Moonshine</code>. Где также будет основная директория с разделами админ. панели <code>app/MoonShine/Resources</code>.
    <x-link link="{{ route('section', 'resources') }}">Подробнее о Resources</x-link>
</x-alert>

<x-p>
    3. Выполнить миграции и создать необходимые для работы административной панели таблицы
</x-p>

<x-code language="shell">
    php artisan migrate
</x-code>

<x-ul :items="['moonshine_users', 'moonshine_user_roles', 'moonshine_change_logs']"></x-ul>

<x-p>
    4. Ну и само собой необходимо создать администратора
</x-p>

<x-code language="shell">
    php artisan moonshine:user
</x-code>

<x-sub-title id="config">Конфигурация</x-sub-title>

<x-code language="php">
// [tl! collapse:start]
use Leeto\MoonShine\Controllers\MoonShineDashboardController;
use Leeto\MoonShine\Models\MoonshineUser;
// [tl! collapse:end]

return [
    'dir' => 'app/MoonShine', // Директория где будет располагаться админ. панель в вашем проекте
    'namespace' => 'App\\MoonShine', // Если меняется директория то также необходимо изменить namespace

    'title' => env('MOONSHINE_TITLE', 'MoonShine'),
	'logo' => env('MOONSHINE_LOGO', ''),

    'route' => [
        'prefix' => env('MOONSHINE_ROUTE_PREFIX', 'moonshine'), // Route префикс
        'middleware' => ['web', 'moonshine'],
    ],

    'auth' => [
        'controller' => MoonShineDashboardController::class, // Контроллер по работе с аутентификацией (login, logout)
        'guard' => 'moonshine', // Guard аутентификации
        'guards' => [
            'moonshine' => [
                'driver'   => 'session',
                'provider' => 'moonshine',
            ],
        ],
        'providers' => [
            'moonshine' => [
                'driver' => 'eloquent',
                'model'  => MoonshineUser::class,
            ],
        ],
    ],

    'extensions' => [
        //
    ],
];
</x-code>

<x-p>
    В 99% случаев изменять под себя нужно следующие параметры
</x-p>

<x-code language="php">
return [
    'title' => env('MOONSHINE_TITLE', 'MoonShine'), // [tl! focus]
    'logo' => env('MOONSHINE_LOGO', ''), // [tl! focus]

    'route' => [
        'prefix' => env('MOONSHINE_ROUTE_PREFIX', 'moonshine'), // [tl! focus]
    ],
</x-code>

<x-p>
    Отлично! Теперь можно создавать и регистрировать разделы будущей админ. панели и приступать к работе!
</x-p>

<x-next href="{{ route('section', 'resources-index') }}">Ресурсы</x-next>

</x-page>