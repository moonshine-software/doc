<x-page
    title="Pages"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#define', 'label' => 'Announcement'],
            ['url' => '#title', 'label' => 'Heading'],
            ['url' => '#layout', 'label' => 'Layout'],
            ['url' => '#alias', 'label' => 'Alias'],
            ['url' => '#view-page', 'label' => 'Quick page'],
            ['url' => '#render', 'label' => 'Render'],
        ]
    ]
">

<x-p>
    You can create instances of pages from classes and register them in the admin panel.
</x-p>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    To create a page instance, use the static <code>make()</code> method:
</x-p>

<x-code language="php">
make(
    ?string $title = null,
    ?string $alias = null,
    ?ResourceContract $resource = null
)
</x-code>

<ul>
    <li><code>title</code> - page title;</li>
    <li><code>alias</code> - alias for page url;</li>
    <li><code>resource</code> - the resource to which the page belongs.</li>
</ul>

<x-code language="php">
use App\MoonShine\Pages\CustomPage; // [tl! focus]

//...

CustomPage::make('Custom page', 'custom_page') // [tl! focus]

//...
</x-code>

<x-sub-title id="define">Declaring pages in the system</x-sub-title>

<x-p>
    Register the page in the system and immediately add a link to it in the navigation menu
    You can use the service provider <code>MoonShineServiceProvider</code>:
</x-p>

<x-code language="php">
namespace App\Providers;

use App\MoonShine\Pages\CustomPage; // [tl! focus]
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    //...

    protected function menu(): array // [tl! focus:start]
    {
        return [
            MenuItem::make('Custom page', CustomPage::make('Custom page', 'custom_page'))
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    You can learn about advanced settings in the section
    <x-link :link="route('moonshine.page', 'menu')" ><code>Menu</code></x-link>.
</x-moonshine::alert>

<x-p>
    If you only need to register the page in the system without adding it to the navigation menu,
    then you need to use the <code>pages()</code> method:
</x-p>

<x-code language="php">
namespace App\Providers;

use App\MoonShine\Pages\CustomPage; // [tl! focus]
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    public function pages(): array // [tl! focus:start]
    {
        return [
            CustomPage::make('Title page', 'custom_page')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="title">Title/Subtitle</x-sub-title>

<x-p>
    The <code>setTitle()</code> method allows you to change the page title,
    and the <code>setSubTitle()</code> method is the subtitle.
</x-p>

<x-code language="php">
setTitle(string $title)
</x-code>

<x-code language="php">
setSubTitle(string $subtitle)
</x-code>

<x-code language="php">
use App\MoonShine\Pages\CustomPage;

//...

public function pages(): array
{
    return [
        CustomPage::make('Title page', 'custom_page')
            ->setTitle('New title') // [tl! focus]
            ->setSubTitle('Subtitle') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="layout">Layout</x-sub-title>

<x-p>
    The <code>setLayout()</code> method allows you to change the <em>Layout</em> template of a page instance.
</x-p>

<x-code language="php">
setLayout(string $layout)
</x-code>

<x-code language="php">
use App\MoonShine\Pages\CustomPage;

//...

public function pages(): array
{
    return [
        CustomPage::make('Title page', 'custom_page')
            ->setLayout('custom_layouts.app') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="alias">Alias</x-sub-title>

<x-p>
    The <code>alias()</code> method allows you to change the alias for a page instance.
</x-p>

<x-code language="php">
alias(string $alias)
</x-code>

<x-code language="php">
use App\MoonShine\Pages\CustomPage;

//...

public function pages(): array
{
    return [
        CustomPage::make('Title page')
            ->alias('custom-page') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="view-page">Quick page</x-sub-title>

<x-p>
    If you need to add a page without creating a class, but simply specifying a blade view, we recommend using <code>ViewPage</code>
</x-p>

<x-code>
MenuItem::make(
    'Custom',
    ViewPage::make()
        ->setTitle('Hello')
        ->setLayout('custom_layout')
        ->setContentView('my-form', ['param' => 'value'])
),
</x-code>

<x-sub-title id="render">Render</x-sub-title>

<x-p>
    You can display the quick page outside of MoonShine by simply returning it to the Controller
</x-p>

<x-code>
class HomeController extends Controller
{
    public function __invoke(Request $request): Page
    {
        $articles = Article::query()
            ->published()
            ->latest()
            ->take(6)
            ->get();

        return ViewPage::make()
            ->setTitle('Welcome')
            ->setLayout('layouts.app')
            ->setContentView('welcome', ['articles' => $articles]);
    }
}
</x-code>

</x-page>
