<x-page title="Authorization">

<x-p>
    We do not deviate from the concept of laravel and with the help of laravel policy can work with access rights within the MoonShine admin panel
</x-p>

<x-p>
    In MoonShine resource controllers, each method will be checked for permissions. If difficulties arise, check the official Laravel documentation
</x-p>

<x-p>
    By default, permission checking is disabled for resources. To enable it, you must add the property
    <code>$withPolicy</code>
</x-p>

<x-p>
    Available methods Policy:
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
