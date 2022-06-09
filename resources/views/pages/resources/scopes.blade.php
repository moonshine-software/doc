<x-page title="Scopes" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Часто необходимо изначально отфильтровать выдачу со списком записей
</x-p>

<x-p>
    В Laravel есть удобный функционал scopes и его как раз можно применять в рамках админ. панели moonShine
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

class PostResource extends BaseResource
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

<x-next href="{{ route('section', 'menu-index') }}">Меню</x-next>

</x-page>