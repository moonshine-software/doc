<?php

use MoonShine\Models\MoonshineUser;
use Torchlight\Middleware\RenderTorchlight;

return [
    'dir' => 'app/MoonShine',
    'namespace' => 'App\MoonShine',

    'title' => env('MOONSHINE_TITLE', 'MoonShine'),
    'logo' => env('MOONSHINE_LOGO', ''),

    'route' => [
        'prefix' => env('MOONSHINE_ROUTE_PREFIX', ''),
        'middleware' => ['web', 'moonshine'],
        'custom_page_slug' => 'section',
    ],
    'use_migrations' => false,
    'use_notifications' => false,
    'auth' => [
        'enable' => false,
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
        'footer' => ''
    ],
    'locales' => [
        'en', 'ru'
    ],
    'middlewares' => [
        RenderTorchlight::class
    ],
    'tinymce' => [
        'file_manager' => false, // or 'laravel-filemanager' prefix for lfm
        'token' => env('MOONSHINE_TINYMCE_TOKEN', ''),
        'version' => env('MOONSHINE_TINYMCE_VERSION', '6')
    ],
    'socialite' => [
        // 'driver' => 'path_to_image_for_button'
    ],
    'header' => 'doc-search',
    'footer' => [
        'copyright' => 'Made with ❤️ by <a href="https://cutcode.dev" class="font-semibold text-purple hover:text-pink" target="_blank">CutCode</a>',
        'nav' => [
            'https://www.youtube.com/playlist?list=PLTucyHptHtTnfDI18bZnYEgvJIFmW8fGy' => 'Screencasts',
            'https://cutcode.dev/articles/moonshine-tips-tricks' => 'Tips & Tricks',
            'https://github.com/moonshine-software/moonshine/blob/1.x/LICENSE.md' => 'License',
            'https://github.com/moonshine-software/demo-project' => 'Demo project',
            'https://github.com/moonshine-software/moonshine' => 'GitHub',
        ],
    ]
];
