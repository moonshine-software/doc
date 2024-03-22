<x-page title="Assets" :sectionMenu="[
    'Разделы' => [
        ['url' => '#global', 'label' => 'Глобальные ассеты'],
        ['url' => '#resource-page', 'label' => 'Ассеты для ресурса/страницы'],
        ['url' => '#vite', 'label' => 'Vite'],
        ['url' => '#config', 'label' => 'Конфигурация'],
        ['url' => '#directive', 'label' => 'Директива'],
    ]
]">

<x-p>
    В MoonShine можно подключить любые ваши <em>css</em> и <em>js</em> файлы.
</x-p>

<x-sub-title id="global">Глобальные ассеты</x-sub-title>

<x-p>
    Если необходимо опубликовать ассеты глобально для всех страниц,
    то можно добавить их в <code>MoonShineServiceProvider</code>.
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

<x-sub-title id="resource-page">Ассеты для ресурса/страницы</x-sub-title>

<x-p>
    Ассеты можно добавить для ресурса или для отдельной страницы,
    для этого необходимо указать свойство <code>$assets</code>.
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
    Можно также добавлять свои Vite ассеты:
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

<x-sub-title id="config">Конфигурация</x-sub-title>

<x-p>
    Настроить подключение ассетов можно в файле конфигурации <code>config/moonshine.php</code>
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

<x-sub-title id="directive">Директива</x-sub-title>

<x-p>
    Если Вы хотите использовать стили и скрипты <strong>MoonShine</strong> за пределами админ-панели,
    то необходимо подключить директиву <code>@@moonShineAssets</code>
</x-p>

<x-code language="html">
<head>
    @@moonShineAssets
</head>
</x-code>

</x-page>
