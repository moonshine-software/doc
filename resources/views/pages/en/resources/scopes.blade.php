<x-page title="Scopes" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Quite often you have to filter the output with a list of records from the very start
</x-p>

<x-p>
    In general, you can easily override the query builder in the resource
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

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
    But Laravel also has a handy scopes functionality that could be used within the MoonShine admin panel
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    At first, you need to create the scopes required
</x-moonshine::alert>

<x-code language="shell">
php artisan make:scope ActiveUserScope
</x-code>

<x-code language="php">
namespace MoonShine\Resources;


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
