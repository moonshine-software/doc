<x-page
    title="Компоненты"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#permissions', 'label' => 'Разрешения'],
            ['url' => '#changelog', 'label' => 'История изменений'],
        ]
    ]
">

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Для расширения возможностей можно добавлять собственные компоненты на основе абстрактных классов
    <code>MoonShine\FormComponent</code> или <code>MoonShine\DetailComponent</code>,
    они будут отображаться под основной формой или под детальной информацией соответственно
</x-p>

<x-p>
    Все кастомные компоненты необходимо зарегистрировать в методе <code>components()</code>
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

class ArticleResource extends Resource
{
    //...

    public function components(): array // [tl! focus:2]
    {
        return [
            // ...
        ];
    } // [tl! focus:-1]

    //...
}
</x-code>

<x-sub-title id="permissions">Разрешения</x-sub-title>

<x-p>
    Пример добавления компонента <code>PermissionFormComponent</code>
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\FormComponents\PermissionFormComponent; // [tl! focus]
use MoonShine\Models\MoonshineUserRole;
use MoonShine\Resources\Resource;

class MoonShineUserResource extends Resource
{
    //...

    public function components(): array
    {
        return [
            PermissionFormComponent::make('Permissions') // [tl! focus]
                ->canSee(fn($user) => $user->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID)
        ];
    }

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/form_components.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/form_components_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если вы используете свою модель для аутентификации,
    то вам нужно добавить в нее трейт <code>MoonShine\Traits\Models\HasMoonShinePermissions</code>
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если вы используете свой ресурс с выводом администраторов,
    необходимо ресурсу добавить трейт <code>MoonShine\Traits\Resource\WithUserPermissions</code>
</x-moonshine::alert>

<x-sub-title id="changelog">История изменений</x-sub-title>

<x-p>
    Чтобы в админ-панели отображалась история редактирования записей на основе пользователя, необходимо
    модели, которая используется в ресурсе, добавить трейт <code>MoonShine\Traits\Models\HasMoonShineChangeLog</code>
</x-p>

<x-code language="php">
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MoonShine\Traits\Models\HasMoonShineChangeLog; // [tl! focus]

class Article extends Model
{
    use HasMoonShineChangeLog; // [tl! focus]

    //...
}
</x-code>

<x-p>
    А также добавить компонент в ресурсе <code>ChangeLogFormComponent</code>
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\FormComponents\ChangeLogFormComponent; // [tl! focus]
use MoonShine\Models\MoonshineUserRole;
use MoonShine\Resources\Resource;

class ArticleResource extends Resource
{
    // ...
    public function components(): array
    {
        return [
            ChangeLogFormComponent::make('Change log') // [tl! focus]
                ->canSee(fn ($user) => $user->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID),
        ];
    }
    // ...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/changelogs.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/changelogs_dark.png') }}"></x-image>

</x-page>
