# Authorization

- [Policy](#policy)
- [Custom Logic](#is-can)

---

<a name="policy"></a>
## Policy

**MoonShine** does not deviate from **Laravel** concepts and also uses _Laravel policy_ for working with access rights.

In **MoonShine** resource controllers, each method will be checked for permissions.
If you encounter difficulties, refer to the official [Laravel](https://laravel.com/docs/authorization#creating-policies) documentation.

By default, permission checks for resources are disabled.
To enable it, you need to add the `$withPolicy` property.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected bool $withPolicy = true;

    // ...
}
```

Available **Policy** methods:
- `viewAny` - index page;
- `view` - detail page;
- `create` - creating a record;
- `update` - editing a record;
- `delete` - deleting a record;
- `massDelete` - mass deletion of records;
- `restore` - restoring a record after soft deletion;
- `forceDelete` - permanent deletion of a record from the database.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:5]
namespace App\Policies;

use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;
use MoonShine\Laravel\Models\MoonshineUser;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user)
    {
        return true;
    }

    public function view(MoonshineUser $user, Post $model)
    {
        return true;
    }

    public function create(MoonshineUser $user)
    {
        return true;
    }

    public function update(MoonshineUser $user, Post $model)
    {
        return true;
    }

    public function delete(MoonshineUser $user, Post $model)
    {
        return true;
    }

    public function restore(MoonshineUser $user, Post $model)
    {
        return true;
    }

    public function forceDelete(MoonshineUser $user, Post $model)
    {
        return true;
    }

    public function massDelete(MoonshineUser $user)
    {
        return true;
    }
}
```

You can create a **Policy** with a ready-made set of methods for **MoonShine** using the command `moonshine:policy`.

```shell
php artisan moonshine:policy PostPolicy
```

After executing the command, a class will be created in the `app/Policies` directory.

> [!WARNING]
> If you use `$withPolicy` mode for system resources,
> you need to register them with the provider yourself.
> By default, **Laravel** automatically registers a **Policy** for models in the `app/Models` directory.

Example registration for system models that are not located in the `app/Models` directory:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use App\Policies\MoonshineUserPolicy;
use App\Policies\MoonshineUserRolePolicy;
use MoonShine\Laravel\Models\MoonshineUserRole;
use MoonShine\Laravel\Models\MoonshineUser;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::policy(MoonshineUser::class, MoonshineUserPolicy::class);
        Gate::policy(MoonshineUserRole::class, MoonshineUserRolePolicy::class);
    }
}
```

<a name="is-can"></a>
## Custom Logic

You can also override the `isCan()` method in the resource and implement your own logic or supplement the current one.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Enums\Ability;

protected function isCan(Ability $ability): bool
{
    return parent::isCan($ability);
}
```

> [!TIP]
> We also recommend reviewing the [Authorization](/docs/{{version}}/security/authorization) section.
