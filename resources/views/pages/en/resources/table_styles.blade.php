<x-page title="Table styles" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Through resources it is possible to customize the color for tr/td for data display tables
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
            return 'green';
        }

        return parent::trStyles($item, $index);
    }

    public function tdStyles(Model $item, int $index, int $cell): string
    {
        if($cell === 6) {
            return 'red';
        }

        return parent::trStyles($item, $index);
    }
    // [tl! focus:end]

    //...
}
</x-code>

<x-p>
    Available colors: green, blue, red, pink, gray, purple, yellow
</x-p>

</x-page>
