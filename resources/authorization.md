https://moonshine-laravel.com/docs/resource/models-resources/resources-authorization?change-moonshine-locale=en

------

## Authorization

We do not deviate from the Laravel concept and with the Laravel policy help we can work with access rights within the MoonShine admin panel.

In MoonShine resource controllers, each method will be checked for permissions. If you have any difficulties, check out the official Laravel documentation.

By default, permissions checking is disabled for resources. To enable, you need to add the property `withPolicy`.

- viewAny
- view
- create
- update
- delete
- massDelete
- restore
- forceDelete

```php
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
```

```php
namespace MoonShine\Resources;
 
use MoonShine\Models\MoonshineUser;
 
class PostResource extends ModelResource
{
//...
 
protected bool $withPolicy = true; 
 
//...
}

```
