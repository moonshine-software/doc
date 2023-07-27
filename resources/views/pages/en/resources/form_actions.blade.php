<x-page title="Form Actions" :sectionMenu="[
    'Sections' => [
        ['url' => '#view', 'label' => 'Display method'],
        ['url' => '#confirm', 'label' => 'Confirm the action'],
    ]
]">

<x-p>
    By default, forms in the MoonShine panel contain only 1 action - saving.
    But you can add your own custom actions
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Models\MoonshineUser;
use MoonShine\FormActions\FormAction; // [tl! focus]

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Articles';
    //...

    public function formActions(): array // [tl! focus:start]
    {
        return [
            FormAction::make('Delete', function (Model $item) {
                $item->delete();
            }, 'Removed')->icon('delete')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/form_actions.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/form_actions_dark.png') }}"></x-image>

@include('pages.en.resources.shared.actions_view', ['action' => 'FormAction'])
@include('pages.en.resources.shared.actions_confirm', ['action' => 'FormAction'])

</x-page>
