<x-page title="History of changes" :sectionMenu="$sectionMenu ?? null">

<x-p>
    To the admin panel displayed the post editing history based on the user needed
    the model that is used in the resource add a trait <code>MoonShine\Traits\Models\HasMoonShineChangeLog</code>
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
    And also add a component in the resource <code>ChangeLogFormComponent</code>
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\FormComponents\ChangeLogFormComponent; // [tl! focus]
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
