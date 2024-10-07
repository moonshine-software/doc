# AssetsManager

  - [Глобальные ресурсы](#global-assets)
  - [Ресурсы для ресурса/страницы](#assets-for-a-resourcepage)
  - [Vite](#vite)
  - [Конфигурация](#configuration)
  - [Директива](#directive)

---

Вы можете подключить любые ваши *css* и *js* файлы к MoonShine.

<a name="global-assets"></a>
## Глобальные ресурсы

Если вам нужно опубликовать ресурсы глобально для всех страниц, то вы можете добавить их в `MoonShineServiceProvider`.

```php
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...

    public function boot(): void
    {
        parent::boot();

        moonShineAssets()->add([
            '/css/style.css',
            '/js/main.js',
        ]);
    }

    //...
}
```

<a name="assets-for-a-resourcepage"></a>
## Ресурсы для ресурса/страницы

Ресурсы можно добавить для ресурса или для отдельной страницы. Для этого необходимо указать свойство `$assets`.

```php
class Post extends ModelResource
{
    protected array $assets = [
        '/css/style.css',
        '/js/main.js',
    ];

    //...
}
```

<a name="vite"></a>
## Vite

Вы также можете добавить свои собственные ресурсы Vite:

```php
use Illuminate\Support\Facades\Vite;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...

    public function boot(): void
    {
        parent::boot();

        moonShineAssets()->add([
            Vite::asset('resources/js/app.js')
        ]);
    }

    //...
}
```

<a name="configuration"></a>
## Конфигурация

Вы можете настроить подключение ресурсов в файле конфигурации `config/moonshine.php`.

```php
// ...

return [
    // ...

    'assets' => [
        'js' => [
            'script_attributes' => [
                'defer',
                'type' => 'module'
            ]
        ],
        'css' => [
            'link_attributes' => [
                'rel' => 'stylesheet'
            ]
        ]
    ],

    // ...
];
```

<a name="directive"></a>
## Директива

Если вы хотите использовать стили и скрипты **MoonShine** вне административной панели, то вам нужно включить директиву `@moonShineAssets`.

```php
<head>
    @moonShineAssets
</head>
```
