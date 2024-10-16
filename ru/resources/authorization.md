# Авторизация

Мы не отклоняемся от концепции Laravel и с помощью Laravel Policy можем работать с правами доступа в админ-панели MoonShine.

В контроллерах ресурсов MoonShine каждый метод будет проверяться на наличие разрешений. Если у вас возникнут трудности, обратитесь к официальной документации Laravel.

По умолчанию проверка разрешений для ресурсов отключена. Чтобы включить, необходимо добавить свойство `withPolicy`.

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
