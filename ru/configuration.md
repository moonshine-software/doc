---
video: https://youtu.be/kC1KIdO_MZ4?si=H2JRdmEzn4F5XOM2&t=554
---

# Конфигурация

- [Введение](#introduction)
- [Способы конфигурации](#configuration-methods)
  - [Конфигурация через файл moonshine.php](#config-file)
  - [Конфигурация через MoonShineServiceProvider](#service-provider)
- [Основные настройки](#basic-settings)
  - [Опции](#options)
  - [Заголовок](#title)
  - [Логотип](#logo)
  - [Favicons](#favicons)
  - [Middleware](#middleware)
  - [Маршрутизация](#routing)
  - [Аутентификация](#authentication)
  - [Локализация](#localization)
  - [Хранилище](#storage)
  - [Layout](#layout)
  - [Формы](#forms)
  - [Страницы](#pages)
  - [Главная страница](#home-url)
- [Получение страниц и форм](#pages-forms)
- [Выбор метода конфигурации](#choosing-configuration-method)

---

<a name="introduction"></a>
## Введение

**MoonShine** предоставляет гибкие возможности для конфигурации вашего приложения.
В этом разделе мы рассмотрим два основных способа конфигурации и основные настройки.

<a name="configuration-methods"></a>
## Способы конфигурации

**MoonShine** можно настроить двумя способами:

1. Через файл конфигурации `config/moonshine.php`,
2. Через `MoonShineServiceProvider` с использованием класса `MoonShineConfigurator`.

<a name="config-file"></a>
### Конфигурация через файл moonshine.php

Файл `config/moonshine.php` содержит все доступные настройки **MoonShine**. Вы можете изменять эти настройки напрямую в файле.

Пример содержимого файла `moonshine.php`:

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

#### Частичная конфигурация

Альтернативно, вы можете оставить в файле `moonshine.php` только те параметры, которые отличаются от значений по умолчанию.
Это делает конфигурацию более чистой и легкой для понимания.

Пример оптимизированного содержимого файла `moonshine.php`:

```php
return [
    'title' => 'My MoonShine Application',
    'use_migrations' => true,
    'use_notifications' => true,
    'use_database_notifications' => true,
];
```

> [!WARNING]
> Поскольку маршруты загружаются до вызова метода `boot()` в `ServiceProvider`, любые настройки,
> связанные с роутингом, нужно указывать в конфигурационном файле `moonshine.php`.

> [!NOTE]
> `use_migrations`, `use_notifications`, `use_database_notifications` должны присутствовать всегда либо в `moonshine.php`, либо в `MoonShineServiceProvider`.
> Все остальные параметры, не указанные в файле, будут использовать значения по умолчанию.

<a name="service-provider"></a>
### Конфигурация через MoonShineServiceProvider

Альтернативный способ настройки - `MoonShineServiceProvider`.
Этот метод предоставляет более программный подход к конфигурации.

Пример конфигурации в `MoonShineServiceProvider`:

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
> Конфигурация через `MoonShineServiceProvider` имеет приоритет над настройками в файле `moonshine.php`.

> [!NOTE]
> Некоторые методы `MoonShineConfigurator` не имеют прямых аналогов в файле `moonshine.php` и наоборот.
> Это связано с различиями в подходах к конфигурации через файл и через код.

<a name="basic-settings"></a>
## Основные настройки

Независимо от выбранного способа конфигурации, вы можете настроить следующие основные параметры:

<a name="options"></a>
### Опции

- `use_migrations` - использовать публикацию миграций системы по умолчанию (`moonshine_users`, `moonshine_user_roles`),
- `use_notifications` - использовать систему уведомлений,
- `use_database_notifications` - использовать систему уведомлений **Laravel** на основе драйвера базы данных,
- `dir` - директория для **MoonShine** (по умолчанию `app/MoonShine`).
Директория используется для генерации файлов через `artisan` команды, в целом **MoonShine** не привязан к структуре,
- `namespace` - namespace для классов созданных через `artisan` команды (по умолчанию `App\MoonShine`).

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
### Заголовок

Мета заголовок на страницах (`<title>My Application</title>`).

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
### Логотип

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

Вы можете настроить пути к favicon-иконкам через конфигурацию.

```php filename:config/moonshine.php
'favicons' => [
    'apple-touch' => '/vendor/moonshine/apple-touch-icon.png',
    '32' => '/vendor/moonshine/favicon-32x32.png',
    '16' => '/vendor/moonshine/favicon-16x16.png',
    'safari-pinned-tab' => '/vendor/moonshine/safari-pinned-tab.svg',
    'web-manifest' => '/vendor/moonshine/site.webmanifest',
],
```

Массив ассетов вида:
- `apple-touch` - путь к Apple Touch Icon,
- `32` - путь к favicon 32x32px,
- `16` - путь к favicon 16x16px,
- `safari-pinned-tab` - путь к SVG для закрепленной вкладки Safari,
- `web-manifest` - путь к Web Manifest (оставьте пустым для отключения).

> [!TIP]
> Если вам необходимо отключить `web-manifest`, установите пустую строку для ключа `web-manifest`.

> [!NOTE]
> Подробнее о компоненте смотрите в разделе [Favicon](/docs/{{version}}/components/favicon).

<a name="middleware"></a>
### Middleware

Вы можете переопределить или дополнить список `middleware` в системе.

```php
'middleware' => [
    'web',
    'auth',
    // ...
],
```

<a name="routing"></a>
### Маршрутизация

#### Установка префиксов

```php
'prefix' => 'admin',
'page_prefix' => 'page',
'resource_prefix' => 'resource',
```

> [!WARNING]
> Вы можете оставить `resource_prefix` пустым и `URL` ресурсов будет иметь вид `/admin/{resourceUri}/{pageUri}`,
> но вы можете создать конфликт с роутами пакетов.

#### Установка домена

```php
'domain' => 'admin.example.com',
```

#### 404

Вы можете заменить `Exception` на собственный.

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
### Аутентификация

#### Установка guard

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

#### Отключение встроенной аутентификации

```php
'auth' => [
    'enabled' => false,
    // ...
],
```

#### Изменение модели

```php
'auth' => [
    // ...
    'model' => User::class,
],
```

> [!NOTE]
> Указывается при инициализации приложения, поэтому указывается исключительно через файл конфигурации.

#### Middleware для проверки наличия сессии

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

#### Поля пользователя

Если вы просто заменили модель на свою `auth.model`, то скорее всего вы столкнетесь с проблемой несоответствия наименования полей.
Чтобы настроить соответствие, воспользуйтесь настройкой `userField()`.

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
### Локализация

#### Язык по умолчанию

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

#### Установка доступных языков

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

#### Изменение имени параметра

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

Подробнее смотрите в разделе [локализация](/docs/{{version}}/advanced/localization).

<a name="storage"></a>
### Хранилище

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

Шаблон используемый по умолчанию.

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
### Палитра

Класс палитры, который будет использоваться по умолчанию, если layout не задаёт собственный.

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
### Формы

Для удобства мы вынесли формы аутентификации и фильтров в конфигурацию и даем быстрый способ их заменить на собственные.

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
### Страницы

Для удобства мы вынесли базовые страницы в конфигурацию и даем быстрый способ их заменить на собственные.

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
### Главная страница

Вы можете указать какой роут или урл является главной страницей панели.
Используется при редиректе после успешной аутентификации, ссылке на логотипе и 404 странице.

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
## Получение страниц и форм

**MoonShine** предоставляет удобные методы для получения страниц и форм в вашем приложении.

### Получение страниц

Метод `getPage` позволяет получить экземпляр страницы по её имени или использовать страницу по умолчанию.

```php
getPage(
    string $name,
    string $default,
    mixed ...$parameters,
)
```

- `$name` - имя страницы в конфиге,
- `$default` - класс страницы по умолчанию, если не найдена в конфиге,
- `$parameters` - дополнительные параметры для конструктора страницы.

Пример использования через хелпер:

```php
$customPage = moonshineConfig()->getPage('custom');
```

Пример использования через DI:

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

### Получение форм

Метод `getForm()` позволяет получить экземпляр формы по её имени или использовать форму по умолчанию.

```php
getForm(
    string $name,
    string $default,
    mixed ...$parameters,
)
```

- `$name` - имя формы в конфиге,
- `$default` - класс формы по умолчанию,
- `$parameters` - дополнительные параметры для конструктора формы.

Пример использования через хелпер:

```php
$form = moonshineConfig()->getForm('login');
```

Пример использования через DI:

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

### Объявление страниц и форм в конфигурации

Вы можете настроить соответствие между именами и классами страниц и форм в файле `moonshine.php`.

```php
'pages' => [
    'dashboard' => \App\MoonShine\Pages\DashboardPage::class,
    'custom' => \App\MoonShine\Pages\CustomPage::class,
],

'forms' => [
    'login' => \App\MoonShine\Forms\LoginForm::class,
    'custom' => \App\MoonShine\Forms\CustomForm::class,
],
```

Это позволит вам легко получать нужные страницы и формы по их именам, используя методы `getPage()` и `getForm()`.

<a name="choosing-configuration-method"></a>
## Выбор метода конфигурации

При выборе метода конфигурации важно учитывать следующее:

1. **Приоритет**: Конфигурация через `MoonShineServiceProvider` имеет приоритет над настройками в файле `moonshine.php`.

2. **Гибкость**:
   - Полная конфигурация через `moonshine.php` дает четкий обзор всех настроек,
   - Частичная конфигурация через `moonshine.php` позволяет легко видеть, какие параметры были изменены,
   - Конфигурация через `MoonShineServiceProvider` предоставляет максимальную гибкость и возможность использовать логику при настройке.

3. **Простота поддержки**:
   - Использование файла `moonshine.php` может быть проще для быстрых изменений и понимания общей структуры настроек,
   - `MoonShineServiceProvider` позволяет централизованно управлять настройками в одном месте в коде.

4. **Интеграция с кодом**:
   - Конфигурация через `MoonShineServiceProvider` лучше интегрируется с остальным кодом приложения и позволяет использовать зависимости и сервисы **Laravel**.

Выберите метод, который лучше всего соответствует вашему стилю разработки и требованиям проекта.
Вы также можете комбинировать эти подходы, например, используя файл `moonshine.php` для базовых настроек и `MoonShineServiceProvider` для более сложной конфигурации.
