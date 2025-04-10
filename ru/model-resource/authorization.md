# Авторизация

- [Policy](#policy)
- [Собственная логика](#is-can)

---

<a name="policy"></a>
## Policy

**MoonShine** не отходит от концепций **Laravel** и также использует _Laravel policy_ для работы с правами доступа.

В контроллерах ресурсов **MoonShine** каждый метод будет проверяться на наличие разрешений.
Если у вас возникнут трудности, обратитесь к официальной документации [Laravel](https://laravel.com/docs/authorization#creating-policies).

По умолчанию проверка разрешений для ресурсов отключена.
Чтобы включить её, необходимо добавить свойство `$withPolicy`.

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

Доступные методы **Policy**:
- `viewAny` - страница индекса;
- `view` - детальная страница;
- `create` - создание записи;
- `update` - редактирование записи;
- `delete` - удаление записи;
- `massDelete` - массовое удаление записей;
- `restore` - восстановление записи после мягкого удаления;
- `forceDelete` - окончательное удаление записи из базы данных.

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

Создать **Policy** с готовым набором методов под **MoonShine** можно с помощью команды `moonshine:policy`.

```shell
php artisan moonshine:policy PostPolicy
```

После выполнения команды будет создан класс в директории `app/Policies`.

> [!WARNING]
> Если вы используете режим `$withPolicy` для системных ресурсов,
> вам необходимо самостоятельно их зарегистрировать в провайдере.
> По умолчанию **Laravel** автоматически регистрирует **Policy** для моделей в директории `app/Models`.

Пример регистрации для системных моделей, которые не располагаются в директории `app/Models`:

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
## Собственная логика

Также вы можете переопределить метод `isCan()` в ресурсе и реализовать собственную логику или дополнить текущую.

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
> Также рекомендуем ознакомится с разделом [Авторизация](/docs/{{version}}/security/authorization).
