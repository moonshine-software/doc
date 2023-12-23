<x-page
    title="Configuration"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#config', 'label' => 'Config'],
            ['url' => '#home-page', 'label' => 'Home page'],
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
    # The directory where the resources are located
    'dir' => 'app/MoonShine', // [tl! focus]
    # If the directory is changed, the namespace must also be changed according to the psr-4
    'namespace' => 'App\MoonShine', // [tl! focus]

    # Admin panel header
    'title' => env('MOONSHINE_TITLE', 'MoonShine'), // [tl! focus]
    # You can change the logo by specifying a path (example - /images/logo.svg)
    'logo' => env('MOONSHINE_LOGO'), // [tl! focus]
    'logo_small' => env('MOONSHINE_LOGO_SMALL'), // [tl! focus]

    'route' => [ // [tl! focus]
        # If the domain is different from the site domain
        'domain' => env('MOONSHINE_URL', ''),
        # Which path will be used to access the control panel
        # If the value is left blank, the panel will be accessible from /
        'prefix' => env('MOONSHINE_ROUTE_PREFIX', 'admin'), // [tl! focus]
        # Home Page Routing Name
        'index' => 'moonshine.index', // [tl! focus]
        # Prefix of url formation for pages
        'single_page_prefix' => 'page', // [tl! focus]
        # Middlewares groups in the panel
        'middlewares' => [  // [tl! focus]
            SecurityHeadersMiddleware::class, // [tl! focus]
        ], // [tl! focus]
        # You can change the exception for 404 (for ModelNotFound you need to implement it yourself)
        'notFoundHandler' => MoonShineNotFoundException::class, // [tl! focus]
    ],

    # If you want to replace MoonshineUser with your model, you can disable the default migrations
    'use_migrations' => true, // [tl! focus]
    # Notification On/Off
    'use_notifications' => true, // [tl! focus]

    # Class for rendering the main page template
    'layout' => MoonShineLayout::class, // [tl! focus]

    # Default Filesystem Disk
    'disk' => 'public', // [tl! focus]

    'forms' => [ // [tl! focus]
        # form of authentication
        'login' => LoginForm::class // [tl! focus]
    ], // [tl! focus]

    'pages' => [ // [tl! focus]
        # Dashboard page, the default page is created when MoonShine is installed
        'dashboard' => App\MoonShine\Pages\Dashboard::class, // [tl! focus]
        # Profile page
        'profile' => ProfilePage::class // [tl! focus]
    ], // [tl! focus]

    # Default import and export from ModelResource
    'model_resources' => [ // [tl! focus]
        'default_with_import' => true, // [tl! focus]
        'default_with_export' => true, // [tl! focus]
    ],  // [tl! focus]

    'auth' => [ // [tl! focus]
        # On/Off Authentication. If false, the panel will be available to everyone
        'enable' => true, // [tl! focus]
        'middleware' => Authenticate::class, // [tl! focus]
        'fields' => [ // [tl! focus:start]
            'username' => 'email',
            'password' => 'password',
            'name' => 'name',
            'avatar' => 'avatar',
        ], // [tl! focus:end]
        # If you use your own guard, the provider
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
    # Possible translation options
    'locales' => [ // [tl! focus:start]
        'en',
        'ru',
    ], // [tl! focus:end]

    'tinymce' => [ // [tl! focus]
        # File Manager Root, details in the Fields section
        'file_manager' => false, // [tl! focus]
        'token' => env('MOONSHINE_TINYMCE_TOKEN', ''), // [tl! focus]
        'version' => env('MOONSHINE_TINYMCE_VERSION', '6'), // [tl! focus]
    ], // [tl! focus]

    # Authentication via social networks and socialite, list the drivers and specify the logo
    'socialite' => [ // [tl! focus:start]
        // 'driver' => 'path_to_image_for_button'
    ], // [tl! focus:end]
]; // [tl! focus]
</x-code>

<x-p>
    For basic use it is sufficient to edit the following parameters:
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

<x-sub-title id="home-page">Home page</x-sub-title>

<x-p>
    If you need to redefine the home page in the <strong>MoonShine admin panel</strong>,
    this can be done using the static method <code>home()</code> of the class <em>MoonShine</em>
    at the service provider <code>MoonShineServiceProvider</code>.
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
