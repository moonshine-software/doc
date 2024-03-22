<x-page title="Assets" :sectionMenu="[
    'Sections' => [
        ['url' => '#global', 'label' => 'Global assets'],
        ['url' => '#resource-page', 'label' => 'Assets for the resource/page'],
        ['url' => '#vite', 'label' => 'Vite'],
        ['url' => '#config', 'label' => 'Configuration'],
        ['url' => '#directive', 'label' => 'Directive'],
    ]
]">

<x-p>
    You can connect any of your <em>css</em> and <em>js</em> files to MoonShine.
</x-p>

<x-sub-title id="global">Global assets</x-sub-title>

<x-p>
    If you need to publish assets globally for all pages,
    then you can add them to <code>MoonShineServiceProvider</code>.
</x-p>

<x-code language="php">
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...

    public function boot(): void
    {
        parent::boot();

        moonShineAssets()->add([
            '/css/style.css',
            '/js/main.js',
        ]); // [tl! focus:-3]
    }

    //...
}
</x-code>

<x-sub-title id="resource-page">Assets for a resource/page</x-sub-title>

<x-p>
    Assets can be added for a resource or for a separate page,
    To do this, you need to specify the <code>$assets</code> property.
</x-p>

<x-code language="php">
class Post extends ModelResource
{
    protected array $assets = [
        '/css/style.css',
        '/js/main.js',
    ]; // [tl! focus:-3]

    //...
}
</x-code>

<x-code language="php">
class MyPage extends Page
{
    protected array $assets = [
        '/css/style.css',
        '/js/main.js',
    ]; // [tl! focus:-3]

    //...
}
</x-code>

<x-sub-title id="vite">Vite</x-sub-title>

<x-p>
    You can also add your own Vite assets:
</x-p>

<x-code language="php">
use Illuminate\Support\Facades\Vite; // [tl! focus]

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...

    public function boot(): void
    {
        parent::boot();

        moonShineAssets()->add([
            Vite::asset('resources/js/app.js') // [tl! focus]
        ]);
    }

    //...
}
</x-code>

<x-sub-title id="config">Configuration</x-sub-title>

<x-p>
    You can configure the connection of assets in the configuration file <code>config/moonshine.php</code>
</x-p>

<x-code language="php">
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
    ], // [tl! focus:-12]

    // ...
];
</x-code>

<x-sub-title id="directive">Directive</x-sub-title>

<x-p>
    If you want to use <strong>MoonShine</strong> styles and scripts outside the admin panel,
    then you need to include the <code>@@moonShineAssets</code> directive
</x-p>

<x-code language="html">
<head>
    @@moonShineAssets
</head>
</x-code>

</x-page>
