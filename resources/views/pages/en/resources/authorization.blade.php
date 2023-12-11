<x-page title="Authorization">

<x-p>
    We do not deviate from the Laravel concept and with the help of Laravel policy we can work with
    access rights within the MoonShine admin panel
</x-p>

<x-p>
    In MoonShine resource controllers, each method will be checked for permissions.
    If you have any difficulties, check out the official Laravel documentation
</x-p>

<x-p>
    By default, permissions checking is disabled for resources. To enable, you need to add the property
    <code>$withPolicy</code>
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

class PostResource extends ModelResource
{
//...

protected bool $withPolicy = true; // [tl! focus]

//...
}
</x-code>

</x-page>
