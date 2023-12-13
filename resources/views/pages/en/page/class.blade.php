<x-page
    title="Pages"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#create', 'label' => 'Creating a class'],
            ['url' => '#title', 'label' => 'Heading'],
            ['url' => '#components', 'label' => 'Components'],
            ['url' => '#breadcrumbs', 'label' => 'bread crumbs'],
            ['url' => '#layout', 'label' => 'Layout'],
            ['url' => '#alias', 'label' => 'Alias'],
            ['url' => '#render', 'label' => 'Render'],
            ['url' => '#before-render', 'label' => 'beforeRender'],
        ]
    ]
">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    <em>Page</em> is the basis of the <strong>MoonShine</strong> admin panel.
    The main purpose of <em>Page</em> is to display components.
</x-p>

<x-p>
    Pages with the same logic can be combined into
    <x-link :link="route('moonshine.page', 'advanced-resource')" ><code>Resource</code></x-link>.
</x-p>

<x-sub-title id="create">Creating a class</x-sub-title>

<x-p>
    To create a page class, you can use the console command:
</x-p>

<x-code language="shell">
php artisan moonshine:page
</x-code>

<x-p>
    After entering the name of the class, a file will be created, which is the basis for the page in the admin panel.<br />
    It is located by default in the <code>app/MoonShine/Pages</code> directory.
</x-p>

<x-p>
    You can specify the name of the class and the directory of its location in the command.
</x-p>

<x-code language="shell">
php artisan moonshine:page OrderStatistics --dir=Pages/Statistics
</x-code>

<x-p>
    The file <code>OrderStatistics</code> will be created in the <code>app/MoonShine/Pages/Statistics</code> directory.
</x-p>

<x-sub-title id="title">Heading</x-sub-title>

<x-p>
    The page title can be set through the <code>title</code> property, and <code>subtitle</code> sets the subtitle.
</x-p>

<x-code language="php">
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    protected string $title = 'CustomPage'; // [tl! focus]
    protected string $subtitle = 'Subtitle'; // [tl! focus]

    //...
}
</x-code>

<x-p>
    If some logic is required for the title and subtitle,
    then the <code>title()</code> and <code>subtitle()</code> methods allow you to implement it.
</x-p>

<x-code language="php">
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    // ...

    public function title(): string // [tl! focus:start]
    {
        return $this->title ?: 'CustomPage';
    }

    public function subtitle(): string
    {
        return $this->subtitle ?: 'Subtitle';
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="components">Components</x-sub-title>

<x-p>
    The page is built from components, which can be both decorations and components of the admin panel itself,
    <x-link :link="route('moonshine.page', 'advanced-form_builder')" >FormBuilder</x-link>,
    <x-link :link="route('moonshine.page', 'advanced-table_builder')" >TableBuilder</x-link>,
    and just <em>blade</em> components, and even <em>Livewire</em> components.
</x-p>

<x-p>
    To register page components, use the <code>components()</code> method.
</x-p>

<x-code language="php">
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\TextBlock;
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    // ...

    public function components(): array // [tl! focus:start]
	{
		return [
            Grid::make([
                Column::make([
                    Block::make([
                        TextBlock::make('Title 1', 'Text 1')
                    ])
                ])->columnSpan(6),
                Column::make([
                    Block::make([
                        TextBlock::make('Title 2', 'Text 2')
                    ])
                ])->columnSpan(6),
            ])
        ];
	} // [tl! focus:end]

    //...
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more detailed information, please refer to the section
    <x-link link="{{ route('moonshine.page', 'components-index') }}">Components</x-link>.
</x-moonshine::alert>

<x-sub-title id="breadcrumbs">Bread crumbs</x-sub-title>

<x-p>
    The <code>breadcrumbs()</code> method is responsible for generating bread crumbs.
</x-p>

<x-code language="php">
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    // ...

    public function breadcrumbs(): array // [tl! focus:start]
    {
        return [
            '#' => $this->title()
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="layout">Layout</x-sub-title>

<x-p>
    By default, pages use a default <em>Layout</em> display template,
    but you can modify it through the <code>layout</code> property.
</x-p>

<x-code language="php">
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    protected string $layout = 'moonshine::layouts.app'; // [tl! focus]

    //...
}
</x-code>

<x-p>
    <em>Layout</em> can also be overridden using <code>layout()</code> method.
</x-p>

<x-code language="php">
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    public function layout(): string // [tl! focus:start]
    {
        return $this->layout;
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="alias">Alias</x-sub-title>

<x-p>
    If you need to change the page alias,
    this can be done through the <code>alias</code> property.
</x-p>

<x-code language="php">
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    protected ?string $alias = null; // [tl! focus]

    //...
}
</x-code>

<x-p>
    It is also possible to override the <code>getAlias()</code> method.
</x-p>

<x-code language="php">
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    public function getAlias(): ?string // [tl! focus:start]
    {
        return 'custom_page';
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="render">Render</x-sub-title>

<x-p>
    You can display the page outside of MoonShine by simply returning it to the Controller
</x-p>

<x-code language="php">
use MoonShine\Pages\Page;

class ProfileController extends Controller
{
    public function __invoke(): Page // [tl! focus:start]
    {
        return ProfilePage::make();
    } // [tl! focus:end]
}
</x-code>

<x-p>
    Or with Fortify
</x-p>

<x-code language="php">
Fortify::loginView(static fn() => LoginPage::make());
</x-code>

<x-sub-title id="before-render">beforeRender</x-sub-title>

<x-p>
    The <code>beforeRender()</code> method allows you to perform some actions before displaying the page.
</x-p>

<x-code language="php">
use MoonShine\Models\MoonshineUserRole;
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    public function beforeRender(): void // [tl! focus:start]
    {
        if (auth()->user()->moonshine_user_role_id !== MoonshineUserRole::DEFAULT_ROLE_ID) {
            abort(403);
        }
    } // [tl! focus:end]
}
</x-code>

</x-page>
