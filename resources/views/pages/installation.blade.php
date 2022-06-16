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
    composer require lee-to/moonshine -W
</x-code>

<x-sub-title id="install">Установка</x-sub-title>

<x-code language="shell">
    php artisan moonshine:install
</x-code>

<x-alert color="bg-darkblue">
    После выполнения будет добавлен <code>config/moonshine.php</code> с основными настройками.
    <x-link link="#config">Подробнее о config файле</x-link>
</x-alert>

<x-p>
    Также будет добавлена директория с административной панелью и ресурсами - app/MoonShine.
    <x-link link="{{ route('section', 'resources') }}">Подробнее о Resources</x-link>
</x-p>

<x-p>
    При установке добавятся новые таблицы
</x-p>

<x-ul :items="['moonshine_users', 'moonshine_user_roles', 'moonshine_change_logs']"></x-ul>

<x-sub-title>
    Создание администратора
</x-sub-title>

<x-code language="shell">
    php artisan moonshine:user
</x-code>

<x-sub-title id="config">Конфигурация</x-sub-title>

<x-code language="php">
use Leeto\MoonShine\Models\MoonshineUser;

return [
    'title' => env('MOONSHINE_TITLE', 'MoonShine'),
	'logo' => env('MOONSHINE_LOGO', ''),

    'route' => [
        'prefix' => env('MOONSHINE_ROUTE_PREFIX', 'moonshine'), // Route префикс
        'middleware' => ['web', 'moonshine'],
    ],

    'auth' => [
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