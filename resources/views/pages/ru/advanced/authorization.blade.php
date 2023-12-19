<x-page
    title="Авторизация"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#additional_logic', 'label' => 'Дополнительная логика'],
        ]
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Админ-панель <strong>MoonShine</strong> не отходит от концепций Laravel
    и также с помощью <em>Laravel policy</em> может работать с правами доступа.
</x-p>

<x-p>
    В ресурс-контроллерах MoonShine каждый метод будет проверяться на наличие прав.
    Если возникают трудности, то ознакомьтесь с официальной документацией
    <x-link link="https://laravel.com/docs/authorization#creating-policies" target="_blank">Laravel</x-link>.
</x-p>

<x-p>
    По умолчанию для ресурсов проверка прав отключена. Чтобы включить, необходимо добавить свойство
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
    Для создания <em>Policy</em> с привязкой пользователя админ-панели можно воспользоваться консольной командой:
</x-p>

<x-code language="shell">
    php artisan moonshine:policy
</x-code>

<x-p>
    Доступные методы Policy:
</x-p>
<x-ul>
    <li><code>viewAny</code> - индексная страница;</li>
    <li><code>view</code> - детальная страница;</li>
    <li><code>create</code> - создание записи;</li>
    <li><code>update</code> - редактирование записи;</li>
    <li><code>delete</code> - удаление записи;</li>
    <li><code>massDelete</code> - массовое удаление записей;</li>
    <li><code>restore</code> - восстановление записи после soft удаления;</li>
    <li><code>forceDelete</code> - безвозвратное удаление записи из базы данных.</li>
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

<x-sub-title id="additional_logic">Дополнительная логика</x-sub-title>

<x-p>
    Если необходимо добавить дополнительную логику авторизации в приложении или во внешнем пакете,
    то воспользуйтесь методом <code>defineAuthorization</code> в <code>AuthServiceProvider</code>.
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
