<x-page title="Стили таблицы" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Через ресурсы есть возможность кастомизировать цвет для tr/td для таблиц отображения данных
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
    public function trClass(Model $item, int $index): string
    {
        if($item->id === 1 || $index === 2) {
            return 'green';
        }

        return parent::trClass($item, $index);
    }

    public function tdClass(Model $item, int $index, int $cell): string
    {
        if($cell === 6) {
            return 'red';
        }

        return parent::tdClass($item, $index, $cell);
    }
    // [tl! focus:end]

    //...
}
</x-code>

<x-p>
    Доступные цвета: green, blue, red, pink, gray, purple, yellow
</x-p>


<x-p>
    Также можно дополнять и кастомные стили
</x-p>

<x-code language="php">
// [tl! focus:start]
public function trStyles(Model $item, int $index): string
{
    if($item->id === 1 || $index === 2) {
        return 'background: red;';
    }

    return parent::trStyles($item, $index);
}

public function tdStyles(Model $item, int $index, int $cell): string
{
    if($cell === 6) {
        return 'background: red;';
    }

    return parent::tdStyles($item, $index, $cell);
}
// [tl! focus:end]
</x-code>

</x-page>
