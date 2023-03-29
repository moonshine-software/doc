<x-page title="Resources">

<x-p>
    MoonShine can include any of your css and js files by adding them to the
    MoonShineServiceProvider
</x-p>

<x-code language="php">
use Leeto\MoonShine\Utilities\AssetManager;

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



