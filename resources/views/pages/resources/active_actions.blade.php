<x-page title="Доступные разделы" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Так часто бывает, что необходимо создать ресурс, в котором будет исключена возможность удалять
    или добавлить или редактировать. И здесь речь не о авторизации, а о глобальном исключении этих разделов.
    Делается это крайне просто за счет свойства <code>activeActions</code> в ресурсе
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;

class PostResource extends BaseResource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Статьи';

    public static array $activeActions = ['create', 'show', 'edit', 'delete']; // [tl! focus]
    //...
}
</x-code>

<x-p>Достаточно исключить лишний</x-p>

<x-code language="php">
    public static array $activeActions = ['create']; // [tl! focus]
</x-code>

<x-next href="{{ route('section', 'resources-validation') }}">Валидация</x-next>

</x-page>