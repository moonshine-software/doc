<x-page title="Actions" :sectionMenu="[
    'Sections' => [
        ['url' => '#basics', 'label' => 'Basics'],
        ['url' => '#view', 'label' => 'Display method']
    ]
]">

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Often the task arises to do something with the list of a section, and “Actions” are used for these purposes.
    At the moment, MoonShine has only one Action class, which is responsible for exporting data.
    But the actions are expanding and you can easily write your own.
</x-p>

<x-p>
    Adding new actions is easy, and everything is done in the same style. Enough in the <code>actions</code> method, which returns an array,
    return all necessary actions. We will look at more details about actions in the <x-link link="{{ to_page('actions-index') }}">"Actions"</x-link> section.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    If the method is missing or returns an empty array, then the actions will not be displayed
</x-moonshine::alert>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Models\MoonshineUser;
use MoonShine\Actions\ExportAction; // [tl! focus]

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Articles';
    //...

    public function actions(): array // [tl! focus:start]
    {
        return [
            ExportAction::make('Export')
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/export.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/export_dark.png') }}"></x-image>

@include('pages.en.resources.shared.actions_view', ['action' => 'ExportAction'])

</x-page>
