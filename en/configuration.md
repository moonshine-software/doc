---
video: https://youtu.be/kazEtUFIZKM?si=vDvqZHmD3KPVFOha&t=525
---

# Configuration

- [Introduction](#introduction)
- [Configuration Methods](#configuration-methods)
  - [Configuration via moonshine.php File](#config-file)
  - [Configuration via MoonShineServiceProvider](#service-provider)
- [Basic Settings](#basic-settings)
  - [Options](#options)
  - [Title](#title)
  - [Logo](#logo)
  - [Favicons](#favicons)
  - [Middleware](#middleware)
  - [Routing](#routing)
  - [Authentication](#authentication)
  - [Localization](#localization)
  - [Storage](#storage)
  - [Layout](#layout)
  - [Forms](#forms)
  - [Pages](#pages)
  - [Home page](#home-url)
- [Getting Pages and Forms](#pages-forms)
- [Choosing Configuration Method](#choosing-configuration-method)

---

<a name="introduction"></a>
## Introduction

**MoonShine** provides flexible options for configuring your application.
In this section, we will examine two main ways of configuration and the primary settings.

<a name="configuration-methods"></a>
## Configuration Methods

**MoonShine** can be configured in two ways:

1. Through the configuration file `config/moonshine.php`,
2. Through `MoonShineServiceProvider` using the `MoonShineConfigurator` class.

<a name="config-file"></a>
### Configuration via moonshine.php File

The `config/moonshine.php` file contains all available **MoonShine** settings. You can modify these settings directly in the file.

Example content of the `moonshine.php` file:

```php
return [
    'title' => env('MOONSHINE_TITLE', 'MoonShine'),
    'logo' => '/assets/logo.png',
    'logo_small' => '/assets/logo-small.svg',
    'use_migrations' => true,
    'use_notifications' => true,
    'use_database_notifications' => true,
    'use_profile' => true,
    'use_routes' => true,
    'domain' => env('MOONSHINE_DOMAIN'),
    'prefix' => 'admin',
    'middleware' => [
        // ...
    ],
    'auth' => [
        'enabled' => true,
        'guard' => 'moonshine',
        'middleware' => [
            Authenticate::class,
        ],
        // ...
    ],
    'layout' => \MoonShine\Laravel\Layouts\AppLayout::class,
    'palette' => \MoonShine\ColorManager\Palettes\PurplePalette::class,
    'locale' => 'en',
    'locales' => ['en', 'ru'],

    // ...
];
```

#### Partial Configuration

Alternatively, you can leave only those parameters in the `moonshine.php` file that differ from the default values.
This makes the configuration cleaner and easier to understand.

Example of optimized content for the `moonshine.php` file:

```php
return [
    'title' => 'My MoonShine Application',
    'use_migrations' => true,
    'use_notifications' => true,
    'use_database_notifications' => true,
];
```

> [!WARNING]
> Since the routes are loaded before the `boot()` method of the `ServiceProvider` is called,
> any route-related configuration should be defined in the `moonshine.php` config file.

> [!NOTE]
> `use_migrations`, `use_notifications`, `use_database_notifications` must always be present either in `moonshine.php` or in `MoonShineServiceProvider`.
> All other parameters not specified in the file will use the default values.

<a name="service-provider"></a>
### Configuration via MoonShineServiceProvider

An alternative way to configure is via `MoonShineServiceProvider`.
This method provides a more programmatic approach to configuration.

Example configuration in `MoonShineServiceProvider`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\ConfiguratorContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator; // [tl! collapse:end]

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     *
     */
    public function boot(
        CoreContract $core,
        ConfiguratorContract $config,
    ): void
    {
        $config
            ->title('My Application')
            ->logo('/assets/logo.png')
            ->logo('/assets/logo_small.png', true)
            ->useMigrations()
            ->useNotifications()
            ->useDatabaseNotifications()
            ->dir('app/MoonShine', 'App\MoonShine')
            ->homeRoute('moonshine.index')
            ->notFoundException(MoonShineNotFoundException::class)
            ->disk('public')
            ->cacheDriver('redis')
            ->guard('moonshine')
            ->authPipelines([])
            ->authorizationRules(
                function(ResourceContract $ctx, mixed $user, Ability $ability, mixed $data): bool {
                    return true;
                }
            )
            ->layout(\App\MoonShine\Layouts\CustomLayout::class)
            ->locale('ru')
            ->locales(['en', 'ru']);

        // ...
    }
}
```

> [!WARNING]
> Configuration via `MoonShineServiceProvider` takes precedence over settings in the `moonshine.php` file.

> [!NOTE]
> Some methods of `MoonShineConfigurator` do not have direct analogs in the `moonshine.php` file and vice versa.
> This is due to differences in approaches to configuration through the file and through code.

<a name="basic-settings"></a>
## Basic Settings

Regardless of the chosen configuration method, you can set up the following basic parameters:

<a name="options"></a>
### Options

- `use_migrations` - use default system migrations (`moonshine_users`, `moonshine_user_roles`),
- `use_notifications` - use notification system,
- `use_database_notifications` - use **Laravel** notification system based on database driver,
- `dir` - directory for **MoonShine** (by default `app/MoonShine`).
The directory is used for generating files via `artisan` commands, in general **MoonShine** is not tied to structure,
- `namespace` - namespace for classes created via `artisan` commands (by default `App\MoonShine`).

~~~tabs
tab: config/moonshine.php
```php
'dir' => 'app/MoonShine',
'namespace' => 'App\MoonShine',

'use_migrations' => true,
'use_notifications' => true,
'use_database_notifications' => true,
```
tab: MoonShineServiceProvider
```php
$config
    ->dir(dir: 'app/MoonShine', namespace: 'App\MoonShine')
    ->useMigrations()
    ->useNotifications()
    ->useDatabaseNotifications();
```
~~~

<a name="title"></a>
### Title

Meta title on pages (`<title>My Application</title>`).

~~~tabs
tab: config/moonshine.php
```php
'title' => 'My Application',
```
tab: MoonShineServiceProvider
```php
$config->title('My Application');
```
~~~

<a name="logo"></a>
### Logo

~~~tabs
tab: config/moonshine.php
```php
'logo' => '/assets/logo.png',
'logo_small' => '/assets/logo-small.png',
```
tab: MoonShineServiceProvider
```php
$config
    ->logo('/assets/logo.png')
    ->logo('/assets/logo-small.png', small: true);
```
~~~

<a name="favicons"></a>
### Favicons

You can configure paths to favicon icons through configuration.

```php filename:config/moonshine.php
'favicons' => [
    'apple-touch' => '/vendor/moonshine/apple-touch-icon.png',
    '32' => '/vendor/moonshine/favicon-32x32.png',
    '16' => '/vendor/moonshine/favicon-16x16.png',
    'safari-pinned-tab' => '/vendor/moonshine/safari-pinned-tab.svg',
    'web-manifest' => '/vendor/moonshine/site.webmanifest',
],
```

The assets array is as follows:
- `apple-touch` - path to the Apple Touch Icon,
- `32` - path to the 32x32px favicon,
- `16` - path to the 16x16px favicon,
- `safari-pinned-tab` - path to the SVG for Safari pinned tab,
- `web-manifest` - path to the Web Manifest (leave empty to disable).

> [!TIP]
> If you need to disable `web-manifest`, set an empty string for the `web-manifest` key.

> [!NOTE]
> For more information about the component, see [Favicon](/docs/{{version}}/components/favicon).

<a name="middleware"></a>
### Middleware

You can override or append to the list of `middleware` in the system.

```php
'middleware' => [
    'web',
    'auth',
    // ...
],
```

<a name="routing"></a>
### Routing

#### Setting Prefixes

```php
'prefix' => 'admin',
'page_prefix' => 'page',
'resource_prefix' => 'resource',
```

> [!WARNING]
> You can leave `resource_prefix` empty and the URL of resources will look like `/admin/{resourceUri}/{pageUri}`,
> but you may create a conflict with the routes of packages.

#### Setting Domain

```php
'domain' => 'admin.example.com',
```

#### 404

You can replace the `Exception` with your own.

~~~tabs
tab: config/moonshine.php
```php
'not_found_exception' => MoonShineNotFoundException::class,
```
tab: MoonShineServiceProvider
```php
$config->notFoundException(MoonShineNotFoundException::class);
```
~~~

<a name="authentication"></a>
### Authentication

#### Setting Guard

~~~tabs
tab: config/moonshine.php
```php
'auth' => [
    'guard' => 'admin',
    // ...
],
```
tab: MoonShineServiceProvider
```php
$config->guard('admin');
```
~~~

#### Disabling Built-in Authentication

```php
'auth' => [
    'enabled' => false,
    // ...
],
```

#### Changing Model

```php
'auth' => [
    // ...
    'model' => User::class,
],
```

> [!NOTE]
> This is specified during application initialization, therefore it is exclusively specified through the configuration file.

#### Middleware for Checking Session Presence

```php
'auth' => [
    // ...
    'middleware' => [
        Authenticate::class,
    ],
],
```

#### Pipelines

~~~tabs
tab: config/moonshine.php
```php
'auth' => [
    // ...
    'pipelines' => [
        TwoFactor::class
    ],
    // ...
],
```
tab: MoonShineServiceProvider
```php
$config->authPipelines([TwoFactor::class]);
```
~~~

#### User Fields

If you have simply replaced the model with your own `auth.model`, you will likely encounter a naming mismatch of fields.
To configure the correspondence, use the `userField()` setting.

~~~tabs
tab: config/moonshine.php
```php
'user_fields' => [
    'username' => 'email',
    'password' => 'password',
    'name' => 'name',
    'avatar' => 'avatar',
],
```
tab: MoonShineServiceProvider
```php
$config->userField('username', 'username');
```
~~~

<a name="localization"></a>
### Localization

#### Default Language

~~~tabs
tab: config/moonshine.php
```php
'locale' => 'en',
```
tab: MoonShineServiceProvider
```php
$config->locale('en');
```
~~~

#### Setting Available Languages

~~~tabs
tab: config/moonshine.php
```php
'locales' => ['en', 'ru'],
```
tab: MoonShineServiceProvider
```php
$config->locales(['en', 'ru']);
```
~~~

#### Changing the parameter name

~~~tabs
tab: config/moonshine.php
```php
'locale_key' => '_lang',
```
tab: app/Providers/MoonShineServiceProvider.php
```php
$config->localeKey('_lang');
```
~~~

For more information, see [localization](/docs/{{version}}/advanced/localization) section.

<a name="storage"></a>
### Storage

#### Storage

~~~tabs
tab: config/moonshine.php
```php
'disk' => 'public',
'disk_options' => [],
'user_avatars_dir' => 'moonshine_users',
```
tab: MoonShineServiceProvider
```php
$config
    ->disk('public', options: [])
    ->userAvatarsDir('images/avatars');
```
~~~

#### Cache

~~~tabs
tab: config/moonshine.php
```php
'cache' => 'file',
```
tab: MoonShineServiceProvider
```php
$config->cacheDriver('redis');
```
~~~

<a name="layout"></a>
### Layout

The default template used.

~~~tabs
tab: config/moonshine.php
```php
'layout' => \App\MoonShine\Layouts\CustomLayout::class,
```
tab: MoonShineServiceProvider
```php
$config->layout(\App\MoonShine\Layouts\CustomLayout::class);
```
~~~

<a name="palette"></a>
### Palette

The default palette class used when a layout does not define its own.

~~~tabs
tab: config/moonshine.php
```php
'palette' => \App\MoonShine\Palettes\CorporatePalette::class,
```
tab: MoonShineServiceProvider
```php
$config->set('palette', \App\MoonShine\Palettes\CorporatePalette::class);
```
~~~

<a name="forms"></a>
### Forms

For convenience, we have moved the authentication and filter forms to configuration and provide a quick way to replace them with your own.

~~~tabs
tab: config/moonshine.php
```php
'forms' => [
    'login' => LoginForm::class,
    'filters' => FiltersForm::class,
],
```
tab: MoonShineServiceProvider
```php
$config->set('forms.login', MyLoginForm::class);
```
~~~

<a name="pages"></a>
### Pages

For convenience, we have moved the basic pages to configuration and provide a quick way to replace them with your own.

~~~tabs
tab: config/moonshine.php
```php
'pages' => [
    'dashboard' => Dashboard::class,
    'profile' => ProfilePage::class,
    'login' => LoginPage::class,
    'error' => ErrorPage::class,
],
```
tab: MoonShineServiceProvider
```php
$config->changePage(LoginPage::class, MyLoginPage::class);
```
~~~

<a name="home-url"></a>
### Home page

You can specify which route or URL is the main page of the panel.
Used when redirecting after successful authentication, link in logo and 404 page.

~~~tabs
tab: config/moonshine.php
```php
'home_route' => 'moonshine.index',
// or url string
'home_url' => '/admin/page/some-page',
```
tab: MoonShineServiceProvider
```php
$config->homeRoute('moonshine.index');
// or url string
$config->homeUrl('/admin/page/some-page');
```
~~~

<a name="pages-forms"></a>
## Getting Pages and Forms

**MoonShine** provides convenient methods for retrieving pages and forms in your application.

### Getting Pages

The `getPage` method allows you to retrieve an instance of a page by its name or use the default page.

```php
getPage(
    string $name,
    string $default,
    mixed ...$parameters,
)
```

- `$name` - page name in the config,
- `$default` - default page class if not found in the config,
- `$parameters` - additional parameters for the page constructor.

Example of use via helper:

```php
$customPage = moonshineConfig()->getPage('custom');
```

Example of use via DI:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;

/**
 * @param  MoonShineConfigurator  $config
 */
public function index(ConfiguratorContract $config)
{
  $customPage = $config->getPage('custom');
}
```

### Getting Forms

The `getForm()` method allows you to retrieve an instance of a form by its name or use the default form.

```php
getForm(
    string $name,
    string $default,
    mixed ...$parameters,
)
```

- `$name` - form name in the config,
- `$default` - default form class,
- `$parameters` - additional parameters for the form constructor.

Example of use via helper:

```php
$form = moonshineConfig()->getForm('login');
```

Example of use via DI:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;

/**
 * @param  MoonShineConfigurator  $config
 */
public function index(ConfiguratorContract $config)
{
  $form = $config->getForm('login');
}
```

### Declaring Pages and Forms in Configuration

You can set up the correspondence between the names and classes of pages and forms in the `moonshine.php` file.

```php
'pages' => [
    'dashboard' => App\MoonShine\Pages\DashboardPage::class,
    'custom' => App\MoonShine\Pages\CustomPage::class,
],

'forms' => [
    'login' => App\MoonShine\Forms\LoginForm::class,
    'custom' => App\MoonShine\Forms\CustomForm::class,
],
```

This will allow you to easily retrieve the desired pages and forms by their names using the `getPage()` and `getForm()` methods.

<a name="choosing-configuration-method"></a>
## Choosing Configuration Method

When choosing a configuration method, it's important to consider the following:

1. **Priority**: Configuration via `MoonShineServiceProvider` takes precedence over settings in the `moonshine.php` file.

2. **Flexibility**:
   - Full configuration via `moonshine.php` provides a clear overview of all settings,
   - Partial configuration via `moonshine.php` makes it easy to see what parameters have been changed,
   - Configuration via `MoonShineServiceProvider` offers maximum flexibility and the ability to use logic during setup.

3. **Ease of Maintenance**:
   - Using the `moonshine.php` file may be easier for quick changes and understanding the overall structure of settings,
   - `MoonShineServiceProvider` allows centralized management of settings in one place in the code.

4. **Integration with Code**:
   - Configuration via `MoonShineServiceProvider` integrates better with the rest of the application code and allows the use of **Laravel** dependencies and services.

Choose the method that best fits your development style and project requirements.
You can also combine these approaches, for example, using the `moonshine.php` file for basic settings and the `MoonShineServiceProvider` for more complex configurations.
