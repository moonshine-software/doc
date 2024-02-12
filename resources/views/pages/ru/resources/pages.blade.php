<x-page
    title="ModelResource со страницами"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#page-type', 'label' => 'PageType'],
            ['url' => '#fields', 'label' => 'Добавление полей'],
            ['url' => '#components', 'label' => 'Основные компоненты'],
            ['url' => '#layers', 'label' => 'Слои на странице'],
        ]
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    <strong>MoonShine</strong> предоставляет возможность кастомизировать crud страниц <em>ModelResource</em>,
    для этого необходимо, при создании ресурса через команду,
    выбрать тип ресурса<br />
    <code>Model resource with pages</code>.
</x-p>

<x-p>
    В результате будет создан класс ресурса модели и дополнительные классы для индексной, детальной и страницы с формой.<br />
    Располагаться классы страниц по умолчанию будут в директории <code>app/MoonShine/Pages</code>.
</x-p>

<x-p>
    В созданном ресурсе модели в методе <code>pages()</code> будут зарегистрированы crud страницы.
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
    Для указания типа страницы в <strong>ModelResource</strong> используется <em>enum class</em> <code>PageType</code>
</x-p>

<x-p>
    Доступны следующие типы страниц:
</x-p>

<x-ul>
    <li><code>INDEX</code> - индексная страница,</li>
    <li><code>FORM</code> - страница с формой,</li>
    <li><code>DETAIL</code> - детальная страница.</li>
</x-ul>

<x-code language="php">
use MoonShine\Enums\PageType;

//...

PageType::INDEX;
PageType::FORM;
PageType::DETAIL;
</x-code>

<x-sub-title id="fields">Добавление полей</x-sub-title>

<x-p>
    <x-link link="{{ to_page('fields-index') }}">Поля</x-link>
    в <strong>MoonShine</strong> используются не только для ввода данных, но и для их вывода.<br />
    Метод <code>fields()</code> в классе <em>crud</em> страницы позволяет указать необходимые поля.
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

<x-sub-title id="components">Основные компоненты</x-sub-title>

<x-p>
    В админ-панели <strong>MoonShine</strong> можно быстро изменить основной компонент на странице.
</x-p>

<x-moonshine::divider label="IndexPage" />

<x-p>
    Метод <code>itemsComponent()</code> позволяет изменить основной компонент индексной страницы.
</x-p>

<x-code language="php">
itemsComponent(iterable $items, Fields $fields)
</x-code>

<x-ul>
    <li><code>$items</code> - значения полей,</li>
    <li><code>$fields</code> - поля.</li>
</x-ul>

<x-code language="php">
use MoonShine\Components\TableBuilder;
use MoonShine\Contracts\MoonShineRenderable;
use MoonShine\Fields\Fields;
use MoonShine\Pages\Crud\IndexPage;

class ArticleIndexPage extends IndexPage
{
    // ...

    protected function itemsComponent(iterable $items, Fields $fields): MoonShineRenderable
    {
        return TableBuilder::make(items: $items)
            ->name($this->listComponentName())
            ->fields($fields)
            ->cast($this->getResource()->getModelCast())
            ->withNotFound()
            ->when(
                ! is_null($this->getResource()->trAttributes()),
                fn (TableBuilder $table): TableBuilder => $table->trAttributes(
                    $this->getResource()->trAttributes()
                )
            )
            ->when(
                ! is_null($this->getResource()->tdAttributes()),
                fn (TableBuilder $table): TableBuilder => $table->tdAttributes(
                    $this->getResource()->tdAttributes()
                )
            )
            ->buttons($this->getResource()->getIndexItemButtons())
            ->customAttributes([
                'data-click-action' => $this->getResource()->getClickAction(),
            ])
            ->when($this->getResource()->isAsync(), function (TableBuilder $table): void {
                $table->async()->customAttributes([
                    'data-pushstate' => 'true',
                ]);
            });
    } // [tl! focus:-28]
}
</x-code>

<x-moonshine::alert type="primary" icon="heroicons.outline.book-open">
    Пример индексной страницы с компонентом <em>CardsBuilder</em> в разделе
    <x-link link="{{ to_page('recipes') }}#index-page-cards">Recipes</x-link>
</x-moonshine::alert>

<x-moonshine::divider label="DetailPage" />

<x-p>
    Метод <code>detailComponent()</code> позволяет изменить основной компонент детальной страницы.
</x-p>

<x-code language="php">
detailComponent(?Model $item, Fields $fields)
</x-code>

<x-ul>
    <li><code>$item</code> - Eloquent Model</li>
    <li><code>$fields</code> - поля.</li>
</x-ul>

<x-code language="php">
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\ComponentAttributeBag;
use MoonShine\Components\TableBuilder;
use MoonShine\Contracts\MoonShineRenderable;
use MoonShine\Fields\Fields;
use MoonShine\Pages\Crud\DetailPage;

class ArticleDetailPage extends DetailPage
{
    // ...

    protected function detailComponent(?Model $item, Fields $fields): MoonShineRenderable
    {
        return TableBuilder::make($fields)
            ->cast($this->getResource()->getModelCast())
            ->items([$item])
            ->vertical()
            ->simple()
            ->preview()
            ->tdAttributes(fn (
                $data,
                int $row,
                int $cell,
                ComponentAttributeBag $attributes
            ): ComponentAttributeBag => $attributes->when(
                $cell === 0,
                fn (ComponentAttributeBag $attr): ComponentAttributeBag => $attr->merge([
                    'class' => 'font-semibold',
                    'width' => '20%',
                ])
            ));
    } // [tl! focus:-18]
}
</x-code>

<x-moonshine::divider label="FormPage" />

<x-p>
    Метод <code>formComponent()</code> позволяет изменить основной компонент на странице с формой.
</x-p>

<x-code language="php">
formComponent(
    string $action,
    ?Model $item,
    Fields $fields,
    bool $isAsync = false,
): MoonShineRenderable
</x-code>

<x-ul>
    <li><code>$action</code> - обработчик,</li>
    <li><code>$item</code> - Eloquent Model,</li>
    <li><code>$fields</code> - поля,</li>
    <li><code>$isAsync</code> - асинхронный режим.</li>
</x-ul>

<x-code language="php">
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\ComponentAttributeBag;
use MoonShine\Components\FormBuilder;
use MoonShine\Contracts\MoonShineRenderable;
use MoonShine\Enums\JsEvent;
use MoonShine\Fields\Fields;
use MoonShine\Fields\Hidden;
use MoonShine\Pages\Crud\FormPage;
use MoonShine\Support\AlpineJs;

class ArticleFormPage extends FormPage
{
    // ...

    protected function formComponent(
        string $action,
        ?Model $item,
        Fields $fields,
        bool $isAsync = false,
    ): MoonShineRenderable {
        $resource = $this->getResource();

        return FormBuilder::make($action)
            ->fillCast(
                $item,
                $resource->getModelCast()
            )
            ->fields(
                $fields
                    ->when(
                        ! is_null($item),
                        fn (Fields $fields): Fields => $fields->push(
                            Hidden::make('_method')->setValue('PUT')
                        )
                    )
                    ->when(
                        ! $item?->exists && ! $resource->isCreateInModal(),
                        fn (Fields $fields): Fields => $fields->push(
                            Hidden::make('_force_redirect')->setValue(true)
                        )
                    )
                    ->toArray()
            )
            ->when(
                $isAsync,
                fn (FormBuilder $formBuilder): FormBuilder => $formBuilder
                    ->async(asyncEvents: [
                        $resource->listEventName(request('_component_name', 'default')),
                        AlpineJs::event(JsEvent::FORM_RESET, 'crud'),
                    ])
            )
            ->when(
                $resource->isPrecognitive() || (moonshineRequest()->isFragmentLoad('crud-form') && ! $isAsync),
                fn (FormBuilder $form): FormBuilder => $form->precognitive()
            )
            ->name('crud')
            ->submit(__('moonshine::ui.save'), ['class' => 'btn-primary btn-lg']);
    } // [tl! focus:-43]
}
</x-code>

<x-sub-title id="layers">Слои на странице</x-sub-title>

<x-p>
    Для удобства все <em>crud</em> страницы разбиты на три слоя,
    которые отвечают за отображение определенной области на странице.
</x-p>

<x-ul>
    <li>
        <code>TopLayer</code> - по умолчанию используется для вывода метрик на индексной странице
        и для дополнительных кнопок на странице редактирования
    </li>
    <li>
        <code>MainLayer</code> - по умолчанию данный слой используется для вывода основной информации используя
        <x-link link="{{ to_page('advanced-form_builder') }}">FormBuilder</x-link> и
        <x-link link="{{ to_page('advanced-table_builder') }}">TableBuilder</x-link>
    </li>
    <li><code>BottomLayer</code> - по умолчанию используется для вывода дополнительной информации</li>
</x-ul>

<x-p>
    Для кастомизации слоев используются соответствующие методы: <code>topLayer()</code>, <code>mainLayer()</code> и
    <code>bottomLayer()</code>. Методы должны возвращать массив <x-link link="{{ to_page('page-class') . '#components' }}">Компонентов</x-link>.
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
    Если необходимо через ресурс или страницу получить доступ к компонентам определенного слоя, то
    воспользуйтесь методом <code>getLayerComponents</code>
</x-moonshine::alert>

<x-code>
use MoonShine\Enums\Layer;
use MoonShine\Enums\PageType;

// ...

// Resource
$this->getPages()
    ->formPage()
    ->getLayerComponents(Layer::BOTTOM);

// Page
$this->getLayerComponents(Layer::BOTTOM);
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если необходимо через ресурс добавить компонент для указанной страницы в нужный слой, то воспользуйтесь методом onBoot
    ресурса и pushToLayer страницы
</x-moonshine::alert>

<x-code>
protected function onBoot(): void
{
    $this->getPages()
        ->formPage()
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
