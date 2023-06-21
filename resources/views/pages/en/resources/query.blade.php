<x-page title="Query" :sectionMenu="[
    'Sections' => [
        ['url' => '#filter', 'label' => 'Filter'],
        ['url' => '#order', 'label' => 'Order'],
        ['url' => '#scopes', 'label' => 'Scopes'],
    ]
]">

<x-sub-title id="filter">Filter</x-sub-title>

<x-p>
    Quite often you have to filter the output with a list of records from the very start.
</x-p>

<x-p>
    In general, you can easily override the query builder in the resource.
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
    By overriding the <code>performOrder()</code> method, you can customize the sorting of elements.
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
    Laravel has a handy scopes functionality that could be used within the MoonShine admin panel.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    At first, you need to create the scopes required.
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
