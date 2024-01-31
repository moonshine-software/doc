<x-page
    title="CardsBuilder"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#items-fields', 'label' => 'Элементы и поля'],
            ['url' => '#cast', 'label' => 'Приведение к типу'],
            ['url' => '#header', 'label' => 'Header'],
            ['url' => '#content', 'label' => 'Content'],
            ['url' => '#title', 'label' => 'Заголовок'],
            ['url' => '#subtitle', 'label' => 'Подзаголовок'],
            ['url' => '#thumbnail', 'label' => 'Изображение'],
            ['url' => '#buttons', 'label' => 'Кнопки'],
            ['url' => '#overlay', 'label' => 'Режим overlay'],
            ['url' => '#paginator', 'label' => 'Пагинация'],
            ['url' => '#async', 'label' => 'Асинхронный режим'],
            ['url' => '#attributes', 'label' => 'Аттрибуты'],
            ['url' => '#columns', 'label' => 'Колонки'],
            ['url' => '#custom-component', 'label' => 'Кастомный компонент'],
        ]
    ]"
>

<x-extendby :href="route('moonshine.page', 'components-moonshine_component')">
    MoonShineComponent
</x-extendby>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Благодаря <em>CardsBuilder</em> можно отобразить список элементов в виде карточек.<br/>
    Вы также можете использовать <em>CardsBuilder</em> на собственных страницах или даже вне <strong>MoonShine</strong>.
</x-p>

<x-code language="php">
CardsBuilder::make(
    Fields|array $fields = [],
    protected iterable $items = []
)
</x-code>

<x-ul>
    <li><code>$fields</code> - поля,</li>
    <li><code>$items</code> - значения полей.</li>
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
    Элементы и поля для <em>CardsBuilder</em> можно указать используя соответствующие методы.
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

<x-sub-title id="items-fields">Элементы и поля</x-sub-title>

<x-p>
    Метод <code>items()</code> позволяет передать <em>CardsBuilder</em> данные для наполнения карточек.
</x-p>

<x-code language="php">
items(iterable $items = [])
</x-code>

<x-p>
    Метод <code>fields()</code> позволяет передать <em>CardsBuilder</em> перечень полей для построения карточки.
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
    Соответствие данных с полями осуществляется через значение
    <x-link link="{{ route('moonshine.page', 'fields-index') }}#make">column</x-link>
    поля!
</x-moonshine::alert>

<x-sub-title id="cast">Приведение к типу</x-sub-title>

<x-p>
    Метод <code>cast()</code> служит для приведения значений таблицы к определенному типу.<br/>
    Так как по умолчанию поля работают с примитивными типами:
</x-p>

<x-code language="php">
use MoonShine\TypeCasts\ModelCast;

CardsBuilder::make(items: User::paginate())
    ->fields([Text::make('Email')])
    ->cast(ModelCast::make(User::class)) // [tl! focus]
</x-code>

<x-p>
    В этом примере мы привели данные к формату модели <code>User</code> с использованием <code>ModelCast</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ route('moonshine.page', 'advanced-type_casts') }}">TypeCasts</x-link>
</x-moonshine::alert>

<x-sub-title id="header">Header</x-sub-title>

<x-p>
    Метод <code>header()</code> позволяет задать шапку у карточек.
</x-p>

<x-code language="php">
header(Closure|string $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>column</em> или замыкание возвращающее <em>html</em> код.</li>
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
    Методы <code>content()</code> служит для добавления произвольного контента в карточку.
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

<x-sub-title id="title">Заголовок</x-sub-title>

<x-p>
    Метод <code>title()</code> позволяет задать заголовок карточки.
</x-p>

<x-code language="php">
title(Closure|string $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>column</em> или замыкание возвращающее заголовок.</li>
</x-ul>

<x-code language="php">
CardsBuilder::make(
    fields: [Text::make('Text')],
    items: Article::paginate()
)
    ->title('title') // [tl! focus]
</x-code>

<x-moonshine::divider label="Ссылка" />

<x-p>
    Воспользовавшись методом <code>url()</code>, можно задать у заголовка ссылку.
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

<x-sub-title id="subtitle">Подзаголовок</x-sub-title>

<x-code language="php">
subtitle(Closure|string $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>column</em> или замыкание возвращающее подзаголовок.</li>
</x-ul>

<x-code language="php">
CardsBuilder::make(
    items: Article::paginate()
)
    ->fields([Text::make('Text')])
    ->title('title')
    ->subtitle(static fn() => 'Subtitle') // [tl! focus]
</x-code>

<x-sub-title id="thumbnail">Изображение</x-sub-title>

<x-p>
    Для добавления к карточке изображение можно воспользоваться методом <code>thumbnail()</code>.<br/>
    В качестве аргумента методы принимают значение column поля или замыкание возвращающее <em>url</em> изображения.
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

<x-sub-title id="buttons">Кнопки</x-sub-title>

<x-p>
    Для добавления кнопок на основе <em>ActionButton</em>, воспользуйтесь методом <code>buttons()</code>.
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

<x-sub-title id="overlay">Режим overlay</x-sub-title>

<x-p>
    Режим <em>overlay</em> позволяет разместить шапку и заголовки поверх изображения карточки.<br/>
    Данный режим активируется одноименным методом <code>overlay()</code>.
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

<x-sub-title id="paginator">Пагинация</x-sub-title>

<x-p>
    Метод <code>paginator()</code> для того чтобы таблица работала с пагинацией.
</x-p>

<x-code language="php">
$paginator = Article::paginate();

CardsBuilder::make()
    ->fields([Text::make('Text')])
    ->items($paginator->items())
    ->paginator($paginator)  // [tl! focus]
</x-code>

Или сразу передать пагинатор:

<x-code language="php">
CardsBuilder::make(
    items: Article::paginate()  // [tl! focus]
)
    ->fields([Text::make('Text')])
</x-code>

@include('pages.ru.advanced.shared.async', ['element' => 'CardsBuilder'])

<x-sub-title id="attributes">Аттрибуты</x-sub-title>

<x-p>
    Вы можете задать любые html атрибуты для таблицы через метод <code>customAttributes()</code>:
</x-p>

<x-code language="php">
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->customAttributes(['class' => 'custom-cards']) // [tl! focus]
</x-code>

<x-sub-title id="columns">Колонки</x-sub-title>

<x-p>
    Метод <code>columnSpan()</code> позволяет задать ширину карточек в <em>Grid</em> сетке.
</x-p>

<x-code language="php">
columnSpan(
    int $columnSpan,
    int $adaptiveColumnSpan = 12
)
</x-code>

<x-ul>
    <li><code>$columnSpan</code> - значение для десктопной версии,</li>
    <li><code>$adaptiveColumnSpan</code> - значение для мобильной версии.</li>
</x-ul>

<x-code language="php">
CardsBuilder::make(
    fields: [Text::make('Text')],
    items: Article::paginate()
)
    ->columnSpan(3) // [tl! focus]
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    В админ-панели <strong>MoonShine</strong> используется 12 колоночная сетка.
</x-moonshine::alert>

<x-sub-title id="custom-component">Кастомный компонент</x-sub-title>

<x-p>
    Компонент <em>CardsBuilder</em> позволяет переопределить компонент для построения списка элемента,<br/>
    для этого необходимо воспользоваться методом <code>customComponent()</code>.
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
