# Авторизация

  - [Основы](#basics)
  - [Дополнительная логика](#additional-logic)

---

<a name="basics"></a>
## Основы

Админ-панель **MoonShine** не отходит от концепций Laravel и также, используя *Laravel policy*, может работать с правами доступа.

В контроллерах ресурсов MoonShine каждый метод будет проверяться на наличие разрешений. Если у вас возникли трудности, ознакомьтесь с официальной документацией [Laravel](https://laravel.com/docs/authorization#creating-policies)
По умолчанию проверка разрешений для ресурсов отключена. Чтобы включить, необходимо добавить свойство `withPolicy`.

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

Для создания *Policy* с привязкой к пользователю админ-панели можно воспользоваться консольной командой:

```php
php artisan moonshine:policy
```

Доступные методы Policy:
- `viewAny` - страница индекса;
- `view` - детальная страница;
- `create` - создание записи;
- `update` - редактирование записи;
- `delete` - удаление записи;
- `massDelete` - массовое удаление записей;
- `restore` - восстановление записи после мягкого удаления;
- `forceDelete` - безвозвратно удаляет запись из базы данных.

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

<a name="additional-logic"></a>
## Дополнительная логика
   
Если вам нужно добавить дополнительную логику авторизации в ваше приложение или внешний пакет, используйте метод `defineAuthorization` в `AuthServiceProvider`.

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
