<x-page>

<x-p>
    You can connect any of your <em>css</em> and <em>js</em> files to MoonShine.
    To do this, you need to add them to <code>MoonShineServiceProvider</code>.
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
        ]);  // [tl! focus:-3]
    }

    //...
}
</x-code>

<x-p>
    You can also add your own Vite assets:
</x-p>

<x-code language="php">
class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...

    public function boot(): void
    {
        parent::boot();

        moonShineAssets()->add([
            Vite::asset('resources/js/app.js')
        ]);  // [tl! focus:-3]
    }

    //...
}
</x-code>

<x-p>
    If you want to use <strong>MoonShine</strong> styles and scripts outside the admin panel,
    then you need to include the <code>@@moonShineAssets</code> directive
</x-p>

<x-code language="html">
<head>
    @@moonShineAssets
</head>
</x-code>

@include('pages.en.recipes.assets-vite')
</x-page>
