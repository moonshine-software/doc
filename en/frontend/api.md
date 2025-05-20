# API

- [Basics](#basics)
- [JWT](#jwt)
- [OpenApi Generator](#oag)

---

<a name="basics"></a>
## Basics

**MoonShine** allows you to switch the admin panel to `API` mode.
To do this, simply add `Accept: application/json` to the request header, after which `CRUD` operations will return `json` responses.
We also provide tools that allow you to switch authentication to `JWT` tokens, as well as generate `OpenApi` specifications and documentation based on resources.

> [!NOTE]
> When fully using **MoonShine** in API mode, don't forget to disable session middleware in the **MoonShine** configuration.

> [!TIP]
> Also, take a look at the [SDUI](/docs/{{version}}/frontend/sdui) section.

<a name="jwt"></a>
## JWT

**MoonShine** also provides a simple way to switch the admin panel to `API` mode and interact via tokens.

Installation:

```shell
composer require moonshine/jwt
```

Next, publish the config:

```shell
php artisan vendor:publish --provider="MoonShine\JWT\Providers\JWTServiceProvider"
```

Then add the secret key in `base64` to `.env`:

```ini
JWT_SECRET=YOUR_BASE64_SECRET_HERE
```

Next, change the set of `middleware` in the system and add `authPipeline` and `authMiddleware`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\JWT\JWTAuthPipe;
use MoonShine\JWT\Http\Middleware\AuthenticateApi;

return [
    'middleware' => [
        // empty
    ],
    'auth' => [
        // ...
        'middleware' => AuthenticateApi::class,
        'pipelines' => [
            JWTAuthPipe::class
        ],
    ]
    // ...
];
```

All set! Upon successful authentication, you will receive a token, which can subsequently be used in the header `Authorization: Bearer <token>`.

<a name="oag"></a>
## OpenApi Generator

Installation:

```shell
composer require moonshine/oag
```

Next, publish the config:

```shell
php artisan vendor:publish --provider="MoonShine\OAG\Providers\OAGServiceProvider"
```

The configuration is already set up; in special cases, you can override specific settings:

```php
return [
    // Documentation title
    'title' => 'Docs',
    // Location path for the specification
    'path' => realpath(
        resource_path('oag.yaml')
    ),
    // Route to retrieve data for documentation
    'route' => 'oag.json',
    // View for documentation
    'view' => 'oag::docs',
];
```

Next, based on the declared and configured resources in the system, a specification will be generated:

```shell
php artisan oag:generate
```

The specification files are by default located in the `resources` directory:

- `resources/oag.yaml`,
- `resources/oag.json`.

Documentation is available at the address `/docs`.
