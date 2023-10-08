<x-page
    title="Страницы"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#create', 'label' => 'Создание класса'],
            ['url' => '#title', 'label' => 'Заголовок'],
            ['url' => '#components', 'label' => 'Компоненты'],
            ['url' => '#breadcrumbs', 'label' => 'Хлебные крошки'],
            ['url' => '#layout', 'label' => 'Layout'],
            ['url' => '#alias', 'label' => 'Alias'],
            ['url' => '#before-render', 'label' => 'beforeRender'],
        ]
    ]
">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    <em>Page</em> - это основа админ-панели <strong>MoonShine</strong>.
    Основной задачей <em>Page</em> является отображение компонентов.
</x-p>

<x-p>
    Страницы с единой логикой можно объединять в
    <x-link :link="route('moonshine.page', 'dvanced-resource')" ><code>Resource</code></x-link>.
</x-p>

<x-sub-title id="create">Создание класса</x-sub-title>

<x-p>
    Для создания класса страницы можно воспользоваться консольной командой:
</x-p>

<x-code language="shell">
php artisan moonshine:page
</x-code>

<x-p>
    После ввода названия класса будет создан файл, который является основой для страницы в админ-панели.<br />
    Располагается он по умолчанию в директории <code>app/MoonShine/Pages</code>.
</x-p>

<x-p>
    Можно указывать в команде название класса и директорию его расположения:
</x-p>

<x-code language="shell">
php artisan moonshine:page OrderStatistics --dir=Pages/Statistics
</x-code>

<x-p>
    Будет создан файл <code>OrderStatistics</code> в директории <code>app/MoonShine/Pages/Statistics</code>.
</x-p>

<x-sub-title id="title">Заголовок</x-sub-title>

<x-p>
    Заголовок страницы можно задать через свойство <code>title</code>, а <code>subtitle</code> задает подзаголовок.
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
    Если требуется какая-то логика для заголовка и подзаголовка,
    то методы <code>title()</code> и <code>subtitle()</code> позволяют ее реализовать.
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

<x-sub-title id="components">Компоненты</x-sub-title>

<x-p>
    Страница строится из компонентов, которые могут быть как декорации и компоненты самой админ-панели,
    <x-link :link="route('moonshine.page', 'advanced-form_builder')" >FormBuilder</x-link>,
    <x-link :link="route('moonshine.page', 'advanced-table_builder')" >TableBuilder</x-link>,
    так и просто <em>blade</em> компоненты, и даже компоненты <em>Livewire</em>.
</x-p>

<x-p>
    Для регистрации компонентов страницы используется метод <code>components()</code>.
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

<x-sub-title id="breadcrumbs">Хлебные крошки</x-sub-title>

<x-p>
    Метод <code>breadcrumbs()</code> отвечает за генерацию хлебных крошек.
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
    По умолчанию страницы используют дефолтный шаблон отображения <em>Layout</em>,
    но его можно изменить через свойство <code>layout</code>.
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
    Так же <em>Layout</em> можно переопределить используя метод <code>layout()</code>.
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
    Если требуется изменить алиас страницы,
    то это можно сделать через свойство <code>alias</code>.
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
    Так же есть возможность переопределить метод <code>getAlias()</code>
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

<x-sub-title id="before-render">beforeRender</x-sub-title>

<x-p>
    Метод <code>beforeRender()</code> позволяет выполнить какие-то действия перед отображением страницы.
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
