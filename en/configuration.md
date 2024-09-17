https://moonshine-laravel.com/docs/resource/getting-started/configuration?change-moonshine-locale=en

------

# Configuration

- [Config](#config)
- [Home page](#home-page)

<a name="config"></a>
### Config

```php
use MoonShine\Exceptions\MoonShineNotFoundException;
use MoonShine\Forms\LoginForm;
use MoonShine\Http\Middleware\Authenticate;
use MoonShine\Http\Middleware\SecurityHeadersMiddleware;
use MoonShine\Models\MoonshineUser;
use MoonShine\MoonShineLayout;
use MoonShine\Pages\ProfilePage;

return [
    # The directory where the resources are located
    'dir' => 'app/MoonShine',
    # If the directory is changed, the namespace must also be changed according to the psr-4
    'namespace' => 'App\MoonShine',

    # Admin panel header
    'title' => env('MOONSHINE_TITLE', 'MoonShine'),
    # You can change the logo by specifying a path (example - /images/logo.svg)
    'logo' => env('MOONSHINE_LOGO'),
    'logo_small' => env('MOONSHINE_LOGO_SMALL'),

    'route' => [
        # If the domain is different from the site domain
        'domain' => env('MOONSHINE_URL', ''),
        # Which path will be used to access the control panel
        # If the value is left blank, the panel will be accessible from /
        'prefix' => env('MOONSHINE_ROUTE_PREFIX', 'admin'),
        # Home Page Routing Name
        'index' => 'moonshine.index',
        # Prefix of url formation for pages
        'single_page_prefix' => 'page',
        # Middlewares groups in the panel
        'middlewares' => [
            SecurityHeadersMiddleware::class,
        ],
        # You can change the exception for 404 (for ModelNotFound you need to implement it yourself)
        'notFoundHandler' => MoonShineNotFoundException::class,
    ],

    # If you want to replace MoonshineUser with your model, you can disable the default migrations
    'use_migrations' => true,
    # Notification On/Off
    'use_notifications' => true,
    # On/Off light/dark theme switcher
    'use_theme_switcher' => true,

    # Class for rendering the main page template
    'layout' => MoonShineLayout::class,

    # Default Filesystem Disk
    'disk' => 'public',

    'disk_options' => [],

    'cache' => 'file',

    'assets' => [
        'js' => [
            'script_attributes' => [
                'defer',
            ]
        ],
        'css' => [
            'link_attributes' => [
                'rel' => 'stylesheet',
            ]
        ]
    ],

    'forms' => [
        # form of authentication
        'login' => LoginForm::class
    ],

    'pages' => [
        # Dashboard page, the default page is created when MoonShine is installed
        'dashboard' => App\MoonShine\Pages\Dashboard::class,
        # Profile page
        'profile' => ProfilePage::class
    ],

    # Default import and export from ModelResource
    'model_resources' => [
        'default_with_import' => true,
        'default_with_export' => true,
    ],

    'auth' => [
        # On/Off Authentication. If false, the panel will be available to everyone
        'enable' => true,
        'middleware' => Authenticate::class,
        'fields' => [
            'username' => 'email',
            'password' => 'password',
            'name' => 'name',
            'avatar' => 'avatar',
        ],
        # If you use your own guard, the provider
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
    ],
    # Possible translation options
    'locales' => [
        'en',
        'ru',
    ],

    'global_search' => [
        // User::class
    ],

    'tinymce' => [
        # File Manager Root, details in the Fields section
        'file_manager' => false,
        'token' => env('MOONSHINE_TINYMCE_TOKEN', ''),
        'version' => env('MOONSHINE_TINYMCE_VERSION', '6'),
    ],

    # Authentication via social networks and socialite, list the drivers and specify the logo
    'socialite' => [
        // 'driver' => 'path_to_image_for_button'
    ],
];
```

For basic use it is sufficient to edit the following parameters:

```php
// ...

return [
    // ...

    'title' => env('MOONSHINE_TITLE', 'MoonShine'),
    'logo' => env('MOONSHINE_LOGO', ''),
    'logo_small' => env('MOONSHINE_LOGO_SMALL'),

    'route' => [
        'prefix' => env('MOONSHINE_ROUTE_PREFIX', 'admin'),
    ],

    // ...
];
```

<a name="home-page"></a>
### Home page

If you need to redefine the home page in the **MoonShine admin panel**, this can be done using the static method `home()` of the class *MoonShine* at the service provider `MoonShineServiceProvider`.

```php
home(string|Closure $homeClass)
```

```php
use App\MoonShine\Pages\CustomPage;
use App\MoonShine\Resources\PostResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    public function register(): void
    {
        moonshine()->home(CustomPage::class);
        // or
        moonshine()->home(PostResource::class);
        // or
        moonshine()->home(function () {
            return PostResource::class;
        });
    }

    //...
}
```
