<x-page title="Валидация" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Валидация выполнена также просто как и в <code>FormRequests</code> классах от Laravel.
</x-p>

<x-p>
    Достаточно в привычной нам манере добавлять правила в методе <code>rules</code> ресурса.
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Статьи';
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

<x-image theme="light" src="{{ asset('screenshots/validation.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/validation_dark.png') }}"></x-image>

</x-page>
