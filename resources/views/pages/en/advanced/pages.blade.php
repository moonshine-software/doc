<x-page title="Pages" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#without-title', 'label' => 'Without title'],
        ['url' => '#layout', 'label' => 'Layout'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    You can create your own blank pages based on the blade view
    and <x-link link="{{ route('moonshine.custom_page', 'components-index') }}">UI components</x-link>,
    style in your own way, as well as organize some kind of logic.
</x-p>

<x-code language="php">
use Illuminate\Support\ServiceProvider;
use MoonShine\Menu\MenuItem;
use MoonShine\MoonShine;
use MoonShine\Resources\CustomPage; // [tl! focus]

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([
            MenuItem::make(
                'Page title',
                CustomPage::make('Page title', 'slug', 'view', fn() => []) // [tl! focus]
            )
        ]);
    }
}
</x-code>

<x-p>
    The first argument - page title.
</x-p>

<x-p>
    The second argument - page slug to generate url.
</x-p>

<x-p>
    The third argument - your custom blade view, which could be found in the resources/views.
</x-p>

<x-p>
    The fourth argument - the data required for view.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    You can use <code>blade components</code> which have a handler class to add your own logic.
</x-moonshine::alert>

<x-sub-title id="without-title">Without title</x-sub-title>

<x-p>
    Sometimes it is not required to display the title on a custom page, so it can be hidden using the <code>withoutTitle</code> method.
</x-p>

<x-code language="php">
use Illuminate\Support\ServiceProvider;
use MoonShine\Menu\MenuItem;
use MoonShine\MoonShine;
use MoonShine\Resources\CustomPage;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([
            MenuItem::make(
                'Page title',
                CustomPage::make('Page title', 'slug', 'view', fn() => [])
                    ->withoutTitle()  // [tl! focus]
            )
        ]);
    }
}
</x-code>

<x-sub-title id="layout">Layout</x-sub-title>

<x-p>
    You can use custom <code>layout</code>, for this you need to specify the path to it in the corresponding method.
</x-p>

<x-code language="php">
use Illuminate\Support\ServiceProvider;
use MoonShine\Resources\CustomPage;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([
            MenuItem::make(
                'Page title',
                CustomPage::make('Page title', 'slug', 'view', fn() => [])
                    ->layout('path') // [tl! focus]
            )
        ]);
    }
}
</x-code>

</x-page>
