<x-page title="Scopes" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Часто необходимо изначально отфильтровать выдачу со списком записей
</x-p>

<x-p>
    В целом вы можете легко переопределить query builder в ресурсе
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

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
    Но в Laravel также есть удобный функционал scopes и его как раз можно применять в рамках админ. панели moonShine
</x-p>

<x-alert>
    Для начала необходимо создать нужные scopes
</x-alert>

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

<x-next href="{{ route('section', 'resources-metrics') }}">Метрики</x-next>

</x-page>
