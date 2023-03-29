<x-page title="WYSIWYG" :sectionMenu="[
'Разделы' => [
    ['url' => '#trix', 'label' => 'Trix'],
    ['url' => '#ckeditor', 'label' => 'CKEditor'],
    ['url' => '#quill', 'label' => 'Quill'],
    ['url' => '#tinymce', 'label' => 'TinyMce'],
]
]">

<x-sub-title id="trix">Trix</x-sub-title>

<x-code language="php">
use Leeto\MoonShine\Fields\WYSIWYG;

//...
public function fields(): array
{
    return [
        WYSIWYG::make('Описание', 'description'),
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/wysiwyg.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/wysiwyg_dark.png') }}"></x-image>

<x-sub-title id="ckeditor">CKEditor</x-sub-title>

<x-code language="php">
use Leeto\MoonShine\Fields\CKEditor;

//...
public function fields(): array
{
    return [
        CKEditor::make('Описание', 'description'),
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/ckeditor.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/ckeditor_dark.png') }}"></x-image>

<x-sub-title id="quill">Quill</x-sub-title>

<x-code language="php">
use Leeto\MoonShine\Fields\Quill;

//...
public function fields(): array
{
    return [
        Quill::make('Описание', 'description'),
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/quill.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/quill_dark.png') }}"></x-image>

<x-sub-title id="tinymce">TinyMce</x-sub-title>

<x-code language="php">
use Leeto\MoonShine\Fields\TinyMce;

//...
public function fields(): array
{
    return [
        TinyMce::make('Описание', 'description'),

        // Более расширенные настройки

        TinyMce::make('Text')
            // Переопределить набор плагинов
            ->plugins('anchor')
            // Добавление плагинов в базовый набор
            ->addPlugins('code codesample')
            // Переопределить набор toolbar
            ->toolbar('undo redo | blocks fontfamily fontsize')
            // Добавление toolbar в базовый набор
            ->addToolbar('code codesample')
            //Для измнения имени автора для плагина tinycomments
            ->commentAuthor('Danil Shutsky')
            //Теги
            ->mergeTags([
                ['value' => 'tag', 'title' => 'Title']
            ]),
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/tinymce.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/tinymce_dark.png') }}"></x-image>

<x-p>
    Зарегистрируйтесь на <x-link link="https://www.tiny.cloud" target="_blank">Tiny.Cloud</x-link> и получите токен.
    После добавьте его в конфиг <code>config/moonshine.php</code>
</x-p>

<x-code language="php">
    //...
    'tinymce' => [
        'token' => 'YOUR_TOKEN'
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
    // ..

    'use_package_routes' => false,

    // ..
];

</x-code>

<x-sub-title hashtag="2">Добавьте роуты в routes/web.php</x-sub-title>

<x-code language="php">
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'moonshine']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
</x-code>

<x-sub-title hashtag="3">Добавьте префикс в config/moonshine.php</x-sub-title>

<x-code language="php">
    //...
    'tinymce' => [
        'file_manager' => 'laravel-filemanager',
        // ..
    ]
    //...
</x-code>

</x-page>
