<x-page
    title="WYSIWYG"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#settings', 'label' => 'Configuration'],
            ['url' => '#custom-config', 'label' => 'Additional settings'],
            ['url' => '#filemanager', 'label' => 'File manager'],
        ]
    ]"
>

<x-extendby :href="to_page('fields-textarea')">
    Textarea
</x-extendby>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    <em>TinyMce</em> is one of the most popular web editors,
    To use it in the <strong>MoonShine</strong> admin panel, there is a field of the same name.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Before using this field, you must register on the site at
    <x-link link="https://www.tiny.cloud" target="_blank">Tiny.Cloud</x-link>,
    get the token and add it to the <code>config/moonshine.php</code> config.
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

<x-sub-title id="settings">Configuration</x-sub-title>

<x-moonshine::divider label="Language" />

<x-code language="php">
locale(string $locale)
</x-code>

<x-moonshine::divider label="Plugins" />

<x-code language="php">
plugins(string|array $plugins)
</x-code>

<x-code language="php">
addPlugins(string|array $plugins)
</x-code>

<x-code language="php">
removePlugins(string|array $plugins)
</x-code>

<x-moonshine::divider label="Menubar" />

<x-code language="php">
menubar(string $menubar)
</x-code>

<x-moonshine::divider label="Toolbar" />

<x-code language="php">
toolbar(string $toolbar)
</x-code>

<x-code language="php">
addToolbar(string $toolbar)
</x-code>

<x-moonshine::divider label="Options" />

<x-code language="php">
addConfig(string $name, mixed $value)
</x-code>

<x-moonshine::divider label="Tiny Comments" />

<x-code language="php">
commentAuthor(string $commentAuthor)
</x-code>

<x-moonshine::divider label="Tags" />

<x-code language="php">
mergeTags(array $mergeTags)
</x-code>

<x-code language="php">
use MoonShine\Fields\TinyMce;

//...

public function fields(): array
{
    return [
        TinyMce::make('Description')
            // Override plugin set
            ->plugins('anchor autoresize') // [tl! focus]
            // Adding plugins to the base set
            ->addPlugins('code codesample') // [tl! focus]
            // Removing plugins from the base set
            ->removePlugins('autoresize') // [tl! focus]
            // Override toolbar set
            ->toolbar('undo redo | blocks fontfamily fontsize') // [tl! focus]
            // Adding a toolbar to the base set
            ->addToolbar('code codesample') // [tl! focus]
            // To change the author name for the tinycomments plugin
            ->commentAuthor('Danil Shutsky') // [tl! focus]
            // Tags
            ->mergeTags([
                ['value' => 'tag', 'title' => 'Title']
            ]) // [tl! focus:-2]
            // Adding configuration
            ->addConfig('codesample_languages', [['text' => 'HTML/XML', 'value' => 'markup']]) // [tl! focus]
            ->addConfig('force_br_newlines', true) // [tl! focus]
            // Overriding the current locale
            ->locale('en'), // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Translation files are located in the <code>public/vendor/moonshine/libs/tinymce/langs</code> directory.
</x-moonshine::alert>

<x-sub-title id="custom-config">Additional settings</x-sub-title>

<x-p>
    The <code>addConfig()</code> method allows for advanced configuration of <em>TinyMce</em>.
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
    If you want to use the file manager in <em>TinyMce</em>, then you need to install the package
    <x-link link="https://github.com/UniSharp/laravel-filemanager" target="_blank">Laravel FileManager</x-link>.
</x-p>

<x-moonshine::divider label="Installation" />

<x-code language="shell">
composer require unisharp/laravel-filemanager

php artisan vendor:publish --tag=lfm_config
php artisan vendor:publish --tag=lfm_public
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Be sure to set the 'use_package_routes' flag in the lfm config to false, otherwise caching routes will cause an error.
</x-moonshine::alert>

<x-code language="php">
return [
    // ...

    'use_package_routes' => false, // [tl! focus]

    // ...
];
</x-code>

<x-moonshine::divider label="Routes file" />

<x-p>
    Create a routes file like <code>routes/moonshine.php</code>
    and register the <em>LaravelFilemanager</em> routes.
</x-p>

<x-code language="php">
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

Route::prefix('laravel-filemanager')->group(function () {
    Lfm::routes();
});
</x-code>

<x-moonshine::divider label="File registration" />

<x-p>
    Register the generated routes file in <code>app/Providers/RouteServiceProvider.php</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    The route file must be in the middleware <code>moonshine</code> group!
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
    In order to allow access only to users authorized in the admin panel
    you need to add middleware <code>MoonShine\Http\Middleware\Authenticate</code>.
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

<x-moonshine::divider label="Configuration" />

<x-p>
    You need to add a prefix in the <code>config/moonshine.php</code> configuration file.
</x-p>

<x-code language="php">
'tinymce' => [
    'file_manager' => 'laravel-filemanager', // [tl! focus]
]
</x-code>

</x-page>
