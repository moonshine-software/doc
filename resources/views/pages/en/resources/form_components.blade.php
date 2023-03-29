<x-page title="Form Components" :sectionMenu="[]">

<x-p>
    You can add your own components based on the abstract class to extend the possibilities
     <code>FormComponent</code>, they will be displayed below the main form
</x-p>

<x-p>
    Example of adding a <code>PermissionFormComponent</code> component
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;

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

</x-page>
