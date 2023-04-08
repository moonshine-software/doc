<x-page title="Конфигурация" :sectionMenu="[]">

<x-code language="php">
use Leeto\MoonShine\Exceptions\MoonShineNotFoundException;
use Leeto\MoonShine\Models\MoonshineUser;

return [
    # Директория, где располагаются ресурсы
    'dir' => 'app/MoonShine',
    # При изменении директории, необходимо поменять и namespace согласно psr-4
    'namespace' => 'App\MoonShine',

    # Заголовок админ. панели
    'title' => env('MOONSHINE_TITLE', 'MoonShine'),
    # Вы можете изменить логотип, указав путь (пример - /images/logo.svg)
    'logo' => env('MOONSHINE_LOGO', ''),

    'route' => [
        # По какому урл будет доступна панель управления (как правило admin)
        # Если оставить значение пустым то панель будет доступна от /
        'prefix' => env('MOONSHINE_ROUTE_PREFIX', 'moonshine'),
        # Группы middlewares в панеле
        'middleware' => ['web', 'moonshine'],
        # Slug формирования урл для кастомных страниц
        'custom_page_slug' => 'custom_page',
        # Можно поменять исключение для 404 (для ModelNotFound нужно реализовать самостоятельно)
        'notFoundHandler' => MoonShineNotFoundException::class
    ],

    'auth' => [
        # Вкл/Выкл аутентификация, если false то панель будет доступна всем
        'enable' => true,
        # Если используете собственный guard, provider
        'guard' => 'moonshine',
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
        ],
        # Текст под кнопкой войти. Как пример можно добавить кнопку регистрации
        'footer' => ''
    ],
    # Возможные варианты переводов
    'locales' => [
        'en', 'ru'
    ],
    # Дополнительные middlewares
    'middlewares' => [],
    'tinymce' => [
        # Роут файлового менеджера, подробности в разделе Поля
        'file_manager' => false, // or 'laravel-filemanager' prefix for lfm
        'token' => env('MOONSHINE_TINYMCE_TOKEN', ''),
        'version' => env('MOONSHINE_TINYMCE_VERSION', '6')
    ],
    # Аутентификация через соц. сети и socialite, перечисляем драйверы и указываем логотип
    'socialite' => [
        // 'driver' => 'path_to_image_for_button'
    ],
    'footer' => [
        'copyright' => 'Made with ❤️ by <a href="https://cutcode.dev" class="font-semibold text-purple hover:text-pink" target="_blank">CutCode</a>',
        'nav' => [
            'https://github.com/lee-to/moonshine/blob/1.x/LICENSE.md' => 'License',
            'https://moonshine.cutcode.dev' => 'Documentation',
            'https://github.com/lee-to/moonshine' => 'GitHub',
        ],
    ]
];
</x-code>

<x-p>
    Для базового использования достаточно отредактировать параметры указанные ниже
</x-p>

<x-code language="php">
return [
    // ..
    'title' => env('MOONSHINE_TITLE', 'MoonShine'), // [tl! focus]
    'logo' => env('MOONSHINE_LOGO', ''), // [tl! focus]

    'route' => [
        'prefix' => env('MOONSHINE_ROUTE_PREFIX', 'moonshine'), // [tl! focus]
    ],
    // ..
</x-code>
</x-page>
