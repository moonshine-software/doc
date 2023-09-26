<x-page
    title="WYSIWYG"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#settings', 'label' => 'Расширенные настройки'],
            ['url' => '#filemanager', 'label' => 'File manager'],
        ]
    ]"
>

<x-extendby :href="route('moonshine.custom_page', 'fields-textarea')">
    Textarea
</x-extendby>

<x-p>
    <em>TinyMce</em> - один из самых популярных веб-редакторов,
    для использования его в админ-панели <strong>MoonShine</strong> существует одноименное поле.
</x-p>

<x-p>
    Перед тем как воспользоваться данным полем, необходимо зарегистрироваться на сайте на
    <x-link link="https://www.tiny.cloud" target="_blank">Tiny.Cloud</x-link>,
    получить токен и добавить его в конфиг <code>config/moonshine.php</code>.
</x-p>

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

<x-sub-title id="settings">Расширенные настройки</x-sub-title>

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
    Файлы переводов размещаются в директории <code>public/vendor/moonshine/libs/tinymce/langs</code>
</x-moonshine::alert>

<x-sub-title id="filemanager">File manager</x-sub-title>

<x-p>
    Если вы хотите использовать файловый менеджер в <em>TinyMce</em>, то вам необходимо установить пакет Laravel FileManager.
</x-p>

<x-link link="https://github.com/UniSharp/laravel-filemanager" target="_blank">Laravel FileManager</x-link>

<x-sub-title hashtag="1">Установка</x-sub-title>

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

<x-sub-title hashtag="2">Add routes to the app/Providers/RouteServiceProvider.php</x-sub-title>

<x-code language="php">
// ...

Route::middleware('web')
    ->group(base_path('routes/web.php'));

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['moonshine', 'auth.moonshine']], function () {
    UniSharp\LaravelFilemanager\Lfm::routes();
}); // [tl! focus:-2]

// ...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Роут файлового менеджера обязательно должен быть в группе middleware <code>moonshine</code>, а не в web!
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Для того чтобы разрешить доступ только авторизованным в админ-панели пользователям
    необходимо использовать middleware <code>auth.moonshine</code>
</x-moonshine::alert>

<x-sub-title hashtag="3">Добавьте префикс в config/moonshine.php</x-sub-title>

<x-code language="php">
'tinymce' => [
    'file_manager' => 'laravel-filemanager', // [tl! focus]
]
</x-code>

</x-page>
