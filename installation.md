# AssetsManager

## Sections

- [Global assets](#global)
- [Assets for the resource/page](#resource-page)
- [Vite](#vite)
- [Configuration](#config)
- [Directive](#directive)

---

You can connect any of your *css* and *js* files to MoonShine.

<a name=”global”></a>
## Global assets

If you need to publish assets globally for all pages, then you can add them to `MoonShineServiceProvider`.

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

<a name=”resource-page”></a>
## Assets for a resource/page

Assets can be added for a resource or for a separate page, To do this, you need to specify the `$assets` property.

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

```php
class MyPage extends Page
{
    protected array $assets = [
        '/css/style.css',
        '/js/main.js',
    ];

    //...
}
```

<a name=”vite”></a>
## Vite

You can also add your own Vite assets:

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

<a name=”config”></a>
## Configuration

You can configure the connection of assets in the configuration file `config/moonshine.php`

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

<a name=”directive”></a>
## Directive

If you want to use **MoonShine** styles and scripts outside the admin panel, then you need to include the `@moonShineAssets` directive.

```html
<head>
    @moonShineAssets
</head>
```

---

[Appearance - LayoutBuilder](https://moonshine-laravel.com/docs/resource/appearance/appearance-layout_builder)
[Appearance - Icons](https://moonshine-laravel.com/docs/resource/appearance/icons)
