<x-page title="Dashboard">
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

<x-next href="{{ route('section', 'actions-index') }}">Действия</x-next>
</x-page>
