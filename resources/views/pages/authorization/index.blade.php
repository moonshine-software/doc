<x-page title="Основы">

<x-p>
    Мы не отходим от концепции laravel и с помощью laravel policy можем работать с
    правами доступа в рамках админ. панели moonShine
</x-p>

<x-p>
    В ресурс контроллерах moonShine каждый метод будет проверяться на наличие прав.
    Если возникают трудности то ознакомьтесь с официально документацией Laravel
</x-p>

<x-p>
    По умолчанию для ресурсов проверка прав отключена, чтобы включить необходимо добавить свойство
    <code>$withPolicy</code>
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;

class PostResource extends BaseResource
{
//...

public static bool $withPolicy = true; // [tl! focus]

//...
}
</x-code>

<x-next href="{{ route('section', 'events-index') }}">Events</x-next>

</x-page>