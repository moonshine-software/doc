<x-page title="Mass actions" :sectionMenu="[
    'Sections' => [
        ['url' => '#view', 'label' => 'Display method'],
        ['url' => '#confirm', 'label' => 'Action confirmation'],
    ]
]">

<x-p>
    By default, in the MoonShine panel in the table, there is only 1 mass action on elements - deletion.
    But it is also possible to add your own custom bulk actions
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Models\MoonshineUser;
use MoonShine\BulkActions\BulkAction; // [tl! focus]

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Articles';
    //...

    public function bulkActions(): array // [tl! focus:start]
    {
        return [
            BulkAction::make('Deactivation', function (Model $item) {
                $item->update(['active' => false]);
            }, 'Deactivated')->icon('app')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<p>
    The first argument is the name of the action,
    The second callback argument with the current element parameter,
    The third argument is the message that will be displayed after the action is executed.
</p>

@include('pages.en.resources.shared.actions_config', ['action' => 'BulkAction'])

</x-page>
