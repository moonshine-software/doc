
# Конфигурация MoonShine

- [Введение](#introduction)
- [Способы конфигурации](#configuration-methods)
  - [Конфигурация через файл moonshine.php](#config-file)
  - [Конфигурация через MoonShineServiceProvider](#service-provider)
- [Основные настройки](#basic-settings)
- [Настройки аутентификации](#authentication-settings)
- [Настройки маршрутизации](#routing-settings)
- [Настройки локализации](#localization-settings)
- [Дополнительные настройки](#additional-settings)
- [Полный список параметров конфигурации](#configuration-options)
- [Выбор метода конфигурации](#choosing-configuration-method)
- [Получение страниц и форм](#pages-forms)

---

<a name="introduction"></a>
## Введение

MoonShine предоставляет гибкие возможности для конфигурации вашего приложения. В этом разделе мы рассмотрим два основных способа конфигурации и основные настройки, доступные в MoonShine.

<a name="configuration-methods"></a>
## Способы конфигурации

MoonShine можно настроить двумя способами:

1. Через файл конфигурации `moonshine.php`
2. Через `MoonShineServiceProvider` с использованием класса `MoonShineConfigurator`

<a name="config-file"></a>
### Конфигурация через файл moonshine.php

Файл `config/moonshine.php` содержит все доступные настройки MoonShine. Вы можете изменять эти настройки напрямую в файле.

Пример содержимого файла `moonshine.php`:

```php
return [
    'title' => env('MOONSHINE_TITLE', 'MoonShine'),
    'domain' => env('MOONSHINE_DOMAIN'),
    'prefix' => 'admin',
    'auth' => [
        'enable' => true,
        'guard' => 'moonshine',
    ],
    'middleware' => [
        // ...список middleware
    ],
    'layout' => \MoonShine\Laravel\Layouts\AppLayout::class,
    // ... другие настройки
];
```

#### Частичная конфигурация

Альтернативно, вы можете оставить в файле `moonshine.php` только те параметры, которые отличаются от значений по умолчанию. Это делает конфигурацию более чистой и легкой для понимания.
Пример оптимизированного содержимого файла `moonshine.php`:

```php
return [
    'title' => 'Мое приложение MoonShine',
    'domain' => env('MOONSHINE_DOMAIN', 'admin.example.com'),
    'prefix' => 'dashboard',
    // Здесь только параметры, которые вы изменили
];
```

> [!NOTE]
> Все остальные параметры, не указанные в файле, будут использовать значения по умолчанию из MoonShine.

<a name="service-provider"></a>
### Конфигурация через MoonShineServiceProvider

Альтернативный способ настройки - использование метода `configure` в `MoonShineServiceProvider`. Этот метод предоставляет более программный подход к конфигурации.

Пример конфигурации в `MoonShineServiceProvider`:

```php
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function configure(MoonShineConfigurator $config): MoonShineConfigurator
    {
        return $config
            ->title('Мое приложение')
            ->domain(env('MOONSHINE_DOMAIN'))
            ->prefix('admin')
            ->guard('moonshine')
            ->middleware([
                // ...список middleware
            ])
            ->layout(\MoonShine\Laravel\Layouts\AppLayout::class)
            // ... другие настройки
        ;
    }

    // ... другие методы
}
```

> [!NOTE]
> Конфигурация через `MoonShineServiceProvider` имеет приоритет над настройками в файле `moonshine.php`.
> При использовании этого метода вы можете полностью удалить файл moonshine.php из вашего проекта.

<a name="basic-settings"></a>
## Основные настройки

Независимо от выбранного способа конфигурации, вы можете настроить следующие основные параметры:

### Установка заголовка приложения

```php
// В moonshine.php
'title' => 'Мое приложение',

// В MoonShineServiceProvider
$config->title('Мое приложение');
```

### Настройка middleware

```php
// В moonshine.php
'middleware' => [
    'web',
    'auth',
    // ...
],

// В MoonShineServiceProvider
$config->middleware(['web', 'auth'])
       ->addMiddleware('custom-middleware')
       ->exceptMiddleware(['auth']);
```

<a name="authentication-settings"></a>
## Настройки аутентификации

### Установка guard

```php
// В moonshine.php
'auth' => [
    'guard' => 'admin',
    // ...
],

// В MoonShineServiceProvider
$config->guard('admin');
```

### Отключение встроенной аутентификации

```php
// В moonshine.php
'auth' => [
    'enable' => false,
    // ...
],

// В MoonShineServiceProvider
$config->authDisable();
```

<a name="routing-settings"></a>
## Настройки маршрутизации

### Установка префиксов

```php
// В moonshine.php
'prefix' => 'admin',
'page_prefix' => 'admin-page',

// В MoonShineServiceProvider
$config->prefixes('admin', 'admin-page');
```

### Установка домена

```php
// В moonshine.php
'domain' => 'admin.example.com',

// В MoonShineServiceProvider
$config->domain('admin.example.com');
```

<a name="localization-settings"></a>
## Настройки локализации

### Установка доступных локалей

```php
// В moonshine.php
'locales' => ['en', 'ru'],

// В MoonShineServiceProvider
$config->locales(['en', 'ru']);
```

<a name="additional-settings"></a>
## Дополнительные настройки

### Настройка хранилища

```php
// В moonshine.php
'disk' => 'public',
'disk_options' => [],

// В MoonShineServiceProvider
$config->disk('public', options: []);
```

### Настройка макета по умолчанию

```php
// В moonshine.php
'layout' => \App\MoonShine\Layouts\CustomLayout::class,

// В MoonShineServiceProvider
$config->layout(\App\MoonShine\Layouts\CustomLayout::class);
```

<a name="configuration-options"></a>
## Полный список параметров конфигурации

Ниже приведен полный список параметров конфигурации, доступных как в файле `moonshine.php`, так и через методы `MoonShineConfigurator`.

### Основные настройки

| Параметр в moonshine.php | Метод MoonShineConfigurator | Описание |
|--------------------------|---------------------------|-----------|
| `title` | `title(string $title)` | Заголовок приложения |
| `dir` | `dir(string $dir, string $namespace)` | Директория и пространство имен для компонентов MoonShine |
| `namespace` | `dir(string $dir, string $namespace)` | Директория и пространство имен для компонентов MoonShine |
| `disk` | `disk(string $disk, array $options = [])` | Диск для хранения файлов |
| `disk_options` | `disk(string $disk, array $options = [])` | Дополнительные опции для диска |
| `cache` | `cacheDriver(string $driver)` | Драйвер кэширования |
| `layout` | `layout(string $layout)` | Класс макета приложения |

### Настройки маршрутизации

| Параметр в moonshine.php | Метод MoonShineConfigurator | Описание |
|--------------------------|---------------------------|-----------|
| `domain` | `domain(string $domain)` | Домен для административной панели |
| `prefix` | `prefixes(string $route, string $page)` | Префикс маршрута |
| `page_prefix` | `prefixes(string $route, string $page)` | Префикс страницы |
| `middleware` | `middleware(array $middleware)` | Middleware для административной панели |
| - | `addMiddleware(array|string $middleware)` | Добавление middleware |
| - | `exceptMiddleware(array|string $except)` | Исключение middleware |
| `home_route` | `homeRoute(string $route)` | Домашний маршрут |

### Настройки аутентификации

| Параметр в moonshine.php | Метод MoonShineConfigurator | Описание |
|--------------------------|---------------------------|-----------|
| `auth.guard` | `guard(string $guard)` | Guard для аутентификации |
| `auth.enable` | `authDisable()` | Включение/отключение встроенной аутентификации |
| `user_fields` | `userField(string $field, string $value)` | Поля пользователя для аутентификации |
| `auth.middleware` | `authMiddleware(string $middleware)` | Middleware для аутентификации |
| `auth.pipelines` | `authPipelines(array $pipelines)` | Pipelines для аутентификации |

### Настройки локализации

| Параметр в moonshine.php | Метод MoonShineConfigurator | Описание |
|--------------------------|---------------------------|-----------|
| `locale` | `locale(string $locale)` | Текущая локаль |
| `locales` | `locales(array $locales)`, `addLocales(array $locales)` | Доступные локали |

### Дополнительные настройки

| Параметр в moonshine.php | Метод MoonShineConfigurator | Описание |
|--------------------------|---------------------------|-----------|
| `use_migrations` | `useMigrations()` | Использование миграций |
| `use_notifications` | `useNotifications()` | Использование уведомлений |
| `use_database_notifications` | - | Использование уведомлений базы данных |
| `not_found_exception` | `notFoundException(string $exception)` | class Исключение для страницы "не найдено" |

### Настройки ресурсов и страниц

| Параметр в moonshine.php | Метод MoonShineConfigurator | Описание |
|--------------------------|---------------------------|-----------|
| `pages` | - | Список страниц |
| `forms` | - | Список форм |
| - | `changePage(string $old, string $new)` | Изменение класса страницы |
| - | `authorizationRules(Closure $rule)` | Добавление правил авторизации |

> [!NOTE]
> Некоторые методы `MoonShineConfigurator` не имеют прямых аналогов в файле `moonshine.php` и наоборот. Это связано с различиями в подходах к конфигурации через файл и через код.

### Пример использования в MoonShineServiceProvider

```php
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function configure(MoonShineConfigurator $config): MoonShineConfigurator
    {
        return $config
            ->title('Мое приложение')
            ->dir('app/MoonShine', 'App\MoonShine')
            ->domain(env('MOONSHINE_DOMAIN'))
            ->prefix('admin')
            ->guard('moonshine')
            ->middleware(['web', 'auth'])
            ->layout(\App\MoonShine\Layouts\CustomLayout::class)
            ->locale('ru')
            ->locales(['en', 'ru'])
            ->useMigrations()
            ->useNotifications()
            ->cacheDriver('redis')
            ->authorizationRules(function($resource, $user, $ability) {
                // Ваши правила авторизации
            });
    }
}
```

Этот полный список параметров и методов позволяет настроить практически все аспекты работы MoonShine. Выбирайте те опции, которые наилучшим образом соответствуют требованиям вашего проекта.

<a name="choosing-configuration-method"></a>
## Выбор метода конфигурации

При выборе метода конфигурации важно учитывать следующее:

1. **Приоритет**: Конфигурация через `MoonShineServiceProvider` имеет приоритет над настройками в файле `moonshine.php`.

2. **Гибкость**: 
   - Полная конфигурация через `moonshine.php` дает четкий обзор всех настроек.
   - Частичная конфигурация через `moonshine.php` позволяет легко видеть, какие параметры были изменены.
   - Конфигурация через `MoonShineServiceProvider` предоставляет максимальную гибкость и возможность использовать логику при настройке.

3. **Простота поддержки**: 
   - Использование файла `moonshine.php` может быть проще для быстрых изменений и понимания общей структуры настроек.
   - `MoonShineServiceProvider` позволяет централизованно управлять настройками в одном месте в коде.

4. **Интеграция с кодом**: 
   - Конфигурация через `MoonShineServiceProvider` лучше интегрируется с остальным кодом приложения и позволяет использовать зависимости и сервисы Laravel.

Выберите метод, который лучше всего соответствует вашему стилю разработки и требованиям проекта. Вы также можете комбинировать эти подходы, например, используя файл `moonshine.php` для базовых настроек и `MoonShineServiceProvider` для более сложной конфигурации.

<a name="pages-forms"></a>
## Получение страниц и форм

MoonShine предоставляет удобные методы для получения страниц и форм в вашем приложении.

### Получение страниц

Метод `getPage` позволяет получить экземпляр страницы по её имени или использовать страницу по умолчанию.

```php
public function getPage(string $name, string $default, mixed ...$parameters): PageContract
```

Параметры:
- `$name`: Имя страницы в конфиге
- `$default`: Класс страницы по умолчанию, если не найдена в конфиге
- `$parameters`: Дополнительные параметры для конструктора страницы

Пример использования:

```php
// Helper

$customPage = moonshineConfig()->getPage('custom');
```

```php
// DI

use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;

/**
 * @param  MoonShineConfigurator  $configurator
 */
public function index(ConfiguratorContract $config)
{
  $customPage = $config->getPage('custom');
}
```

### Получение форм

Метод `getForm` позволяет получить экземпляр формы по её имени или использовать форму по умолчанию.

```php
public function getForm(string $name, string $default, mixed ...$parameters): FormBuilderContract
```

Параметры:
- `$name`: Имя формы в конфиге
- `$default`: Класс формы по умолчанию
- `$parameters`: Дополнительные параметры для конструктора формы

Пример использования:

```php
// Helper

$form = moonshineConfig()->getForm('login');
```

```php
// DI

use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;

/**
 * @param  MoonShineConfigurator  $configurator
 */
public function index(ConfiguratorContract $config)
{
  $form = $config->getForm('login');
}
```

### Объявление страниц и форм в конфигурации

Вы можете настроить соответствие между именами и классами страниц и форм в файле `moonshine.php`:

```php
return [
    // Другие настройки...

    'pages' => [
        'dashboard' => \App\MoonShine\Pages\DashboardPage::class,
        'custom' => \App\MoonShine\Pages\CustomPage::class,
    ],

    'forms' => [
        'login' => \App\MoonShine\Forms\LoginForm::class,
        'custom' => \App\MoonShine\Forms\CustomForm::class,
    ],
];
```

Это позволит вам легко получать нужные страницы и формы по их именам, используя методы `getPage` и `getForm`.
