<x-page title="Form Actions" :sectionMenu="[]">

<x-p>
    By default, there is only 1 action in the MoonShine panel in forms - saving.
     But it is also possible to add your own custom actions
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;
use Leeto\MoonShine\FormActions\FormAction; // [tl! focus]

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

</x-page>
