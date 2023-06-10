<x-page title="Mass actions" :sectionMenu="[
    'Sections' => [
        ['url' => '#view', 'label' => 'Display method'],
        ['url' => '#confirm', 'label' => 'Confirm the action'],
    ]
]">

<x-p>
    By default, the table in the MoonShine panel contains only 1 mass action for the elements - deletion.
    But you can also add your own custom bulk actions
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
    The first argument is the name of the action.
    The second argument is a callback with the current element parameter.
    The third argument is the message that will be displayed after the execution of the action.
</p>

@include('pages.en.resources.shared.actions_config', ['action' => 'BulkAction'])

</x-page>
