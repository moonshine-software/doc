<x-page title="Авторизация">

<x-p>
    Мы не отходим от концепции laravel и с помощью laravel policy можем работать с
    правами доступа в рамках админ. панели moonShine
</x-p>

<x-p>
    В ресурс-контроллерах moonShine каждый метод будет проверяться на наличие прав.
    Если возникают трудности, то ознакомьтесь с официально документацией Laravel
</x-p>

<x-p>
    По умолчанию для ресурсов проверка прав отключена. Чтобы включить, необходимо добавить свойство
    <code>$withPolicy</code>
</x-p>

<x-p>
    Доступные методы Policy:
</x-p>

<x-ul :items="['viewAny', 'view', 'create', 'update', 'delete', 'massDelete', 'restore', 'forceDelete']"></x-ul>

<x-code language="php">
namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Leeto\MoonShine\Models\MoonshineUser;
use App\Models\Post;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user)
    {
        //
    }

    public function view(MoonshineUser $user, Post $model)
    {
        //
    }

    public function create(MoonshineUser $user)
    {
        //
    }

    public function update(MoonshineUser $user, Post $model)
    {
        //
    }

    public function delete(MoonshineUser $user, Post $model)
    {
        //
    }

    public function massDelete(MoonshineUser $user)
    {
        //
    }

    public function restore(MoonshineUser $user, Post $model)
    {
        //
    }

    public function forceDelete(MoonshineUser $user, Post $model)
    {
        //
    }
}
</x-code>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;

class PostResource extends Resource
{
//...

public static bool $withPolicy = true; // [tl! focus]

//...
}
</x-code>

</x-page>
