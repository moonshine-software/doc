<x-page
    title="ModelResource with pages"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#page-type', 'label' => 'PageType'],
            ['url' => '#fields', 'label' => 'Adding fields'],
            ['url' => '#layers', 'label' => 'Layers on a page'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    <strong>MoonShine</strong> provides the ability to customize the <em>ModelResource</em> pages crud,
    for this it is necessary, when creating a resource through the command,
    select resource type<br />
    <code>Model resource with pages</code>.
</x-p>

<x-p>
    This will create a model resource class and additional classes for the index, detail, and form pages.<br />
    Page classes will be located by default in the <code>app/MoonShine/Pages</code> directory.
</x-p>

<x-p>
    In the created model resource, crud pages will be registered in the <code>pages()</code> method.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use App\MoonShine\Pages\Post\PostIndexPage; // [tl! focus]
use App\MoonShine\Pages\Post\PostFormPage; // [tl! focus]
use App\MoonShine\Pages\Post\PostDetailPage; // [tl! focus]
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function pages(): array // [tl! focus:start]
    {
        return [
            PostIndexPage::make($this->title()),
            PostFormPage::make(
                $this->getItemID()
                    ? __('moonshine::ui.edit')
                    : __('moonshine::ui.add')
            ),
            PostDetailPage::make(__('moonshine::ui.show')),
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="page-type">PageType</x-sub-title>

<x-p>
    To specify the page type in <strong>ModelResource</strong>, use <em>enum class</em> <code>PageType</code>
</x-p>

<x-p>
    The following page types are available:
</x-p>

<x-ul>
    <li><code>INDEX</code> - index page,</li>
    <li><code>FORM</code> - form page,</li>
    <li><code>DETAIL</code> - detail page.</li>
</x-ul>

<x-sub-title id="fields">Adding fields</x-sub-title>

<x-p>
    <x-link link="{{ route('moonshine.page', 'fields-index') }}">Fields</x-link>
    in <strong>MoonShine</strong> are used not only for data input, but also for their output.<br />
    The <code>fields()</code> method in the page <em>crud</em> class allows you to specify the required fields.
</x-p>

<x-code language="php">
namespace App\MoonShine\Pages\Post;

use MoonShine\Pages\Crud\IndexPage;

class PostIndexPage extends IndexPage
{
    public function fields(): array // [tl! focus:start]
    {
        return [
            ID::make(),
            Text::make('Title'),
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="layers">Layers on a page</x-sub-title>

<x-p>
    For convenience, all <em>crud</em> pages are divided into three layers,
    which are responsible for displaying a specific area on the page.
</x-p>

<x-ul>
    <li>
       <code>TopLayer</code> - by default used to display metrics on the index page
        and for additional buttons on the edit page
    </li>
    <li>
        <code>MainLayer</code> - by default, this layer is used to display basic information using
        <x-link link="{{ route('moonshine.page', 'advanced-form_builder') }}">FormBuilder</x-link> and
        <x-link link="{{ route('moonshine.page', 'advanced-table_builder') }}">TableBuilder</x-link>
    </li>
    <li><code>BottomLayer</code> - default is used to display additional information</li>
</x-ul>

<x-p>
    To customize layers, the corresponding methods are used: <code>topLayer()</code>, <code>mainLayer()</code> and
    <code>bottomLayer()</code>. Methods must return <x-link link="{{ route('moonshine.page', 'page-class') . '#components' }}">Components</x-link> an array.
</x-p>

<x-code language="php">
namespace App\MoonShine\Pages\Post;

use MoonShine\Decorations\Heading;
use MoonShine\Pages\Crud\IndexPage;

class PostIndexPage extends IndexPage
{
    //...

    protected function topLayer(): array // [tl! focus:start]
    {
        return [
            Heading::make('Custom top'),
            ...parent::topLayer()
        ];
    } // [tl! focus:end]

    protected function mainLayer(): array // [tl! focus:start]
    {
        return [
            Heading::make('Custom main'),
            ...parent::mainLayer()
        ];
    } // [tl! focus:end]

    protected function bottomLayer(): array // [tl! focus:start]
    {
        return [
            Heading::make('Custom bottom'),
            ...parent::bottomLayer()
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

@php
    $screenshots = \MoonShine\Decorations\Tabs::make([
        \MoonShine\Decorations\Tab::make('IndexPage', [
            \MoonShine\Fields\Preview::make()->changePreview(function ($value) {
                return view('components.image', [
                    'src' => asset('screenshots/page_index_layers.png'),
                    'theme' => 'light',
                    'slot' => null
                ]);
            })->customWrapperAttributes(['class' => '!my-0']),
            \MoonShine\Fields\Preview::make()->changePreview(function ($value) {
                return view('components.image', [
                    'src' => asset('screenshots/page_index_layers_dark.png'),
                    'theme' => 'dark',
                    'slot' => null
                ]);
            })->customWrapperAttributes(['class' => '!my-0']),
        ]),
        \MoonShine\Decorations\Tab::make('FormPage', [
            \MoonShine\Fields\Preview::make()->changePreview(function ($value) {
                return view('components.image', [
                    'src' => asset('screenshots/page_form_layers.png'),
                    'theme' => 'light',
                    'slot' => null,
                    'class' => 'wt'
                ]);
            })->customWrapperAttributes(['class' => '!my-0']),
            \MoonShine\Fields\Preview::make()->changePreview(function ($value) {
                return view('components.image', [
                    'src' => asset('screenshots/page_form_layers_dark.png'),
                    'theme' => 'dark',
                    'slot' => null
                ]);
            })->customWrapperAttributes(['class' => '!my-0']),
        ]),
        \MoonShine\Decorations\Tab::make('DetailPage', [
            \MoonShine\Fields\Preview::make()->changePreview(function ($value) {
                return view('components.image', [
                    'src' => asset('screenshots/page_detail_layers.png'),
                    'theme' => 'light',
                    'slot' => null
                ]);
            })->customWrapperAttributes(['class' => '!my-0']),
            \MoonShine\Fields\Preview::make()->changePreview(function ($value) {
                return view('components.image', [
                    'src' => asset('screenshots/page_detail_layers_dark.png'),
                    'theme' => 'dark',
                    'slot' => null
                ]);
            })->customWrapperAttributes(['class' => '!my-0']),
        ]),
    ])->render()
@endphp

{{ $screenshots }}

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    If you need to access the components of a certain layer through a resource or page, then
    use the <code>getLayerComponents</code> method
</x-moonshine::alert>

<x-code>
use MoonShine\Enums\Layer;
use MoonShine\Enums\PageType;

// ...

// Resource
$this->getPages()
    ->findByType(PageType::FORM)
    ->getLayerComponents(Layer::BOTTOM);

// Page
$this->getLayerComponents(Layer::BOTTOM);
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    If you need to add a component for the specified page to the desired layer through a resource, then use the onBoot method
    resource and page pushToLayer
</x-moonshine::alert>

<x-code>
protected function onBoot(): void
{
    $this->getPages()
        ->findByUri(PageType::FORM->value)
        ->pushToLayer(
            layer: Layer::BOTTOM,
            component: Permissions::make(
                'Permissions',
                $this,
            )
        );
}
</x-code>

</x-page>
