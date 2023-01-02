<x-page title="Dashboard" :sectionMenu="[
    'Разделы' => [
        ['url' => '#basic', 'label' => 'Основы'],
        ['url' => '#resource-preview', 'label' => 'Блок с записями ресурса']
    ]
]">

<x-sub-title id="basic">Основы</x-sub-title>
<x-p>
    Кастомизация главной страницы админ. панели осуществляется через класс <code>app/MoonShine/Dashboard.php</code>.
</x-p>

<x-p>
    На текущий момент в панели управления можно отобразить <x-link link="{{ route('section', 'metrics-index') }}">метрики</x-link>
</x-p>

<x-p>
    Необходимые метрики регистрируются в методе blocks и располагаются в обвертка DashboardBlock
    для удобства построенния блоков панели
</x-p>

<x-code language="php">
namespace App\MoonShine;

use App\Models\User;
use Leeto\MoonShine\Dashboard\DashboardBlock;
use Leeto\MoonShine\Dashboard\DashboardScreen;
use Leeto\MoonShine\Metrics\ValueMetric;

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

<x-sub-title id="resource-preview">Блок с записями ресурса</x-sub-title>

<x-p>
    Иногда крайне удобно добавить на главную страницу таблицу с записями из ресурса для быстого доступа.
    Для этого используйте <code>ResourcePreview</code>
</x-p>

<x-code language="php">
namespace App\MoonShine;

use App\Models\Article;
use Leeto\MoonShine\Dashboard\DashboardBlock;
use Leeto\MoonShine\Dashboard\DashboardScreen;
use Leeto\MoonShine\Dashboard\ResourcePreview;

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

<x-image src="{{ asset('screenshots/resource_preview.png') }}"></x-image>
</x-page>
