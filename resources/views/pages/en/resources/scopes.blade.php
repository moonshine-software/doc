<x-page title="Scopes" :sectionMenu="$sectionMenu ?? null">

<x-p>
    It is often necessary to initially filter the output with a list of records
</x-p>

<x-p>
    In general, you can easily override the query builder in the resource
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Illuminate\Contracts\Database\Eloquent\Builder;

class PostResource extends Resource
{
//...

public function query(): Builder
{
    return parent::query()
        ->where('active', true);
}

//...
}
</x-code>

<x-p>
    But Laravel also has a handy scopes functionality and can be used within the MoonShine admin panel
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    First, you need to create the necessary scopes
</x-moonshine::alert>

<x-code language="shell">
php artisan make:scope ActiveUserScope
</x-code>

<x-code language="php">
namespace Leeto\MoonShine\Resources;


use App\Models\Scopes\ActiveUserScope;

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
