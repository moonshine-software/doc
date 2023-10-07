<x-page title="Query" :sectionMenu="[
    'Разделы' => [
        ['url' => '#filter', 'label' => 'Filter'],
        ['url' => '#order', 'label' => 'Order'],
    ]
]">

<x-sub-title id="filter">Filter</x-sub-title>

<x-p>
    Часто необходимо изначально отфильтровать выдачу со списком записей.
</x-p>

<x-p>
    В целом, вы можете легко переопределить query builder в ресурсе.
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

<x-sub-title id="order">Order</x-sub-title>

<x-p>
    Переопределив метод <code>resolveOrder()</code> можно кастомизировать сортировку элементов.<br />
    Метод принимать в качестве параметров столбец по которому производится сортировка
    и направление (по возрастанию или убыванию)
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
