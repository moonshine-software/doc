<x-page title="Действия форм" :sectionMenu="[]">

<x-p>
    По умолчанию в панели moonShine в формах всего 1 действие - сохранение.
    Но также есть возможность добавить свои кастомные действия
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;
use Leeto\MoonShine\FormActions\FormAction; // [tl! focus]

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Статьи';
    //...

    public function formActions(): array // [tl! focus:start]
    {
        return [
            FormAction::make('Удалить', function (Model $item) {
                $item->delete();
            }, 'Удален')->icon('delete')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image src="{{ asset('screenshots/form_actions.png') }}"></x-image>

</x-page>
