<x-page
    title="WYSIWYG"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#settings', 'label' => 'Конфигурация'],
            ['url' => '#custom-config', 'label' => 'Дополнительные настройки'],
            ['url' => '#filemanager', 'label' => 'File manager'],
        ]
    ]"
>

<x-extendby :href="to_page('fields-textarea')">
    Textarea
</x-extendby>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    <em>TinyMce</em> - один из самых популярных веб-редакторов,
    для использования его в админ-панели <strong>MoonShine</strong> существует одноименное поле.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Перед тем как воспользоваться данным полем, необходимо зарегистрироваться на сайте на
    <x-link link="https://www.tiny.cloud" target="_blank">Tiny.Cloud</x-link>,
    получить токен и добавить его в конфиг <code>config/moonshine.php</code>.
</x-moonshine::alert>

<x-code language="php">
'tinymce' => [
    'token' => 'YOUR_TOKEN' // [tl! focus]
]
</x-code>

<x-code language="php">
use MoonShine\Fields\TinyMce; // [tl! focus]

//...

public function fields(): array
{
    return [
        TinyMce::make('Description') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/tinymce.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/tinymce_dark.png') }}"></x-image>

<x-sub-title id="settings">Конфигурация</x-sub-title>

<x-code language="php">
use MoonShine\Fields\TinyMce;

//...

public function fields(): array
{
    return [
        TinyMce::make('Description')
            // Переопределить набор плагинов
            ->plugins('anchor') // [tl! focus]
            // Добавление плагинов в базовый набор
            ->addPlugins('code codesample') // [tl! focus]
            // Переопределить набор toolbar
            ->toolbar('undo redo | blocks fontfamily fontsize') // [tl! focus]
            // Добавление toolbar в базовый набор
            ->addToolbar('code codesample') // [tl! focus]
            // Для изменения имени автора для плагина tinycomments
            ->commentAuthor('Danil Shutsky') // [tl! focus]
            // Теги
            ->mergeTags([
                ['value' => 'tag', 'title' => 'Title']
            ]) // [tl! focus:-2]
            // Переопределение текущей локали
            ->locale('en'), // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Файлы переводов размещаются в директории <code>public/vendor/moonshine/libs/tinymce/langs</code>.
</x-moonshine::alert>

<x-sub-title id="custom-config">Дополнительные настройки</x-sub-title>

<x-p>
    Метод <code>addConfig()</code> позволяет расширенно сконфигурировать <em>TinyMce</em>.
</x-p>

<x-code language="php">
addConfig(string $name, bool|int|float|string $value);
</x-code>

<x-code language="php">
use MoonShine\Fields\TinyMce;

//...

public function fields(): array
{
    return [
        TinyMce::make('Description')
            ->addConfig('extended_valid_elements', 'script[src|async|defer|type|charset]') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="filemanager">File manager</x-sub-title>

<x-p>
    Если вы хотите использовать файловый менеджер в <em>TinyMce</em>, то вам необходимо установить пакет
    <x-link link="https://github.com/UniSharp/laravel-filemanager" target="_blank">Laravel FileManager</x-link>.
</x-p>

<x-moonshine::divider label="Установка" />

<x-code language="shell">
composer require unisharp/laravel-filemanager

php artisan vendor:publish --tag=lfm_config
php artisan vendor:publish --tag=lfm_public
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Обязательно установить флаг 'use_package_routes' в конфиге lfm в false, иначе кеширование роутов будет вызывать ошибку.
</x-moonshine::alert>

<x-code language="php">
return [
    // ...

    'use_package_routes' => false, // [tl! focus]

    // ...
];
</x-code>

<x-moonshine::divider label="Файл маршрутов" />

<x-p>
    Создайте файл маршрутов, например <code>routes/moonshine.php</code>
    и зарегистрируйте маршруты <em>LaravelFilemanager</em>.
</x-p>

<x-code language="php">
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

Route::prefix('laravel-filemanager')->group(function () {
    Lfm::routes();
});
</x-code>

<x-moonshine::divider label="Регистрация файла" />

<x-p>
    Зарегистрируйте созданный файл маршрутов в <code>app/Providers/RouteServiceProvider.php</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Файл маршрутов обязательно должен быть в группе middleware <code>moonshine</code>!
</x-moonshine::alert>

<x-code language="php">
// ...

public function boot()
{
    // ...

    $this->routes(function () {
        // ...

        Route::middleware('moonshine')
            ->namespace($this->namespace)
            ->group(base_path('routes/moonshine.php')); // [tl! focus:-2]
    });
}

// ...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Для того чтобы разрешить доступ только авторизованным в админ-панели пользователям
    необходимо добавить middleware <code>MoonShine\Http\Middleware\Authenticate</code>.
</x-moonshine::alert>

<x-code language="php">
use MoonShine\Http\Middleware\Authenticate; // [tl! focus]

// ...

public function boot()
{
    // ...

    $this->routes(function () {
        // ...

        Route::middleware(['moonshine', Authenticate::class]) // [tl! focus]
            ->namespace($this->namespace)
            ->group(base_path('routes/moonshine.php'));
    });
}

// ...
</x-code>

<x-moonshine::divider label="Конфигурация" />

<x-p>
    В файле конфигурации <code>config/moonshine.php</code> необходимо добавить префикс.
</x-p>

<x-code language="php">
'tinymce' => [
    'file_manager' => 'laravel-filemanager', // [tl! focus]
]
</x-code>

</x-page>
