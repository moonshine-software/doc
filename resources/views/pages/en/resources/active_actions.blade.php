<x-page title="Available sections" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Quite often you need to create a resource with the disabled delete
    or add or edit section. And we are not talking about authorization here, but about the global exclusion of these sections.
    This could be done very easy by using the <code>activeActions</code> property in the resource
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

<x-p>Just eliminate the needless one</x-p>

<x-code language="php">
    public static array $activeActions = ['create']; // [tl! focus]
</x-code>

</x-page>
