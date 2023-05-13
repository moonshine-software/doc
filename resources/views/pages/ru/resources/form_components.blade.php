<x-page title="Компоненты форм" :sectionMenu="[]">

<x-p>
    Для расширения возможностей можно добавлять собственные компоненты на основе абстрактного класс
     <code>FormComponent</code>, они будут отображаться под основной формой
</x-p>

<x-p>
    Пример добавления компонента <code>PermissionFormComponent</code>
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Models\MoonshineUser;

class MoonShineUserResource extends Resource
{
    //...

    public function components(): array // [tl! focus:start]
    {
        return [
            PermissionFormComponent::make('Permissions')
                ->canSee(fn($user) => $user->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID)
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/form_components.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/form_components_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Если вы используете свою модель для аутентификации то вам нужно добавить в нее трейт <code>HasMoonShinePermissions</code>
</x-moonshine::alert>

</x-page>
