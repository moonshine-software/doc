<x-page
    title="WYSIWYG"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#tinymce', 'label' => 'TinyMce'],
            ['url' => '#trix', 'label' => 'Trix'],
            ['url' => '#ckeditor', 'label' => 'CKEditor'],
            ['url' => '#quill', 'label' => 'Quill'],
        ]
    ]"
    :videos="[
        ['url' => 'https://www.youtube.com/embed/7HGaebxlcFM?start=360&end=479', 'title' => 'Screencasts: Поле TinyMce'],
    ]"
>

<x-extendby :href="route('moonshine.custom_page', 'fields-textarea')">
    Textarea
</x-extendby>

<x-sub-title id="tinymce">TinyMce</x-sub-title>

<x-code language="php">
use MoonShine\Fields\TinyMce; // [tl! focus]

//...
public function fields(): array
{
    return [
        TinyMce::make('Описание', 'description'), // [tl! focus]

        // Более расширенные настройки

        TinyMce::make('Text') // [tl! focus]
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

<x-image theme="light" src="{{ asset('screenshots/tinymce.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/tinymce_dark.png') }}"></x-image>

<x-p>
    Зарегистрируйтесь на <x-link link="https://www.tiny.cloud" target="_blank">Tiny.Cloud</x-link> и получите токен.
    После добавьте его в конфиг <code>config/moonshine.php</code>
</x-p>

<x-code language="php">
//...
'tinymce' => [
    'token' => 'YOUR_TOKEN' // [tl! focus]
]
//...
</x-code>

<x-sub-title>Laravel File manager</x-sub-title>
<x-link link="https://github.com/UniSharp/laravel-filemanager" target="_blank">Laravel FileManager</x-link>

<x-p>
    Если вы хотите использовать файловый менеджер в tinymce, то вам необходимо установить пакет Laravel FileManager
</x-p>

<x-sub-title hashtag="1">Установка</x-sub-title>

<x-code language="shell">
composer require unisharp/laravel-filemanager

php artisan vendor:publish --tag=lfm_config
php artisan vendor:publish --tag=lfm_public
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Обязательно установить флаг 'use_package_routes' в конфиге lfm в false, иначе кеширование роутов будет вызывать ошибку
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
// ..
Route::middleware('web')
    ->group(base_path('routes/web.php'));

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['moonshine']], function () {
    UniSharp\LaravelFilemanager\Lfm::routes();
}); // [tl! focus:-2]

// ..
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Роут файлового менеджера обязательно должен быть в группе middleware <code>moonshine</code>, а не в web!
</x-moonshine::alert>

<x-sub-title hashtag="3">Добавьте префикс в config/moonshine.php</x-sub-title>

<x-code language="php">
//...
'tinymce' => [
    'file_manager' => 'laravel-filemanager', // [tl! focus]
    // ...
]
//...
</x-code>

<x-sub-title id="trix">Trix</x-sub-title>

<x-p class="font-bold text-pink">
    Поле вынесено в отдельный пакет, перед использованием необходимо выполнить установку
</x-p>

<x-code language="shell">
composer require moonshine/trix
</x-code>

<x-code language="php">
use MoonShine\Trix\Fields\Trix; // [tl! focus]

//...
public function fields(): array
{
    return [
        Trix::make('Описание', 'description'), // [tl! focus]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/wysiwyg.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/wysiwyg_dark.png') }}"></x-image>

<x-sub-title id="ckeditor">CKEditor</x-sub-title>

<x-p class="font-bold text-pink">
    Поле вынесено в отдельный пакет, перед использованием необходимо выполнить установку
</x-p>

<x-code language="shell">
composer require moonshine/ckeditor
</x-code>

<x-code language="php">
use MoonShine\CKEditor\Fields\CKEditor; // [tl! focus]

//...
public function fields(): array
{
    return [
        CKEditor::make('Описание', 'description'), // [tl! focus]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/ckeditor.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/ckeditor_dark.png') }}"></x-image>

<x-sub-title id="quill">Quill</x-sub-title>

<x-p class="font-bold text-pink">
    Поле вынесено в отдельный пакет, перед использованием необходимо выполнить установку
</x-p>

<x-code language="shell">
    composer require moonshine/quill
</x-code>

<x-code language="php">
use MoonShine\Quill\Fields\Quill; // [tl! focus]

//...
public function fields(): array
{
    return [
        Quill::make('Описание', 'description'), // [tl! focus]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/quill.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/quill_dark.png') }}"></x-image>

</x-page>
