<x-page title="Custom actions" :sectionMenu="[
    'Sections' => [
        ['url' => '#register', 'label' => 'Registration'],
        ['url' => '#condition', 'label' => 'Display condition'],
        ['url' => '#view', 'label' => 'Display method'],
        ['url' => '#confirm', 'label' => 'Confirm the action'],
    ]
]">

<x-sub-title id="register">Registration</x-sub-title>

<x-p>
    By default, the table in the MoonShine panel contains only 2 actions for items - edit and delete.
    But you can also add your own custom actions
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Models\MoonshineUser;
use MoonShine\ItemActions\ItemAction; // [tl! focus]

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Articles';
    //...

    public function itemActions(): array // [tl! focus:start]
    {
        return [
            ItemAction::make('Deactivating', function (Model $item) {
                $item->update(['active' => false]);
            }, 'Deactivated')->icon('app')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<p>
    The first argument is the name of the action.
    The second argument is the callback with the current item parameter.
    The third argument - the message that will be displayed after the action is executed
</p>

<x-sub-title id="condition">Display condition</x-sub-title>

<x-p>
    Display action by condition
</x-p>

<x-code language="php">
...
public function itemActions(): array
{
    return [
        ItemAction::make('Restore', function (Model $item) {
            $item->restore();
        }, 'Retrieved')
            ->canSee(fn(Model $item) => $item->trashed()) // [tl! focus]
    ];
}
...
</x-code>

@include('pages.en.resources.shared.actions_config', ['action' => 'ItemAction'])

</x-page>
