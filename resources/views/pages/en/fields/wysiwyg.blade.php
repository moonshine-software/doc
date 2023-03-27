<x-page title="WYSIWYG" :sectionMenu="[
'Sections' => [
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
        WYSIWYG::make('Description', 'description'), // Trix
        // или
        CKEditor::make('Description', 'description'), // CKEditor
        // или
        Quill::make('Description', 'description'), // Quill
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
        TinyMce::make('Description', 'description'),

        // More advanced settings

        TinyMce::make('Text')
            // Override the plugin set
            ->plugins('anchor')
            // Adding plugins to the base set
            ->addPlugins('code codesample')
            // Override the set toolbar
            ->toolbar('undo redo | blocks fontfamily fontsize')
            // Adding a toolbar to the base set
            ->addToolbar('code codesample')
            //To change the author name for a plugin tinycomments
            ->commentAuthor('Danil Shutsky')
            //Tags
            ->mergeTags([
                ['value' => 'tag', 'title' => 'Title']
            ]),
    ];
}

//...
</x-code>

<x-p>
    Sign up at <x-link link="https://www.tiny.cloud" target="_blank">Tiny.Cloud</x-link> and get a token. Then add it to config <code>config/moonshine.php</code>
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
    If you want to use the file manager in tinymce, you need to install the Laravel FileManager package
</x-p>

<x-sub-title hashtag="1">Installing</x-sub-title>

<x-code language="shell">
    composer require unisharp/laravel-filemanager

    php artisan vendor:publish --tag=lfm_config
    php artisan vendor:publish --tag=lfm_public
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Be sure to set the 'use_package_routes' flag in the lfm config to false, otherwise the caching of routers will cause an error
</x-moonshine::alert>

<x-code language="php">
return [
    // ..

    'use_package_routes' => false,

    // ..
];

</x-code>

<x-sub-title hashtag="2">Add routers to the routes/web.php</x-sub-title>

<x-code language="php">
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'moonshine']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
    });
</x-code>

<x-sub-title hashtag="3">Add the prefix to config/moonshine.php</x-sub-title>
    
<x-code language="php">
    //...
    'tinymce' => [
        'file_manager' => 'laravel-filemanager',
        // ..
    ]
    //...
</x-code>

</x-page>



