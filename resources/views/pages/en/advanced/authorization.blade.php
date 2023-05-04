<x-page title="Authorization">

<x-p>
    We stick to the Laravel concept, so using the Laravel policy we can operate
    access rights from the MoonShine admin panel
</x-p>

<x-p>
    MoonShine resource controllers check each method for permissions.
    If difficulties arise, check the official Laravel documentation
</x-p>

<x-p>
    By default, permission checking is disabled for resources. To enable it, you must add the
    <code>$withPolicy</code> property
</x-p>

<x-p>
    Available Policy methods:
</x-p>

<x-ul :items="['viewAny', 'view', 'create', 'update', 'delete', 'massDelete', 'restore', 'forceDelete']"></x-ul>

<x-code language="php">
namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use MoonShine\Models\MoonshineUser;
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
namespace MoonShine\Resources;

use MoonShine\Models\MoonshineUser;

class PostResource extends Resource
{
//...

public static bool $withPolicy = true; // [tl! focus]

//...
}
</x-code>

</x-page>
