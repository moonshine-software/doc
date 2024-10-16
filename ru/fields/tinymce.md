# TinyMce  

- [Создание](#make)  
- [Конфигурация](#settings)  
- [Дополнительные настройки](#custom-config)  
- [Файловый менеджер](#filemanager)  

---

Расширяет [Textarea](/docs/{{version}}/fields/textarea)
* имеет те же функции

<a name="make"></a>  
## Создание  

*TinyMce* - один из самых популярных веб-редакторов. Для его использования в админ-панели **MoonShine** есть одноименное поле.  

> [!NOTE]
> Перед использованием этого поля вы должны зарегистрироваться на сайте [Tiny.Cloud](https://www.tiny.cloud/), получить токен и добавить его в конфигурацию `config/moonshine.php`.

```php
'tinymce' => [
    'token' => 'ВАШ_ТОКЕН'
]
```

```php
use MoonShine\Fields\TinyMce;

//...

public function fields(): array
{
    return [
        TinyMce::make('Описание')
    ];
}

//...
```
![tinymce](https://moonshine-laravel.com/screenshots/tinymce.png)
![tinymce_dark](https://moonshine-laravel.com/screenshots/tinymce_dark.png)

<a name="settings"></a>  
## Конфигурация  

#### Язык  
 
 ```php
 locale(string $locale)
 ```

#### Плагины 
```php
plugins(string|array $plugins)
```

```php
addPlugins(string|array $plugins)
```

```php
removePlugins(string|array $plugins)
```

#### Меню

```php
menubar(string $menubar)
```

#### Панель инструментов

```php
toolbar(string $toolbar)
```

```php
addToolbar(string $toolbar)
```

#### Опции

```php
addConfig(string $name, mixed $value)
```

#### Комментарии Tiny

```php
commentAuthor(string $commentAuthor)
```

#### Теги
```php
mergeTags(array $mergeTags)
```

```php
use MoonShine\Fields\TinyMce;

//...

public function fields(): array
{
    return [
        TinyMce::make('Описание')
            // Переопределение набора плагинов
            ->plugins('anchor autoresize')
            // Добавление плагинов к базовому набору
            ->addPlugins('code codesample')
            // Удаление плагинов из базового набора
            ->removePlugins('autoresize')
            // Переопределение набора панели инструментов
            ->toolbar('undo redo | blocks fontfamily fontsize')
            // Добавление панели инструментов к базовому набору
            ->addToolbar('code codesample')
            // Изменение имени автора для плагина tinycomments
            ->commentAuthor('Данил Шутский')
            // Теги
            ->mergeTags([
                ['value' => 'tag', 'title' => 'Заголовок']
            ])
            // Добавление конфигурации
            ->addConfig('codesample_languages', [['text' => 'HTML/XML', 'value' => 'markup']])
            ->addConfig('force_br_newlines', true)
            // Переопределение текущей локали
            ->locale('ru'),
    ];
}

//...
```
> [!TIP]
> Файлы переводов находятся в директории `public/vendor/moonshine/libs/tinymce/langs`.

<a name="custom-config"></a>  
## Дополнительные настройки 

Метод `addConfig()` позволяет выполнить расширенную настройку *TinyMce*.  

```php
addConfig(string $name, bool|int|float|string $value);
```

```php
use MoonShine\Fields\TinyMce;

//...

public function fields(): array
{
    return [
        TinyMce::make('Описание')
            ->addConfig('extended_valid_elements', 'script[src|async|defer|type|charset]')
    ];
}

//...
```
<a name="filemanager"></a>  
## Файловый менеджер  

Если вы хотите использовать файловый менеджер в *TinyMce*, то вам нужно установить пакет [Laravel FileManager](https://github.com/UniSharp/laravel-filemanager)

#### Установка  
```php
composer require unisharp/laravel-filemanager

php artisan vendor:publish --tag=lfm_config
php artisan vendor:publish --tag=lfm_public
```

> [!TIP]
> Обязательно установите флаг 'use_package_routes' в конфигурации lfm в значение false, иначе кэширование маршрутов вызовет ошибку.

```php
return [
    // ...

    'use_package_routes' => false,

    // ...
];
```

#### Файл маршрутов

Создайте файл маршрутов, например `routes/moonshine.php`, и зарегистрируйте маршруты *LaravelFilemanager*.

```php
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

Route::prefix('laravel-filemanager')->group(function () {
    Lfm::routes();
});
```

#### Регистрация файла

Зарегистрируйте созданный файл маршрутов в `app/Providers/RouteServiceProvider.php`.

> [!TIP]
> Файл маршрутов должен быть в группе middleware `moonshine`!

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
> Чтобы разрешить доступ только авторизованным в админ-панели пользователям, необходимо добавить middleware `MoonShine\Http\Middleware\Authenticate`.

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

#### Конфигурация
Необходимо добавить префикс в конфигурационный файл `config/moonshine.php`.
 
 ```php
 'tinymce' => [
    'file_manager' => 'laravel-filemanager',
]
```
