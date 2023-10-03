<x-page title="Dashboard" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basic', 'label' => 'Основы'],
        ['url' => '#resource-preview', 'label' => 'Блок с записями ресурса'],
        ['url' => '#text-block', 'label' => 'Текстовый блок']
    ]
]">

<x-sub-title id="basic">Основы</x-sub-title>
<x-p>
    Кастомизация главной страницы админ-панели осуществляется через класс <code>app/MoonShine/Dashboard.php</code>.
</x-p>

<x-p>
    На текущий момент в панели управления можно отобразить <x-link link="{{ route('moonshine.page', 'metrics-index') }}">метрики</x-link>
</x-p>

<x-p>
    Необходимые метрики регистрируются в методе blocks и располагаются в обвертке DashboardBlock
    для удобства построенния блоков панели
</x-p>

<x-p>
    Элементам также доступны методы декораций
    <x-link link="{{ route('moonshine.page', 'decorations-layout#grid-column') }}">Layout (columnSpan)</x-link>
</x-p>

<x-code language="php">
namespace App\MoonShine;

use App\Models\User;
use MoonShine\Dashboard\DashboardBlock;
use MoonShine\Dashboard\DashboardScreen;
use MoonShine\Metrics\ValueMetric;

class Dashboard extends DashboardScreen
{
    public function blocks(): array
    {
        return [
            DashboardBlock::make([
                ValueMetric::make('Пользователей')
                    ->value(User::query()->count())
            ])
        ];
    }
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/dashboard.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/dashboard_dark.png') }}"></x-image>

<x-sub-title id="resource-preview">Блок с записями ресурса</x-sub-title>

<x-p>
    Иногда крайне удобно добавить на главную страницу таблицу с записями из ресурса для быстого доступа.
    Для этого используйте <code>ResourcePreview</code>
</x-p>

<x-code language="php">
namespace App\MoonShine;

use App\Models\Article;
use MoonShine\Dashboard\DashboardBlock;
use MoonShine\Dashboard\DashboardScreen;
use MoonShine\Dashboard\ResourcePreview;

class Dashboard extends DashboardScreen
{
    public function blocks(): array
    {
        return [
            DashboardBlock::make([
                ResourcePreview::make(
                    new ArticleResource(), // Обязательный параметр с ресурсом MoonShine
                    'Latest articles' // Опционально - заголовок блока
                    Article::query()->where('active', true)->limit(2) // Опционально QueryBuilder
                )
            ])
        ];
    }
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_preview.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_preview_dark.png') }}"></x-image>

<x-sub-title id="text-block">Текстовый блок</x-sub-title>

<x-p>
    Для отображения простого текста
</x-p>

<x-code language="php">
namespace App\MoonShine;

use MoonShine\Dashboard\DashboardBlock;
use MoonShine\Dashboard\DashboardScreen;
use MoonShine\Dashboard\TextBlock;

class Dashboard extends DashboardScreen
{
    public function blocks(): array
    {
        return [
            DashboardBlock::make([
                TextBlock::make(
                    'Добро пожаловать',
                    view('welcome')->render()
                )
            ])
        ];
    }
}
</x-code>
</x-page>
