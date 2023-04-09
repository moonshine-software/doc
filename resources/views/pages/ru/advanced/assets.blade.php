<x-page title="Ресурсы">

<x-p>
    В MoonShine можно подключить любые ваши css и js файлы, для этого необходимо добавить их в
    MoonShineServiceProvider
</x-p>

<x-code language="php">
use MoonShine\Utilities\AssetManager;

class MoonShineServiceProvider extends ServiceProvider
{
    //...
    public function boot(): void
    {
        //...
        app(AssetManager::class)->add([
            '/css/style.css',
            '/js/main.js',
        ]);
        //...
    }
    //...
}
</x-code>

</x-page>



