<x-page title="WYSIWYG" :sectionMenu="[
'Разделы' => [
    ['url' => '#start', 'label' => 'Trix/CKEditor/Quill'],
    ['url' => '#tinymce', 'label' => 'TinyMce'],
]
]">

<x-sub-title id="start">Trix/CKEditor/Quill</x-sub-title>

<x-code language="php">
use Leeto\MoonShine\Fields\WYSIWYG;
use Leeto\MoonShine\Fields\CKEditor;
use Leeto\MoonShine\Fields\Quill;

//...
public function fields(): array
{
    return [
        WYSIWYG::make('Описание', 'description'), // Trix
        // или
        CKEditor::make('Описание', 'description'), // CKEditor
        // или
        Quill::make('Описание', 'description'), // Quill
    ];
}

//...
</x-code>

<x-image src="{{ asset('screenshots/wysiwyg.png') }}"></x-image>

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

<x-p>
    Настройки <x-link link="https://github.com/UniSharp/laravel-filemanager" target="_blank">Laravel FileManager</x-link> располагаются <code>config/lfm.php</code>
</x-p>

<x-alert>
    Если moonshine:install производился до версии 1.17.0 необходимо опубликовать конфиги самостоятельно или запустить установку
</x-alert>

<x-code language="shell">
php artisan vendor:publish --tag=lfm_config
php artisan vendor:publish --tag=lfm_public
</x-code>

<x-next href="{{ route('section', 'fields-code') }}">Код</x-next>

</x-page>



