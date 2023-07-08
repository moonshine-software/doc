<x-page
    title="Components"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#permissions', 'label' => 'Permissions'],
            ['url' => '#changelog', 'label' => 'Change log'],
        ]
    ]
">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    You can add your own components based on the <code>MoonShine\IndexComponent</code>, <code>MoonShine\FormComponent</code>
    or <code>MoonShine\DetailComponent</code> abstract classes to extend the functionality,
    they will be displayed below the main form or below detailed information respectively
</x-p>

<x-p>
    All custom components must be registered in the <code>components()</code> method
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

<x-sub-title id="permissions">Permissions</x-sub-title>

<x-p>
    Example of adding a <code>PermissionFormComponent</code> component
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
                ->canSee(auth()->user()->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID)
        ];
    }

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/form_components.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/form_components_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    If you use your model for authentication,
    then you need to add the <code>MoonShine\Traits\Models\HasMoonShinePermissions</code> trait to it
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    If you use your resource with admin output,
    you need to add the <code>MoonShine\Traits\Resource\WithUserPermissions</code> trait to the resource
</x-moonshine::alert>

<x-sub-title id="changelog">Change log</x-sub-title>

<x-p>
    To display the log of edits in the admin panel based on the user you must add
    the <code>MoonShine\Traits\Models\HasMoonShineChangeLog</code> trait to the model being used in the resource
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
    And also add a component in the <code>ChangeLogFormComponent</code> resource
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
                ->canSee(auth()->user()->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID),
        ];
    }
    // ...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/changelogs.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/changelogs_dark.png') }}"></x-image>

</x-page>
