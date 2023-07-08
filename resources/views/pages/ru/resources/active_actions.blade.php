<x-page title="Доступные разделы" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Часто бывает, что необходимо создать ресурс, в котором будет исключена возможность удалять,
    или добавлять, или редактировать. И здесь речь не об авторизации, а о глобальном исключении этих разделов.
    Делается это крайне просто за счет свойства <code>activeActions</code> в ресурсе
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Articles';

    public static array $activeActions = ['create', 'show', 'edit', 'delete']; // [tl! focus]
    //...
}
</x-code>

<x-p>Достаточно исключить лишний</x-p>

<x-code language="php">
    public static array $activeActions = ['create']; // [tl! focus]
</x-code>

<x-p>Еще можно воспользоваться методом <code>getActiveActions()</code> и задать свою логику для доступных разделов</x-p>

<x-code language="php">
namespace MoonShine\Resources;

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Articles';

    public static array $activeActions = ['create', 'show', 'edit']; // [tl! focus]

    //...

    public function getActiveActions(): array // [tl! focus:start]
    {
        if (auth()->id() === $this->getItem()?->author_id) {
            return array_merge(static::$activeActions, ['delete']);
        }

        return static::$activeActions;
    } // [tl! focus:end]
}
</x-code>

</x-page>
