<x-page title="Extensions" :sectionMenu="[
    'Sections' => [
        ['url' => '#custom-field', 'label' => 'Custom field'],
        ['url' => '#custom-action', 'label' => 'Custom action'],
        ['url' => '#vendors', 'label' => 'Packages'],
    ]
]">

<x-p>
    MoonShine provides opportunities to extend the basic functionality and write your own packages that improve the features. In this section, we will provide a list of such packages, an example with creating your own field and action.
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

<x-sub-title id="custom-action">Custom Action</x-sub-title>

<x-p>
    MoonShine comes with several built-in actions such as
    <x-link :link="route('moonshine.custom_page', 'actions-export')">Export</x-link> и
    <x-link :link="route('moonshine.custom_page', 'actions-import')">Import</x-link>
    but you can also create your own custom actions.
</x-p>

<x-p>
    To do this, you need to create a class that extends the MoonShine action class and define the handle method.
</x-p>

<x-code language="php">
namespace App\MoonShine\Actions;

use MoonShine\Actions\Action;

class CustomAction extends Action
{
    public function handle(): mixed
    {
        // Code with the handler logic
    }
}
</x-code>

<x-p>
    This is enough to display our custom action on the resource page.
    However, let's take a look at what else we can define in our action class.
</x-p>

<x-code language="php">
class CustomAction extends Action
{
    protected static string $view = 'view.custom'; // Custom blade mapping

    protected bool $withQuery = true; // Whether to pass the entire current getQuery to the action's URL.

    protected bool $inDropdown = false; // Display the button outside the dropdown menu.

    protected ?string $icon = 'heroicons.outline.table-cells'; // Icon for the button.
}
</x-code>

<x-p>
    Next, register the action in the actions method of the resource where you want to display it.
</x-p>

<x-code language="php">
public function actions(): array
{
    return [
        CustomAction::make('Custom Action'),
    ];
}
</x-code>

<x-p>
    That's it!
</x-p>

<x-sub-title id="vendors">Packages</x-sub-title>

<ul class="col-list my-4">
    <li>
        <x-link link="https://github.com/visual-ideas/laravel-site-settings" target="_blank">
            Settings Manager
        </x-link>
    </li>
    <li>
        <x-link link="https://github.com/lee-to/laravel-seo-by-url" target="_blank">
            Manager SEO
        </x-link>
    </li>
    <li>
        <x-link link="https://github.com/visual-ideas/moonshine-spatie-medialibrary" target="_blank">
            Moonshine Spatie Medialibrary
        </x-link>
    </li>
    <li>
        <x-link link="https://github.com/visual-ideas/moonshine-spatie-translatable" target="_blank">
            Moonshine Spatie Translatable
        </x-link>
    </li>
    <li>
        <x-link link="https://github.com/JekaSylar/MoonShine-Language-Ukrainian.git" target="_blank">
            Moonshine Language Ukrainian
        </x-link>
    </li>
    <li>
        <x-link link="https://github.com/lee-to/moonshine-input-extension-char-count" target="_blank">
            Char Count
        </x-link>
    </li>
</ul>

</x-page>
