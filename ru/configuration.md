# Конфигурация

- [Конфиг](#config)
- [Домашняя страница](#home-page)

---

<a name="config"></a>
## Конфиг

```php
use MoonShine\Exceptions\MoonShineNotFoundException;
use MoonShine\Forms\LoginForm;
use MoonShine\Http\Middleware\Authenticate;
use MoonShine\Http\Middleware\SecurityHeadersMiddleware;
use MoonShine\Models\MoonshineUser;
use MoonShine\MoonShineLayout;
use MoonShine\Pages\ProfilePage;

return [
    # Директория, где расположены ресурсы
    'dir' => 'app/MoonShine',
    # Если директория изменена, пространство имен также должно быть изменено в соответствии с psr-4
    'namespace' => 'App\MoonShine',

    # Заголовок панели администратора
    'title' => env('MOONSHINE_TITLE', 'MoonShine'),
    # Вы можете изменить логотип, указав путь (пример - /images/logo.svg)
    'logo' => env('MOONSHINE_LOGO'),
    'logo_small' => env('MOONSHINE_LOGO_SMALL'),

    'route' => [
        # Если домен отличается от домена сайта
        'domain' => env('MOONSHINE_URL', ''),
        # Какой путь будет использоваться для доступа к панели управления
        # Если значение оставлено пустым, панель будет доступна с /
        'prefix' => env('MOONSHINE_ROUTE_PREFIX', 'admin'),
        # Имя маршрута домашней страницы
        'index' => 'moonshine.index',
        # Префикс формирования url для страниц
        'single_page_prefix' => 'page',
        # Группы промежуточного ПО в панели
        'middlewares' => [
            SecurityHeadersMiddleware::class,
        ],
        # Вы можете изменить исключение для 404 (для ModelNotFound нужно реализовать самостоятельно)
        'notFoundHandler' => MoonShineNotFoundException::class,
    ],

    # Если вы хотите заменить MoonshineUser своей моделью, вы можете отключить стандартные миграции
    'use_migrations' => true,
    # Уведомления Вкл/Выкл
    'use_notifications' => true,
    # Вкл/Выкл переключатель светлой/темной темы
    'use_theme_switcher' => true,

    # Класс для отрисовки шаблона главной страницы
    'layout' => MoonShineLayout::class,

    # Диск файловой системы по умолчанию
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
        # форма аутентификации
        'login' => LoginForm::class
    ],

    'pages' => [
        # Страница панели управления, страница по умолчанию создается при установке MoonShine
        'dashboard' => App\MoonShine\Pages\Dashboard::class,
        # Страница профиля
        'profile' => ProfilePage::class
    ],

    # Импорт и экспорт по умолчанию из ModelResource
    'model_resources' => [
        'default_with_import' => true,
        'default_with_export' => true,
    ],

    'auth' => [
        # Вкл/Выкл аутентификацию. Если false, панель будет доступна всем
        'enable' => true,
        'middleware' => Authenticate::class,
        'fields' => [
            'username' => 'email',
            'password' => 'password',
            'name' => 'name',
            'avatar' => 'avatar',
        ],
        # Если вы используете собственный guard, провайдер
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
    # Возможные варианты перевода
    'locales' => [
        'en',
        'ru',
    ],

    'global_search' => [
        // User::class
    ],

    'tinymce' => [
        # Корневой каталог файлового менеджера, подробности в разделе Fields
        'file_manager' => false,
        'token' => env('MOONSHINE_TINYMCE_TOKEN', ''),
        'version' => env('MOONSHINE_TINYMCE_VERSION', '6'),
    ],

    # Аутентификация через социальные сети и socialite, перечислите драйверы и укажите логотип
    'socialite' => [
        // 'driver' => 'путь_к_изображению_для_кнопки'
    ],
];
```

Для базового использования достаточно отредактировать следующие параметры:

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
## Домашняя страница

Если вам нужно переопределить домашнюю страницу в **панели администрирования MoonShine**, это можно сделать с помощью статического метода `home()` класса *MoonShine* в сервис-провайдере `MoonShineServiceProvider`.

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
        // или
        moonshine()->home(PostResource::class);
        // или
        moonshine()->home(function () {
            return PostResource::class;
        });
    }

    //...
}
```
