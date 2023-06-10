<x-page title="Страницы" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basics', 'label' => 'Основы'],
        ['url' => '#without-title', 'label' => 'Без заголовка'],
        ['url' => '#layout', 'label' => 'Layout'],
    ]
]">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Можно создавать свои пустые страницы на основе blade view
    и <x-link link="{{ route('moonshine.custom_page', 'components-index') }}">UI components</x-link>,
    стилизовать по своему, а также организовывать какую-то логику.
</x-p>

<x-code language="php">
use Illuminate\Support\ServiceProvider;
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
    Третий аргумент - ваша кастомная blade view, которая располагается в resources/views.
</x-p>

<x-p>
    Четвертый аргумент - данные, необходимые для view.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    Можно использовать <code>blade components</code> у которых есть класс обработчик, чтобы добавить свою логику.
</x-moonshine::alert>

<x-sub-title id="without-title">Без заголовка</x-sub-title>

<x-p>
    Иногда не требуется вывод заголовка на кастомной странице, поэтому его можно скрыть используя метод <code>withoutTitle</code>.
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
    Можно использовать кастомный <code>layout</code>, для этого необходимо указать путь до него в соответствующем методе.
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

</x-page>
