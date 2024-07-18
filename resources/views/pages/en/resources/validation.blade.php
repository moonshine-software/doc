<x-page title="Validation" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#messages', 'label' => 'Messages'],
        ['url' => '#prepare', 'label' => 'Preparing Input For Validation'],
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Validation is as simple as in the <code>FormRequests</code> classes provided by Laravel.
</x-p>

<x-p>
    You can simply add rules to the <code>rules()</code> method of the resource in the usual way.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
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
    Using the <code>validationMessages()</code> method, you can create your own validation error messages.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
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

<x-sub-title id="prepare">Preparing Input For Validation</x-sub-title>

<x-p>
    If you need to prepare or sanitize any data from the request before you apply your validation rules,
    you may use the <code>prepareForValidation()</code> method.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
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

</x-page>
