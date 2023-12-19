<x-page
    title="Authorization"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#additional_logic', 'label' => 'Additional logic'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
   The <strong>MoonShine</strong> admin panel does not depart from Laravel concepts
     and also using <em>Laravel policy</em> can work with access rights.
</x-p>

<x-p>
    In MoonShine resource controllers, each method will be checked for permissions.
     If you have any difficulties, check out the official documentation
    <x-link link="https://laravel.com/docs/authorization#creating-policies" target="_blank">Laravel</x-link>.
</x-p>

<x-p>
    By default, permissions checking is disabled for resources. To enable, you need to add the property
    <code>withPolicy</code>.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected bool $withPolicy = true; // [tl! focus]

    //...
}
</x-code>

<x-p>
    To create a <em>Policy</em> with an admin panel user binding, you can use the console command:
</x-p>

<x-code language="shell">
    php artisan moonshine:policy
</x-code>

<x-p>
    Available Policy methods:
</x-p>
<x-ul>
    <li><code>viewAny</code> - index page;</li>
    <li><code>view</code> - detailed page;</li>
    <li><code>create</code> - creating a record;</li>
    <li><code>update</code> - editing a record;</li>
    <li><code>delete</code> - deleting a record;</li>
    <li><code>massDelete</code> - mass deletion of records;</li>
    <li><code>restore</code> - restoring a record after soft deletion;</li>
    <li><code>forceDelete</code> - permanently deletes a record from the database.</li>
</x-ul>

<x-code language="php">
namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Post;
use MoonShine\Models\MoonshineUser;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user) // [tl! focus]
    {
        return true;
    }

    public function view(MoonshineUser $user, Post $item) // [tl! focus]
    {
        return true;
    }

    public function create(MoonshineUser $user) // [tl! focus]
    {
        return true;
    }

    public function update(MoonshineUser $user, Post $item) // [tl! focus]
    {
        return true;
    }

    public function delete(MoonshineUser $user, Post $item) // [tl! focus]
    {
        return true;
    }

    public function restore(MoonshineUser $user, Post $item) // [tl! focus]
    {
        return true;
    }

    public function forceDelete(MoonshineUser $user, Post $item) // [tl! focus]
    {
        return true;
    }

    public function massDelete(MoonshineUser $user) // [tl! focus]
    {
        return true;
    }
}
</x-code>

<x-sub-title id="additional_logic">Additional logic</x-sub-title>

<x-p>
    If you need to add additional authorization logic to your application or external package,
    then use the <code>defineAuthorization</code> method in the <code>AuthServiceProvider</code>.
</x-p>

<x-code language="php">
use Illuminate\Database\Eloquent\Model;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\MoonShine;

public function boot(): void
{
    MoonShine::defineAuthorization(
        static function (ResourceContract $resource, Model $user, string $ability): bool {
            return true;
        }
    ); // [tl! focus:-4]
}
</x-code>

</x-page>
