https://moonshine-laravel.com/docs/resource/getting-started/installation?change-moonshine-locale=en

------

# Installation

- [Requirements](#requirements)
- [Composer](#composer)
- [Installation](#install)
- [Creating an administrator](#admin)
- [Service provider](#config)

<a name="requirements"></a>
## Requirements

To use MoonShine, the following requirements must be met before installation:

- php >= 8.1
- laravel >= 10.23
- composer > 2

<a name="composer"></a>
## Composer

```
composer require moonshine/moonshine
```

<a name="install"></a>
## Installation

```
php artisan moonshine:install
```

> [!NOTE]
> Once executed, a `config/moonshine.php` with basic settings will be added.  
> [More information about the configuration file](https://moonshine-laravel.com/docs/resource/getting-started/configuration)

> [!NOTE]
> A directory with the administration panel and resources will also be added - `app/MoonShine`.  
> [More about Resources](https://moonshine-laravel.com/docs/resource/models-resources/resources-index)

> [!NOTE]
> And a `MoonShineServiceProvider` provider will also be added, where resources should be registered.  
> [More about Resources](https://moonshine-laravel.com/docs/resource/models-resources/resources-index)

<a name="admin"></a>
## Creating an administrator

If during the installation of the admin panel `MoonShine` an administrator was not created or it is necessary to create another one, you can do it by executing the console command.

```
php artisan moonshine:user
```

<a name="config"></a>
## Service provider

To register new resources in MoonShine and create a menu, we need `app/Providers/MoonShineServiceProvider.php`

```php
namespace App\Providers;

use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function resources(): array
    {
        return [
        ];
    }

    protected function menu(): array
    {
        return [
            MenuGroup::make('moonshine::ui.resource.system', [
               MenuItem::make('moonshine::ui.resource.admins_title', new MoonShineUserResource())
                   ->translatable(),
               MenuItem::make('moonshine::ui.resource.role_title', new MoonShineUserRoleResource())
                   ->translatable(),
            ])->translatable(),

            MenuItem::make('Documentation', 'https://laravel.com')
               ->badge(fn() => 'Check'),
        ];
    }

    protected function theme(): array
    {
        return [];
    }
}
```

> [!NOTE]
> Once installed, several resources will be registered in the `MoonShineServiceProvider`.  
> [More about Menu](https://moonshine-laravel.com/docs/resource/menu/menu).

Great! Now you can create and register sections of the future admin panel and get to work! But don't forget to read the documentation to the end!

> [!NOTE]
> By default, the admin panel can be accessed by url `/admin`.  
> You can change the url in the [configuration file](https://moonshine-laravel.com/docs/resource/getting-started/configuration).
