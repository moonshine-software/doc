# TinyMce  

- [Make](#make)  
- [Configuration](#settings)  
- [Additional settings](#custom-config)  
- [File manager](#filemanager)  

---

Extends [Textarea](https://moonshine-laravel.com/docs/resource/fields/fields-textarea)
* has the same features

<a name="make"></a>  
## Make  

*TinyMce* is one of the most popular web editors. To use it in the **MoonShine** admin panel, there is a field of the same name.  

> [!NOTE]
> Before using this field, you must register on the site at [Tiny.Cloud](https://www.tiny.cloud/) , get the token and add it to the `config/moonshine.php` config.

```php
'tinymce' => [
    'token' => 'YOUR_TOKEN'
]
```

```php
use MoonShine\Fields\TinyMce;

//...

public function fields(): array
{
    return [
        TinyMce::make('Description')
    ];
}

//...
```
![tinymce](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/tinymce.png)
![tinymce_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/tinymce_dark.png)

<a name="settings"></a>  
## Configuration  

#### Language  
 
 ```php
 locale(string $locale)
 ```

#### Plugins 
```php
plugins(string|array $plugins)
```

```php
addPlugins(string|array $plugins)
```

```php
removePlugins(string|array $plugins)
```

#### Menubar

```php
menubar(string $menubar)
```

#### Toolbar

```php
toolbar(string $toolbar)
```

```php
addToolbar(string $toolbar)
```

#### Options

```php
addConfig(string $name, mixed $value)
```

#### Tiny Comments

```php
commentAuthor(string $commentAuthor)
```

#### Tags
```php
mergeTags(array $mergeTags)
```

```php
use MoonShine\Fields\TinyMce;

//...

public function fields(): array
{
    return [
        TinyMce::make('Description')
            // Override plugin set
            ->plugins('anchor autoresize')
            // Adding plugins to the base set
            ->addPlugins('code codesample')
            // Removing plugins from the base set
            ->removePlugins('autoresize')
            // Override toolbar set
            ->toolbar('undo redo | blocks fontfamily fontsize')
            // Adding a toolbar to the base set
            ->addToolbar('code codesample')
            // To change the author name for the tinycomments plugin
            ->commentAuthor('Danil Shutsky')
            // Tags
            ->mergeTags([
                ['value' => 'tag', 'title' => 'Title']
            ])
            // Adding configuration
            ->addConfig('codesample_languages', [['text' => 'HTML/XML', 'value' => 'markup']])
            ->addConfig('force_br_newlines', true)
            // Overriding the current locale
            ->locale('en'),
    ];
}

//...
```

> [!TIP]
> Translation files are located in the `public/vendor/moonshine/libs/tinymce/langs` directory.

<a name="custom-config"></a>  
## Additional settings 

The `addConfig()` method allows for advanced configuration of *TinyMce*.  

```php
addConfig(string $name, bool|int|float|string $value);
```

```php
use MoonShine\Fields\TinyMce;

//...

public function fields(): array
{
    return [
        TinyMce::make('Description')
            ->addConfig('extended_valid_elements', 'script[src|async|defer|type|charset]')
    ];
}

//...
```

<a name="filemanager"></a>  
## File manager  

If you want to use the file manager in *TinyMce*, then you need to install the package [Laravel FileManager](https://github.com/UniSharp/laravel-filemanager)

#### Installation 
 
```php
composer require unisharp/laravel-filemanager

php artisan vendor:publish --tag=lfm_config
php artisan vendor:publish --tag=lfm_public
```

> [!TIP]
> Be sure to set the 'use_package_routes' flag in the lfm config to false, otherwise caching routes will cause an error.

```php
return [
    // ...

    'use_package_routes' => false,

    // ...
];
```

#### Routes file

Create a routes file like `routes/moonshine.php` and register the *LaravelFilemanager* routes.

```php
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

Route::prefix('laravel-filemanager')->group(function () {
    Lfm::routes();
});
```

#### File registration

Register the generated routes file in `app/Providers/RouteServiceProvider.php`.

> [!TIP]
> The route file must be in the middleware `moonshine` group!

```php
// ...

public function boot()
{
    // ...

    $this->routes(function () {
        // ...

        Route::middleware('moonshine')
            ->namespace($this->namespace)
            ->group(base_path('routes/moonshine.php'));
    });
}

// ...
```

> [!TIP]
> In order to allow access only to users authorized in the admin panel you need to add middleware `MoonShine\Http\Middleware\Authenticate`.

```php
use MoonShine\Http\Middleware\Authenticate;

// ...

public function boot()
{
    // ...

    $this->routes(function () {
        // ...

        Route::middleware(['moonshine', Authenticate::class])
            ->namespace($this->namespace)
            ->group(base_path('routes/moonshine.php'));
    });
}
// ...
```

#### Configuration

You need to add a prefix in the `config/moonshine.php` configuration file.
 
 ```php
 'tinymce' => [
    'file_manager' => 'laravel-filemanager',
]
```