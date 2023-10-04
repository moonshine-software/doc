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
        ]
    ]
">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    <em>Page</em> - это основа админ-панели <strong>MoonShine</strong>.
    Основой задачей <em>Page</em> является отображение компонентов.
</x-p>

<x-p>
    Страницы с единой логикой можно объединять в ресурсы.
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
    Метод <code>title()</code> отвечает за заголовок страницы.
</x-p>

<x-code language="php">
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    // ...

    public function title(): string // [tl! focus:start]
    {
        return $this->title ?: 'CustomPage';
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
    По умолчанию страницы используют дефолтный шаблон отображения <em>Layout</em>, который, если необходимо, можно переопределить.
</x-p>


<x-code language="php">
use MoonShine\Pages\Page;

class CustomPage extends Page
{
    // ...

    protected string $layout = 'moonshine::layouts.app'; // [tl! focus]

    //...
}
</x-code>

</x-page>
