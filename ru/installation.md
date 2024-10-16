# Установка

- [Требования](#requirements)
- [Composer](#composer)
- [Установка](#install)
- [Создание администратора](#admin)
- [Сервис-провайдер](#config)

---

<a name="requirements"></a>
## Требования

Для использования MoonShine необходимо соблюдение следующих требований перед установкой:

- php >= 8.1,
- laravel >= 10.23,
- composer > 2.

<a name="composer"></a>
## Composer

```
composer require moonshine/moonshine
```

<a name="install"></a>
## Установка

```
php artisan moonshine:install
```

> [!NOTE]
> После выполнения будет добавлен `config/moonshine.php` с базовыми настройками.  
> [Подробнее о файле конфигурации](https://moonshine-laravel.com/docs/resource/getting-started/configuration)

> [!NOTE]
> Также будет добавлена директория с панелью администрирования и ресурсами - `app/MoonShine`.  
> [Подробнее о Ресурсах](https://moonshine-laravel.com/docs/resource/models-resources/resources-index)

> [!NOTE]
> И также будет добавлен провайдер `MoonShineServiceProvider`, где следует регистрировать ресурсы.  
> [Подробнее о Ресурсах](https://moonshine-laravel.com/docs/resource/models-resources/resources-index)

<a name="admin"></a>
## Создание администратора

Если во время установки панели администрирования `MoonShine` не был создан администратор или необходимо создать еще одного, это можно сделать, выполнив консольную команду.

```
php artisan moonshine:user
```

<a name="config"></a>
## Сервис-провайдер

Для регистрации новых ресурсов в MoonShine и создания меню нам нужен `app/Providers/MoonShineServiceProvider.php`

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
> После установки в `MoonShineServiceProvider` будет зарегистрировано несколько ресурсов.  
> [Подробнее о Меню](https://moonshine-laravel.com/docs/resource/menu/menu).

Отлично! Теперь вы можете создавать и регистрировать разделы будущей панели администрирования и приступать к работе! Но не забудьте дочитать документацию до конца!

> [!NOTE]
> По умолчанию доступ к панели администрирования осуществляется по url `/admin`.  
> Вы можете изменить url в [файле конфигурации](https://moonshine-laravel.com/docs/resource/getting-started/configuration).
