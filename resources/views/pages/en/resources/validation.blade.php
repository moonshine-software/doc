<x-page title="Validation" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Validation is as simple as in the <code>FormRequests</code> classes from Laravel.
</x-p>

<x-p>
    It is enough to add rules in the <code>rules</code> method of the resource in the usual way.
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Articles';
    //...

    public function rules($item): array // [tl! focus:start]
    {
        return [
            'title' => ['required', 'string', 'min:5']
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image src="{{ asset('screenshots/validation.png') }}"></x-image>

</x-page>
