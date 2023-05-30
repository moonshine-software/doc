<x-page title="Validation" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#messages', 'label' => 'Messages'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Validation is as simple as in the <code>FormRequests</code> classes from Laravel.
</x-p>

<x-p>
    It is enough to add rules in the <code>rules()</code> method of the resource in the usual way.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Models\MoonshineUser;

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

<x-image theme="light" src="{{ asset('screenshots/validation.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/validation_dark.png') }}"></x-image>

<x-sub-title id="messages">Messages</x-sub-title>

<x-p>
    Using the <code>validationMessages()</code> method, you can create your own validation error messages
</x-p>

<x-code language="php">
//...

public function validationMessages(): array // [tl! focus:start]
{
    return [
        'email.required' => 'Required email'
    ];
} // [tl! focus:end]

//...
</x-code>

</x-page>
