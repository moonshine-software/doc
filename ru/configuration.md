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
- [Выбор метода конфигурации](#choosing-configuration-method)

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
    'guard' => 'moonshine',
    'auth' => [
        'enable' => true,
        'fields' => [
            'username' => 'email',
            'password' => 'password',
        ],
    ],
    'middlewares' => [
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
            ->middlewares([
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
'middlewares' => [
    'web',
    'auth',
    // ...
],

// В MoonShineServiceProvider
$config->middlewares(['web', 'auth'])
       ->addMiddlewares('custom-middleware')
       ->exceptMiddlewares(['auth']);
```

<a name="authentication-settings"></a>
## Настройки аутентификации

### Установка guard

```php
// В moonshine.php
'guard' => 'admin',

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

// В MoonShineServiceProvider
$config->disk('public');
```

### Настройка макета

```php
// В moonshine.php
'layout' => \App\MoonShine\Layouts\CustomLayout::class,

// В MoonShineServiceProvider
$config->layout(\App\MoonShine\Layouts\CustomLayout::class);
```

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
