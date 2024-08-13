<x-page title="Validation" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#errors', 'label' => 'Displaying validation errors'],
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
<x-sub-title id="errors">Displaying validation errors</x-sub-title>
<x-p>
    The <code>$errorsAbove</code> resource parameter is responsible for displaying validation errors at the top of the form. The default value is <code>true</code>, which means that validation errors will be displayed.
</x-p>

<x-image theme="light" src="{{ asset('screenshots/errors_above_true.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/errors_above_true_dark.png') }}"></x-image>

<x-p>
    To hide validation errors at the top of the form, set the <code>$errorsAbove</code> resource parameter to <code>false</code>.
</x-p>
<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    //...
    protected bool $errorsAbove = false;// [tl! focus]
    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/errors_above_false.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/errors_above_false_dark.png') }}"></x-image>

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
