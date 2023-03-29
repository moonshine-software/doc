<x-page title="History of changes" :sectionMenu="$sectionMenu ?? null">

<x-p>
    To the admin. the panel displayed the post editing history based on the user needed
     the model that is used in the resource add a trait <code>Leeto\MoonShine\Traits\Models\HasMoonShineChangeLog</code>
</x-p>

<x-code language="php">
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Leeto\MoonShine\Traits\Models\HasMoonShineChangeLog; // [tl! focus]

class Article extends Model
{
    use HasMoonShineChangeLog; // [tl! focus]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/changelogs.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/changelogs_dark.png') }}"></x-image>

</x-page>
