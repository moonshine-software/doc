<x-page title="Query" :sectionMenu="[
    'Разделы' => [
        ['url' => '#query', 'label' => 'Запрос'],
        ['url' => '#item-query', 'label' => 'Получение записи'],
        ['url' => '#search', 'label' => 'Поиск'],
        ['url' => '#order', 'label' => 'Сортировка'],
    ]
]">


<x-sub-title id="filter">Запрос</x-sub-title>

<x-p>
    Часто необходимо изначально изменить все запросы ресурса к базе данных.<br />
    Вы можете легко переопределить <em>query builder</em> в ресурсе.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function query(): Builder // [tl! focus:start]
    {
        return parent::query()
            ->where('active', true);
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="item-query">Получение записи</x-sub-title>

<x-p>
    Метод <code>resolveItemQuery()</code> используется,
    если требуется изменить запрос на получение записи из базы данных.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function resolveItemQuery(): Builder // [tl! focus:start]
    {
        return parent::resolveItemQuery()
            ->withTrashed();
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="search">Поиск</x-sub-title>

<x-p>
    Метод <code>searchQuery()</code> позволяет изменить запрос при поиске записей.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function searchQuery(): Builder // [tl! focus:start]
    {
        return parent::searchQuery()
            ->withTrashed();
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="order">Сортировка</x-sub-title>

<x-p>
    Переопределив метод <code>resolveOrder()</code>, можно кастомизировать сортировку записей.<br />
    Метод принимать в качестве параметров поле по которому производится сортировка
    и направление (по возрастанию или убыванию).
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    protected function resolveOrder(string $column, string $direction): self // [tl! focus:start]
    {
        $this->query()->orderBy($column, $direction);

        return $this;
    } // [tl! focus:end]

    //...
}
</x-code>

</x-page>
