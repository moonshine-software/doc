<x-page>

<x-p>
    В MoonShine можно подключить любые ваши <em>css</em> и <em>js</em> файлы.
    Для этого необходимо добавить их в <code>MoonShineServiceProvider</code>.
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
    Если Вы хотите использовать стили и скрипты <strong>MoonShine</strong> за пределами админ-панели,
    то необходимо подключить директиву <code>@@moonShineAssets</code>
</x-p>

<x-code language="html">
<head>
    @@moonShineAssets
</head>
</x-code>

@include('recipes.assets-vite')
</x-page>
