<x-page>

<x-p>
    В MoonShine можно подключить любые ваши css и js файлы, для этого необходимо добавить их в
    MoonShineServiceProvider
</x-p>

<x-code language="php">
use MoonShine\Utilities\AssetManager;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...
    public function boot(): void
    {
        parent::boot();

        moonShineAssets()->add([
            '/css/style.css',
            '/js/main.js',
        ]);
    }
    //...
}
</x-code>

<x-p>
    Если Вы хотите использовать стили и скрипты MoonShine за пределами админ-панели, то необходимо подключить директиву
</x-p>

<x-code language="html">
<head>
    @@moonShineAssets
</head>
</x-code>

</x-page>



