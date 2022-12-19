<x-page title="Стили таблицы" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Через ресурсы есть возможность кастомизировать стили для tr/td для таблиц отображения данных
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;
use Leeto\MoonShine\ItemActions\ItemAction; // [tl! focus]

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Статьи';
    //...

    // [tl! focus:start]
    public function trStyles(Model $item, int $index): string
    {
        if($item->id === 1 || $index === 2) {
            return 'background: gray;';
        }

        return '';
    }

    public function tdStyles(Model $item, int $index, int $cell): string
    {
        if($cell === 6) {
            return 'background: red; color: gray;';
        }

        return '';
    }
    // [tl! focus:end]

    //...
}
</x-code>

</x-page>
