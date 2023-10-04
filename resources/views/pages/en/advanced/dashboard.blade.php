<x-page title="Dashboard" :sectionMenu="[
    'Sections' => [
        ['url' => '#basic', 'label' => 'Basics'],
        ['url' => '#resource-preview', 'label' => 'Block with resource records'],
        ['url' => '#text-block', 'label' => 'Text block']
    ]
]">

<x-sub-title id="basic">Basics</x-sub-title>
<x-p>
    The home page of the admin panel can be customized through the class <code>app/MoonShine/Dashboard.php</code>.
</x-p>

<x-p>
    Currently you can display <x-link link="{{ route('moonshine.custom_page', 'metrics-index') }}">metrics</x-link> in the control panel
</x-p>

<x-p>
    The required metrics are registered in the blocks method and placed in the DashboardBlock wrapper for a convenient arrangement of the panel
</x-p>

<x-p>
    <x-link link="{{ route('moonshine.custom_page', 'decorations-layout#grid-column') }}">Layout (columnSpan)</x-link>
    decorating methods are also available for the elements
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
                ValueMetric::make('Users')
                    ->value(User::query()->count())
            ])
        ];
    }
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/dashboard.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/dashboard_dark.png') }}"></x-image>

<x-sub-title id="resource-preview">Block with resource records</x-sub-title>

<x-p>
    Sometimes it is extremely convenient to add a table with records from a resource to the main page for quick access.
    To do this, use <code>ResourcePreview</code>
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
                    new ArticleResource(), // Mandatory parameter with MoonShine resource
                    'Latest articles', // Optional - block header
                    Article::query()->where('active', true)->limit(2) // Optional QueryBuilder
                )
            ])
        ];
    }
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_preview.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_preview_dark.png') }}"></x-image>

<x-sub-title id="text-block">Text block</x-sub-title>

<x-p>
    To display plain text
</x-p>

<x-code language="php">
namespace App\MoonShine;

use MoonShine\Dashboard\DashboardBlock;
use MoonShine\Dashboard\DashboardScreen;Welcome
use MoonShine\Dashboard\TextBlock;

class Dashboard extends DashboardScreen
{
    public function blocks(): array
    {
        return [
            DashboardBlock::make([
                TextBlock::make(
                    'Welcome',
                    view('welcome')->render()
                )
            ])
        ];
    }
}
</x-code>
</x-page>
