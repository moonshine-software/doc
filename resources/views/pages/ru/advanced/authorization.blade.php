<x-page title="Авторизация" :sectionMenu="[
    'Разделы' => [
        ['url' => '#policy', 'label' => 'Policy'],
        ['url' => '#extension', 'label' => 'Расширение'],
    ]
]">

<x-p>
    В админ панели Moonshine реализована система авторизации, которая по умолчанию включена,
    но если нужно разрешить доступ для всех пользователей, ее можно отключить в файле конфигурации <code>config/moonshine.php</code>
</x-p>

<x-code language="php">
return [
// ..
'auth' => [
    // ..
    'enable' => true, // [tl! focus]
    // ..
],
// ..
</x-code>

<x-image theme="light" src="{{ asset('screenshots/login.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/login_dark.png') }}"></x-image>

<x-sub-title id="policy">Policy</x-sub-title>

<x-p>
    Мы не отходим от концепции laravel и с помощью laravel policy можем работать с
    правами доступа в рамках админ панели MoonShine
</x-p>

<x-p>
    В ресурс-контроллерах MoonShine каждый метод будет проверяться на наличие прав.
    Если возникают трудности, то ознакомьтесь с официально документацией Laravel
</x-p>

<x-p>
    По умолчанию для ресурсов проверка прав отключена. Чтобы включить, необходимо добавить свойство
    <code>$withPolicy</code>
</x-p>

<x-p>
    Доступные методы Policy:
</x-p>

<x-ul :items="['viewAny', 'view', 'create', 'update', 'delete', 'massDelete', 'restore', 'forceDelete']"></x-ul>

<x-code language="php">
namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Leeto\MoonShine\Models\MoonshineUser;
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
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;

class PostResource extends Resource
{
//...

public static bool $withPolicy = true; // [tl! focus]

//...
}
</x-code>

<x-sub-title id="extension">Расширение</x-sub-title>

<x-p>
    Если используете собственный guard, provider, то их можно переопределить в конфигурации,
    а так же модель <code>MoonshineUser</code>
</x-p>

<x-code language="php">
return [
// ..
'auth' => [
    // ..
    'guard' => 'moonshine',
    'guards' => [
        'moonshine' => [
            'driver' => 'session',
            'provider' => 'moonshine',
        ],
    ],
    'providers' => [
        'moonshine' => [
            'driver' => 'eloquent',
            'model' => MoonshineUser::class,
        ],
    ],
    // ..
],
// ..
</x-code>

<x-p>
    Если возникает потребность добавить текст под кнопкой войти (например добавить кнопку регистрации),
    то это легко можно сделать через файл конфигурации
</x-p>

<x-code language="php">
return [
// ..
'auth' => [
    // ..
        'footer' => '<a href="https://cutcode.dev/" target="_blank">CutCode</a>'
    ],
    // ..
],
// ..
</x-code>

</x-page>
