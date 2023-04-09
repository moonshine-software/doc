<x-page title="Available sections" :sectionMenu="$sectionMenu ?? null">

<x-p>
    It often happens that it is necessary to create a resource in which the ability to delete
     or add or edit. And here we are not talking about authorization, but about the global exclusion of these sections.
     This is done very simply due to the property <code>activeActions</code> in the resource
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Models\MoonshineUser;

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Articles';

    public static array $activeActions = ['create', 'show', 'edit', 'delete']; // [tl! focus]
    //...
}
</x-code>

<x-p>It is enough to eliminate the excess</x-p>

<x-code language="php">
    public static array $activeActions = ['create']; // [tl! focus]
</x-code>

</x-page>
