<x-page title="Кастомные действия" :sectionMenu="$sectionMenu ?? null">

<x-p>
    По умолчанию в панели moonShine в таблице всего 2 действия над элементами - редактирование и удаления.
    Но также есть возможность добавить свои кастомные действия
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;
use Leeto\MoonShine\Actions\ExportAction; // [tl! focus]

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Статьи';
    //...

    public function itemActions(): array // [tl! focus:start]
    {
        return [
            ItemAction::make('Деактивация', function (Model $item) {
                $item->update(['active' => false]);
            }, 'Деактивирован')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<p>
    Первый аргумент - Наименование экшена,
    Второй аргумент callback с параметром текущего элемента,
    Третий аргумент - сообщение, которое отобразится после выполнения экшена
</p>

    <x-next href="{{ route('section', 'menu-index') }}">Меню</x-next>

</x-page>
