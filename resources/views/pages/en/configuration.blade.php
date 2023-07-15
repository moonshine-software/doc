<x-page title="Configuration" :sectionMenu="[]">

<x-code language="php">
use MoonShine\Exceptions\MoonShineNotFoundException;
use MoonShine\Models\MoonshineUser;

return [
    # The directory where the resources are located
    'dir' => 'app/MoonShine',
    # If you change the directory, you must also change the namespace according to psr-4
    'namespace' => 'App\MoonShine',

    # Admin panel header
    'title' => env('MOONSHINE_TITLE', 'MoonShine'),
    # You can change the logo by specifying the path (example - /images/logo.svg)
    'logo' => env('MOONSHINE_LOGO', '/images/logo.svg'),
    'logo_small' => env('MOONSHINE_LOGO_SMALL', '/images/logo-icon.svg'),

    'route' => [
        # Which url will be available for the control panel (as a rule admin)
        # If the value is left empty, the panel will be accessible from /
        'prefix' => env('MOONSHINE_ROUTE_PREFIX', 'moonshine'),
        # Starting route in admin panel
        'index_route' => env('MOONSHINE_INDEX_ROUTE', 'moonshine.index'),
        # Groups of middlewares in the panel
        'middleware' => ['moonshine'],
        # Slug of the url formation for custom pages
        'custom_page_slug' => 'custom_page',
        # You can change 404 error exception (for ModelNotFound you need to implement it yourself)
        'notFoundHandler' => MoonShineNotFoundException::class
    ],

    # If you want to replace MoonshineUser with your own model, you can disable default migrations
    'use_migrations' => true,
    # On/Off notifications
    'use_notifications' => true,

    'auth' => [
        # On/Off authentication. If false, the panel will be available to all
        'enable' => true,
        # If you use your own guard, provider
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
        # Text under the sign in button. As an example, you can add a sign-in button
        'footer' => ''
    ],
    # Possible translations
    'locales' => [
        'en', 'ru'
    ],
    # Additional middlewares
    'middlewares' => [],
    'tinymce' => [
        # File manager root, see the Fields section for details
        'file_manager' => false, // or 'laravel-filemanager' prefix for lfm
        'token' => env('MOONSHINE_TINYMCE_TOKEN', ''),
        'version' => env('MOONSHINE_TINYMCE_VERSION', '6')
    ],
    # Authenticate via social networks and socialite, list the drivers and specify the logo
    'socialite' => [
        // 'driver' => 'path_to_image_for_button'
    ],
    # Template customization
    'header' => null, // blade path
    'footer' => [
        'copyright' => 'Made with ❤️ by <a href="https://cutcode.dev" class="font-semibold text-purple hover:text-pink" target="_blank">CutCode</a>',
        'nav' => [
            'https://github.com/moonshine/moonshine/blob/1.x/LICENSE.md' => 'License',
            'https://moonshine.cutcode.dev' => 'Documentation',
            'https://github.com/moonshine/moonshine' => 'GitHub',
        ],
    ]
];
</x-code>

<x-p>
    For basic use it is enough to edit the parameters below
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
