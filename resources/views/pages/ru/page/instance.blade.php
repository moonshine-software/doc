<x-page
    title="Страницы"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#define', 'label' => 'Объявление'],
            ['url' => '#title', 'label' => 'Заголовок'],
            ['url' => '#layout', 'label' => 'Layout'],
            ['url' => '#breadcrumbs', 'label' => 'Breadcrumbs'],
            ['url' => '#alias', 'label' => 'Alias'],
            ['url' => '#view-page', 'label' => 'Быстрая страница'],
            ['url' => '#render', 'label' => 'Render'],
        ]
    ]
">

<x-p>
    От классов можно создавать экземпляры страниц и регистрировать их в админ-панели.
</x-p>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Для создания экземпляра страницы используется статический метод <code>make()</code>:
</x-p>

<x-code language="php">
make(
    ?string $title = null,
    ?string $alias = null,
    ?ResourceContract $resource = null
)
</x-code>

<x-ul>
    <li><code>title</code> - заголовок страницы;</li>
    <li><code>alias</code> - алиас для url страницы;</li>
    <li><code>resource</code> - ресурс, к которому принадлежит страница.</li>
</x-ul>

<x-code language="php">
use App\MoonShine\Pages\CustomPage; // [tl! focus]

//...

CustomPage::make('Custom page', 'custom_page') // [tl! focus]

//...
</x-code>

<x-sub-title id="define">Объявление страниц в системе</x-sub-title>

<x-p>
    Зарегистрировать страницу в системе и сразу добавить ссылку на нее в навигационное меню
    можно через сервис провайдер <code>MoonShineServiceProvider</code>:
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
    О расширенных настройках можно узнать в разделе
    <x-link :link="to_page('menu')" ><code>Меню</code></x-link>.
</x-moonshine::alert>

<x-p>
    Если вам необходимо только зарегистрировать страницу в системе без добавления в навигационное меню,
    то необходимо воспользоваться методом <code>pages()</code>:
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

<x-sub-title id="title">Заголовок/Подзаголовок</x-sub-title>

<x-p>
    Метод <code>setTitle()</code> позволяет изменить заголовок страницы,
    а метод <code>setSubTitle()</code> - подзаголовок.
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
    Метод <code>setLayout()</code> позволяет изменить шаблон <em>Layout</em> экземпляра страницы.
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

<x-sub-title id="breadcrumbs">Breadcrumbs</x-sub-title>

<x-p>
    Метод <code>setBreadcrumbs()</code> позволяет изменить хлебные крошки у страницы.
</x-p>

<x-code language="php">
use App\MoonShine\Pages\CustomPage;

//...

public function pages(): array
{
    return [
        CustomPage::make('Title page', 'custom_page')
            ->setBreadcrumbs([
                '#' => $this->title()
            ]) // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-sub-title id="alias">Alias</x-sub-title>

<x-p>
    Метод <code>alias()</code> позволяет изменить алиас для инстанса страницы.
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

<x-sub-title id="view-page">Быстрая страница</x-sub-title>

<x-p>
    Если необходимо добавить страницу не создавая класс, а просто указав blade view, то рекомендуем воспользоваться <code>ViewPage</code>
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
    Вы можете отображать быструю страницу и вне MoonShine, скажем просто вернув ее в Controller
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
