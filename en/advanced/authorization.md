https://moonshine-laravel.com/docs/resource/advanced/advanced-authorization?change-moonshine-locale=en

------
# Authorization

  - [Basics](#basics)
  - [Additional logic](#additional-logic)

<a name="basics"></a>
## Basics

The **MoonShine** admin panel does not depart from Laravel concepts and also using *Laravel policy* can work with access rights.

In MoonShine resource controllers, each method will be checked for permissions.If you have any difficulties, check out the official documentation [Laravel](https://laravel.com/docs/authorization#creating-policies)
By default, permissions checking is disabled for resources. To enable, you need to add the property `withPolicy`.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected bool $withPolicy = true;

    //...
}
```

To create a *Policy* with an admin panel user binding, you can use the console command:

```php
php artisan moonshine:policy
```

Available Policy methods:
- `viewAny` - index page;
- `view` - detailed page;
- `create` - creating a record;
- `update` - editing a record;
- `delete` - deleting a record;
- `massDelete` - mass deletion of records;
- `restore` - restoring a record after soft deletion;
- `forceDelete` - permanently deletes a record from the database.

```php
namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Post;
use MoonShine\Models\MoonshineUser;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user)
    {
        return true;
    }

    public function view(MoonshineUser $user, Post $item)
    {
        return true;
    }

    public function create(MoonshineUser $user)
    {
        return true;
    }

    public function update(MoonshineUser $user, Post $item)
    {
        return true;
    }

    public function delete(MoonshineUser $user, Post $item)
    {
        return true;
    }

    public function restore(MoonshineUser $user, Post $item)
    {
        return true;
    }

    public function forceDelete(MoonshineUser $user, Post $item)
    {
        return true;
    }

    public function massDelete(MoonshineUser $user)
    {
        return true;
    }
}
```

<a name="additional_logic"></a>
## Additional logic
   
If you need to add additional authorization logic to your application or external package, then use the `defineAuthorization` method in the `AuthServiceProvider`.

```php
use Illuminate\Database\Eloquent\Model;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\MoonShine;

public function boot(): void
{
    moonshine()->defineAuthorization(
        static function (ResourceContract $resource, Model $user, string $ability): bool {
            return true;
        }
    );
}
```
