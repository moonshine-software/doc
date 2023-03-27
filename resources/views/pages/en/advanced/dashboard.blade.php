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
    Currently in the control panel you can display <x-link link="{{ route('moonshine.custom_page', 'metrics-index') }}">metrics</x-link>
</x-p>

<x-p>
    The required metrics are registered in the blocks method and placed in the DashboardBlock wrapper for convenient panel building
</x-p>

<x-p>
    Decorating methods are also available to the elements
    <x-link link="{{ route('moonshine.custom_page', 'decorations-layout#grid-column') }}">Layout (columnSpan)</x-link>
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
                ValueMetric::make('Users')
                    ->value(User::query()->count())
            ])
        ];
    }
}
</x-code>

<x-sub-title id="resource-preview">Block with resource records</x-sub-title>

<x-p>
    Sometimes it is extremely convenient to add a table with records from a resource to the main page for quick access.
    To do this, use <code>ResourcePreview</code>
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
                    new ArticleResource(), // Mandatory parameter with MoonShine resource
                    'Latest articles' // Optional - block header
                    Article::query()->where('active', true)->limit(2) // Optional QueryBuilder
                )
            ])
        ];
    }
}
</x-code>

<x-image src="{{ asset('screenshots/resource_preview.png') }}"></x-image>


<x-sub-title id="text-block">Text block</x-sub-title>

<x-p>
    To display plain text
</x-p>

<x-code language="php">
namespace App\MoonShine;

use Leeto\MoonShine\Dashboard\DashboardBlock;
use Leeto\MoonShine\Dashboard\DashboardScreen;Welcome
use Leeto\MoonShine\Dashboard\TextBlock;

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
