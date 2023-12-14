<x-recipe id="assets-vite" title="{{ $title ?? 'Recipe' }}">

<x-p>
    Let's add one compiled using Vite build.
</x-p>

<x-code language="php">
use Illuminate\Support\Facades\Vite;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
//...

public function boot(): void
{
    parent::boot();

    moonShineAssets()->add([
        Vite::asset('resources/css/app.css'),
        Vite::asset('resources/js/app.js'),
    ]);  // [tl! focus:-3]
}

//...
}
</x-code>

</x-recipe>
