# API

- [Основы](#basics)
- [JWT](#jwt)
- [OpenApi генератор](#oag)

---

<a name="basics"></a>
## Основы

**MoonShine** дает возможность переключения административной панели в режим `API`.
Для этого достаточно в заголовок запроса добавить `Accept: application/json`, после чего `CRUD` операции будут возвращать `json` ответы.
Также мы поставляем инструменты, дающие возможность переключения аутентификации на `JWT` токены, а также генерацию `OpenApi` спецификации и документацию на основе ресурсов.

> [!NOTE]
> При полноценном использовании **MoonShine** в режиме API не забудьте отключить сессионные middleware в конфигурации **MoonShine**.

> [!TIP]
> Обратите также внимание на раздел [SDUI](/docs/{{version}}/frontend/sdui).

<a name="jwt"></a>
## JWT

**MoonShine** также предоставляет простой способ переключить панель администратора в режим `API` и взаимодействовать через токены.

Установка:

```shell
composer require moonshine/jwt
```

Далее опубликуйте конфиг:

```shell
php artisan vendor:publish --provider="MoonShine\JWT\Providers\JWTServiceProvider"
```

Далее добавьте в `.env` секретный ключ в `base64`:

```ini
JWT_SECRET=YOUR_BASE64_SECRET_HERE
```

Далее измените набор `middleware` в системе и добавьте `authPipeline` и `authMiddleware`:

~~~tabs
tab: config/moonshine.php
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\JWT\JWTAuthPipe;
use MoonShine\JWT\Http\Middleware\AuthenticateApi;

return [
    'middleware' => [
        AuthenticateApi::class
    ],
    'auth' => [
        // ...
        'pipelines' => [
            JWTAuthPipe::class
        ],
    ]
    // ...
];
```
tab: MoonShineServiceProvider
```php
use MoonShine\JWT\JWTAuthPipe;
use MoonShine\JWT\Http\Middleware\AuthenticateApi;

$config
    ->authPipelines([JWTAuthPipe::class])
    ->middlewares([])
    ->authMiddleware(AuthenticateApi::class);
```
~~~

Всё готово! При успешной аутентификации вы получите токен, который в последующем можно использовать в заголовке `Authorization: Bearer <token>`.

<a name="oag"></a>
## OpenApi генератор

Установка:

```shell
composer require moonshine/oag
```

Далее опубликуйте конфиг:

```shell
php artisan vendor:publish --provider="MoonShine\OAG\Providers\OAGServiceProvider"
```

Конфигурация уже настроена, в особых случаях вы можете переопределить определенные настройки:

```php
return [
    // Заголовок документации
    'title' => 'Docs',
    // Путь расположения спецификации
    'path' => realpath(
        resource_path('oag.yaml')
    ),
    // Роут получения данных для документации
    'route' => 'oag.json',
    // view для документации
    'view' => 'oag::docs',
];
```

Далее на основе объявленных и настроенных ресурсов в системе будет сформирована спецификация:

```shell
php artisan oag:generate
```

Файлы спецификации по умолчанию располагаются в директории `resources`:

- `resources/oag.yaml`,
- `resources/oag.json`.

Документация доступна по адресу `/docs`.
