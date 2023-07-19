<x-page title="Действия форм" :sectionMenu="[
    'Разделы' => [
        ['url' => '#view', 'label' => 'Способ отображения'],
        ['url' => '#confirm', 'label' => 'Подтверждение действия'],
    ]
]">

<x-p>
    По умолчанию в панели MoonShine в формах всего 1 действие - сохранение.
    Но также есть возможность добавить свои кастомные действия
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Models\MoonshineUser;
use MoonShine\FormActions\FormAction; // [tl! focus]

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

<x-image theme="light" src="{{ asset('screenshots/form_actions.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/form_actions_dark.png') }}"></x-image>

@include('pages.ru.resources.shared.actions_view', ['action' => 'FormAction'])
@include('pages.ru.resources.shared.actions_confirm', ['action' => 'FormAction'])

</x-page>
