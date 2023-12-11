<x-page title="Form" :sectionMenu="[
    'Sections' => [
        ['url' => '#validation', 'label' => 'Validation'],
        ['url' => '#buttons', 'label' => 'Buttons'],
        ['url' => '#async', 'label' => 'Asynchronous mode'],
    ]
]">

<x-sub-title id="validation">Basics</x-sub-title>

<x-p>
    Validation is as easy as in the <code>FormRequests</code> classes from Laravel.
</x-p>

<x-p>
    It is enough to add rules in the <code>rules()</code> method of the model resource in the usual manner.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

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
    Using the <code>validationMessages()</code> method you can create your own validation error messages.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function validationMessages(): array // [tl! focus:start]
    {
        return [
            'email.required' => 'Required email'
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="prepare">Preparing input data for verification</x-sub-title>

<x-p>
    If you need to prepare or clean up any data from the request before applying your validation rules,
    you can use the <code>prepareForValidation()</code> method.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function prepareForValidation(): void // [tl! focus:start]
    {
        request()?->merge([
            'email' => request()
                ?->string('email')
                ->lower()
                ->value()
        ]);
    } // [tl! focus:end]

    //...
}
</x-code>

<x-sub-title id="buttons">Buttons</x-sub-title>

<x-p>
    To add buttons, use ActionButton and the <code>FormButtons</code> or <code>buttons</code> methods in the resource
</x-p>
<x-moonshine::alert type="default" icon="heroicons.information-circle">
    <x-link link="{{ route('moonshine.page', 'action_button') }}">More details ActionButton</x-link>
</x-moonshine::alert>

<x-code>
public function formButtons(): array
{
    return [
        ActionButton::make('Link', '/endpoint'),
    ];
}
</x-code>

<x-p>
    You can also use the <code>buttons</code> method, but in this case the buttons will be on all other pages of the resource
</x-p>

<x-code>
public function buttons(): array
{
    return [
        ActionButton::make('Link', '/endpoint'),
    ];
}
</x-code>

<x-sub-title id="async">Asynchronous mode</x-sub-title>

<x-p>
    Switch mode without reboot to save data
</x-p>

<x-code>
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $isAsync = true; // [tl! focus]

    // ...
}
</x-code>

<x-p>
    Switch form mode to Precognitive validation
</x-p>

<x-code>
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $isPrecognitive = true; // [tl! focus]

    // ...
}
</x-code>
</x-page>
