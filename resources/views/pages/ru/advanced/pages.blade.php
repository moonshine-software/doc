<x-page title="Страницы" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#without-title', 'label' => 'Без заголовка'],
        ['url' => '#layout', 'label' => 'Layout'],
        ['url' => '#class', 'label' => 'class CustomPage'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Можно создавать свои пустые страницы на основе blade view
    и <x-link link="{{ route('moonshine.page', 'components-index') }}">UI components</x-link>.
    Стилизовать их по-своему, а также организовывать какую-то логику.
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
    Первый аргумент - заголовок страницы.
</x-p>

<x-p>
    Второй аргумент - slug страницы для формирования url.
</x-p>

<x-p>
    Третий аргумент - ваша кастомная blade view, которая располагается в <code>resources/views</code>.
</x-p>

<x-p>
    Четвертый аргумент - данные, необходимые для view.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Можно использовать <code>blade components</code> у которых есть класс-обработчик, чтобы добавить свою логику.
</x-moonshine::alert>

<x-sub-title id="without-title">Без заголовка</x-sub-title>

<x-p>
    Иногда не требуется вывод заголовка на кастомной странице, поэтому его можно скрыть, используя метод <code>withoutTitle</code>.
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
    Можно использовать кастомный <code>layout</code>, для этого необходимо указать путь к нему в соответствующем методе.
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
                    ->layout('path') // [tl! focus]
            )
        ]);
    }
}
</x-code>

<x-sub-title id="class">class CustomPage</x-sub-title>

<x-p>
    Страницы можно создавать через класс, для этого достаточно выполнить команду:
</x-p>

<x-code language="shell">
    php artisan moonshine:page ExamplePage
</x-code>

<x-p>
    В результате будет создан <code>ExamplePage</code> класс, который будет основой кастомной страницы.
    Располагается он по-умолчанию в директории <code>app/MoonShine/Pages</code>.
</x-p>

<x-p>При выполнении команды можно сразу задать для вашей страницы алиас, заголовок и blade шаблон.</x-p>

<x-code language="shell">
    php artisan moonshine:page ExamplePage --alias="example" --title="Example Page" --view="pages.example"
</x-code>

<x-p>После создания страницы, ее можно добавить в меню.</x-p>

<x-code language="php">
use Illuminate\Support\ServiceProvider;
use MoonShine\Pages\ExamplePage; // [tl! focus]

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([
            MenuItem::make('Example', new ExamplePage()) // [tl! focus]
        ]);
    }
}
</x-code>

</x-page>
