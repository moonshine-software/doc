<x-page title="Query" :sectionMenu="[
    'Разделы' => [
        ['url' => '#filter', 'label' => 'Filter'],
        ['url' => '#order', 'label' => 'Order'],
        ['url' => '#scopes', 'label' => 'Scopes'],
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
namespace MoonShine\Resources;

use Illuminate\Contracts\Database\Eloquent\Builder; // [tl! focus]

class PostResource extends Resource
{
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
    Переопределив метод <code>performOrder()</code> можно кастомизировать сортировку элементов.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use Illuminate\Contracts\Database\Eloquent\Builder; // [tl! focus]

class PostResource extends Resource
{
    //...
    public function performOrder(Builder $query, string $column, string $direction): Builder // [tl! focus:start]
    {
        return $query->orderBy(
            $column,
            $direction
        );
    } // [tl! focus:end]
    //...
}
</x-code>

<x-sub-title id="scopes">Scopes</x-sub-title>

<x-p>
    В Laravel также есть удобный функционал scopes, и его как раз можно применять в рамках админ-панели MoonShine.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Для начала необходимо создать нужные scopes.
</x-moonshine::alert>

<x-code language="shell">
php artisan make:scope ActiveUserScope
</x-code>

<x-code language="php">
namespace MoonShine\Resources;

use App\Models\Scopes\ActiveUserScope; // [tl! focus]

class PostResource extends Resource
{
    //...
    public function scopes(): array // [tl! focus:start]
    {
        return [
            new ActiveUserScope()
        ];
    } // [tl! focus:end]
    //...
}
</x-code>

</x-page>
