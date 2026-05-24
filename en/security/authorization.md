# Authorization

- [Basics](#basics)
- [Additional Logic](#additional-logic)

---

<a name="basics"></a>
## Basics

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
// [tl! collapse:start]
namespace App\Policies;

use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;
use MoonShine\Laravel\Models\MoonshineUser; // [tl! collapse:end]

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

You can create a **Policy** with a ready-made set of methods for **MoonShine** using the command `moonshine:policy`:

```shell
php artisan moonshine:policy PostPolicy
```

<a name="additional_logic"></a>
## Additional Logic

If you need to add additional authorization logic to your application or external package,
use the `authorizationRules()` method in `AuthServiceProvider` or `MoonShineServiceProvider`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Contracts\Core\ResourceContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use MoonShine\Support\Enums\Ability; // [tl! collapse:end]

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     *
     */
    public function boot(
        CoreContract $core,
        ConfiguratorContract $config,
    ): void
    {
        $config->authorizationRules(
            static function (ResourceContract $resource, Model $user, Ability $ability, Model $item): bool {
                return true;
            }
        );

        // ...
    }
}
```
