<x-page
    title="CardsBuilder"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#items-fields', 'label' => 'Items and fields'],
            ['url' => '#cast', 'label' => 'Casting'],
            ['url' => '#header', 'label' => 'Header'],
            ['url' => '#content', 'label' => 'Content'],
            ['url' => '#title', 'label' => 'Title'],
            ['url' => '#subtitle', 'label' => 'Subtitle'],
            ['url' => '#thumbnail', 'label' => 'Thumbnail'],
            ['url' => '#buttons', 'label' => 'Buttons'],
            ['url' => '#overlay', 'label' => 'Overlay mode'],
            ['url' => '#paginator', 'label' => 'Paginator'],
            ['url' => '#async', 'label' => 'Asynchronous mode'],
            ['url' => '#attributes', 'label' => 'Attributes'],
            ['url' => '#columns', 'label' => 'Columns'],
            ['url' => '#custom-component', 'label' => 'Custom component'],
        ]
    ]"
>

<x-extendby :href="route('moonshine.page', 'components-moonshine_component')">
    MoonShineComponent
</x-extendby>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    With <em>CardsBuilder</em> you can display a list of items as cards.<br/>
    You can also use <em>CardsBuilder</em> on your own pages or even outside of <strong>MoonShine</strong>.
</x-p>

<x-code language="php">
CardsBuilder::make(
    Fields|array $fields = [],
    protected iterable $items = []
)
</x-code>

<x-ul>
    <li><code>$fields</code> - fields,</li>
    <li><code>$items</code> - field values.</li>
</x-ul>

<x-code language="php">
CardsBuilder::make(
    [
        ['id' => 1, 'title' => 'Title 1'],
        ['id' => 2, 'title' => 'Title 2'],
    ],
    [
        ID::make(),
        Text::make('title')
    ]
)
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Elements and fields for <em>CardsBuilder</em> can be specified using the appropriate methods.
</x-moonshine::alert>

{!!
    MoonShine\Components\CardsBuilder::make(
        [
            ['id' => 1, 'title' => 'Title 1'],
            ['id' => 2, 'title' => 'Title 2'],
        ],
        [
            MoonShine\Fields\ID::make(),
            MoonShine\Fields\Text::make('title')
        ]
    )
        ->columnSpan(3)
!!}

<x-sub-title id="items-fields">Items and fields</x-sub-title>

<x-p>
    The <code>items()</code> method allows you to pass data to <em>CardsBuilder</em> for filling cards.
</x-p>

<x-code language="php">
items(iterable $items = [])
</x-code>

<x-p>
    The <code>fields()</code> method allows you to pass <em>CardsBuilder</em> a list of fields to build a card.
</x-p>

<x-code language="php">
fields(Fields|Closure|array $fields)
</x-code>

<x-code language="php">
CardsBuilder::make()
    ->fields([Text::make('Text')]) // [tl! focus]
    ->items([['text' => 'Value']]) // [tl! focus]
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    The correspondence of data with fields is carried out through the value
    <x-link link="{{ route('moonshine.page', 'fields-index') }}#make">column</x-link>
    fields!
</x-moonshine::alert>

<x-sub-title id="cast">Casting</x-sub-title>

<x-p>
    The <code>cast()</code> method is used to cast table values to a specific type.<br/>
    Since by default fields work with primitive types:
</x-p>

<x-code language="php">
use MoonShine\TypeCasts\ModelCast;

CardsBuilder::make(items: User::paginate())
    ->fields([Text::make('Email')])
    ->cast(ModelCast::make(User::class)) // [tl! focus]
</x-code>

<x-p>
    In this example, we cast the data to the <code>User</code> model format using <code>ModelCast</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    For more detailed information, please refer to the section
    <x-link link="{{ route('moonshine.page', 'advanced-type_casts') }}">TypeCasts</x-link>
</x-moonshine::alert>

<x-sub-title id="header">Header</x-sub-title>

<x-p>
    The <code>header()</code> method allows you to set the header for cards.
</x-p>

<x-code language="php">
header(Closure|string $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>column</em> or closure returning <em>html</em> code.</li>
</x-ul>

<x-code language="php">
CardsBuilder::make(
    items: Article::paginate()
)
    ->fields([Text::make('Text')])
    ->header(static fn() => Badge::make('new', 'success')) // [tl! focus]
</x-code>

<x-sub-title id="content">Content</x-sub-title>

<x-p>
    The <code>content()</code> methods are used to add arbitrary content to the card.
</x-p>

<x-code language="php">
content(Closure|string $value)
</x-code>

<x-code language="php">
CardsBuilder::make(
    fields: [Text::make('Text')],
    items: Article::paginate()
)
    ->content('Custom content') // [tl! focus]
</x-code>

<x-sub-title id="title">Title</x-sub-title>

<x-p>
    The <code>title()</code> method allows you to set the title of the card.
</x-p>

<x-code language="php">
title(Closure|string $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>column</em> or a closure that returns the title.</li>
</x-ul>

<x-code language="php">
CardsBuilder::make(
    fields: [Text::make('Text')],
    items: Article::paginate()
)
    ->title('title') // [tl! focus]
</x-code>

<x-moonshine::divider label="Link" />

<x-p>
    Using the <code>url()</code> method, you can set a link to the header.
</x-p>

<x-code language="php">
url(Closure|string $value)
</x-code>

<x-code language="php">
CardsBuilder::make(
    fields: [Text::make('Text')],
    items: Article::paginate()
)
    ->title('title')
    ->url(fn($data) => (new ArticleResource())->formPageUrl($data))// [tl! focus]
</x-code>

<x-sub-title id="subtitle">Subtitle</x-sub-title>

<x-code language="php">
subtitle(Closure|string $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>column</em> or a closure that returns a subtitle.</li>
</x-ul>

<x-code language="php">
CardsBuilder::make(
    items: Article::paginate()
)
    ->fields([Text::make('Text')])
    ->title('title')
    ->subtitle(static fn() => 'Subtitle') // [tl! focus]
</x-code>

<x-sub-title id="thumbnail">Thumbnail</x-sub-title>

<x-p>
    To add an image to a card, you can use the <code>thumbnail()</code> method.<br/>
    As an argument, the methods take the value of a column field or a closure that returns the <em>url</em> of the image.
</x-p>

<x-code language="php">
thumbnail(Closure|string $value)
</x-code>

<x-code language="php">
CardsBuilder::make(
    items: Article::paginate()
)
    ->fields([Text::make('Text')])
    ->thumbnail('thumbnail') // [tl! focus]
</x-code>

{!!
    MoonShine\Components\CardsBuilder::make(
        [
            ['id' => 1, 'title' => 'Title 1', 'thumbnail' => '/images/image_1.jpg'],
            ['id' => 2, 'title' => 'Title 2', 'thumbnail' => '/images/image_2.jpg'],
        ],
        [
            MoonShine\Fields\ID::make(),
            MoonShine\Fields\Text::make('title')
        ]
    )
        ->thumbnail('thumbnail')
        ->columnSpan(3)
!!}

<x-sub-title id="buttons">Buttons</x-sub-title>

<x-p>
    To add buttons based on <em>ActionButton</em>, use the <code>buttons()</code> method.
</x-p>

<x-code language="php">
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->cast(ModelCast::make(Article::class))
    ->buttons([
        ActionButton::make('Delete', route('name.delete')),
        ActionButton::make('Edit', route('name.edit'))->showInDropdown(),
        ActionButton::make('Go to home', route('home'))->blank()->canSee(fn($data) => $data->active)
    ]) // [tl! focus:-4]
</x-code>

<x-sub-title id="overlay">Overlay mode</x-sub-title>

<x-p>
    The <em>overlay</em> mode allows you to place the header and headings on top of the card image.<br/>
    This mode is activated by the <code>overlay()</code> method of the same name.
</x-p>

<x-code language="php">
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Text::make('Text')])
    ->cast(ModelCast::make(Article::class))
    ->thumbnail('thumbnail')
    ->header(static fn() => Badge::make('new', 'success'))
    ->title('title')
    ->subtitle(static fn() => 'Subtitle')
    ->overlay() // [tl! focus]
</x-code>

{!!
    MoonShine\Components\CardsBuilder::make(
        [
            ['id' => 1, 'title' => 'Title 1', 'thumbnail' => '/images/image_1.jpg'],
            ['id' => 2, 'title' => 'Title 2', 'thumbnail' => '/images/image_2.jpg'],
        ],
        [
            MoonShine\Fields\ID::make(),
            MoonShine\Fields\Text::make('title')
        ]
    )
        ->header(static fn() => MoonShine\Components\Badge::make('new', 'success'))
        ->title('title')
        ->subtitle(static fn() => 'Subtitle')
        ->thumbnail('thumbnail')
        ->overlay()
        ->columnSpan(3)
!!}

<x-sub-title id="paginator">Paginator</x-sub-title>

<x-p>
    The <code>paginator()</code> method for the table to work with pagination.
</x-p>

<x-code language="php">
$paginator = Article::paginate();

CardsBuilder::make()
    ->fields([Text::make('Text')])
    ->items($paginator->items())
    ->paginator($paginator)  // [tl! focus]
</x-code>

Or directly pass the paginator:

<x-code language="php">
CardsBuilder::make(
    items: Article::paginate()  // [tl! focus]
)
    ->fields([Text::make('Text')])
</x-code>

@include('pages.en.advanced.shared.async', ['element' => 'CardsBuilder'])

<x-sub-title id="attributes">Attributes</x-sub-title>

<x-p>
    You can set any html attributes for the table using the <code>customAttributes()</code> method:
</x-p>

<x-code language="php">
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->customAttributes(['class' => 'custom-cards']) // [tl! focus]
</x-code>

<x-sub-title id="columns">Columns</x-sub-title>

<x-p>
    The <code>columnSpan()</code> method allows you to set the width of the cards in the <em>Grid</em>.
</x-p>

<x-code language="php">
columnSpan(
    int $columnSpan,
    int $adaptiveColumnSpan = 12
)
</x-code>

<x-ul>
    <li><code>$columnSpan</code> - value for the desktop version,</li>
    <li><code>$adaptiveColumnSpan</code> - value for the mobile version.</li>
</x-ul>

<x-code language="php">
CardsBuilder::make(
    fields: [Text::make('Text')],
    items: Article::paginate()
)
    ->columnSpan(3) // [tl! focus]
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    The <strong>MoonShine</strong> admin panel uses a 12-column grid.
</x-moonshine::alert>

<x-sub-title id="custom-component">Custom component</x-sub-title>

<x-p>
    The <em>CardsBuilder</em> component allows you to override the component for building a list of an element<br/>
    To do this, you need to use the <code>customComponent()</code> method.
</x-p>

<x-code language="php">
CardsBuilder::make(
    fields: [Text::make('Text')],
    items: Article::paginate()
)
    ->customComponent(function (Article $article, int $index, CardsBuilder $builder) {
        return Badge::make($index + 1 . "." . $article->title, 'green');
    }) // [tl! focus:-2]
</x-code>

{!!
    MoonShine\Components\CardsBuilder::make(
        [
            ['id' => 1, 'title' => 'Title 1'],
            ['id' => 2, 'title' => 'Title 2'],
            ['id' => 3, 'title' => 'Title 3'],
        ],
        [
            MoonShine\Fields\ID::make(),
            MoonShine\Fields\Text::make('title')
        ]
    )
        ->customComponent(function ($data, int $index, MoonShine\Components\CardsBuilder $builder) {
            return MoonShine\Components\Badge::make($index + 1 . ". " . $data['title'], 'green');
        })
        ->columnSpan(2)
!!}

</x-page>
