<x-page title="Extensions" :sectionMenu="[
    'Sections' => [
        ['url' => '#custom-field', 'label' => 'Custom field'],
        ['url' => '#vendors', 'label' => 'Packages'],
    ]
]">

<x-p>
    MoonShine provides opportunities to extend the basic functionality and write your own packages that improve the features. In this section we will give a list of such packages and an example with the creation of your own field
</x-p>


<x-p>
    If you're having trouble with how your MoonShine package should look, we've prepared a ready-made template for you.
    <x-moonshine::link href="https://github.com/moonshine-software/moonshine-package-template">
        Package template
    </x-moonshine::link>
</x-p>

<x-p>
    Entities created for expansion:
    <x-ul :items="['Fields', 'Filters', 'Decorations', 'Actions', 'Metrics', 'InputExtension', 'FormComponent', 'Resource']"></x-ul>
</x-p>

<x-sub-title id="custom-field">Custom field</x-sub-title>

<x-p>
    Consider a small example of creating your own field!
    Let's say it is a visual editor based on the js plugin CKEditor
</x-p>

<x-p>
    First, let's create a class that extends the MoonShine fields
</x-p>

<x-code language="php">
namespace App\MoonShine\Fields;

use MoonShine\Fields\Field;

final class CKEditor extends Field
{
    protected static string $view = 'fields.ckeditor';

    protected array $assets = [
        'https://cdn.ckeditor.com/ckeditor5/35.3.0/super-build/ckeditor.js'
    ];
}

</x-code>

<x-p>
    And create a view with implementation
</x-p>

<x-code language="blade" file="examples/extensions/ckeditor.blade.php"></x-code>

<x-p>
    That's it!
</x-p>

<x-sub-title id="vendors">Packages</x-sub-title>

<ul class="list-disc my-4">
    <li class="my-2">
        <x-link link="https://github.com/visual-ideas/laravel-site-settings">Settings Manager</x-link>
    </li>
    <li class="my-2">
        <x-link link="https://github.com/lee-to/laravel-seo-by-url">Manager SEO</x-link>
    </li>
</ul>

</x-page>
