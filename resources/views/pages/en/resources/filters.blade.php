<x-page title="Filters" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Filters are not much different from fields and inherit their properties and methods!
     Displayed on the main page of the section to filter the list of data.
</x-p>

<x-p>
    Adding new filters is easy! Enough in the <code>filters</code> method, which returns an array,
     return all the necessary filters, and how filters are arranged, we will consider in the <x-link link="{{ route('moonshine.custom_page', 'filters-index') }}">"Filters"</x-link> section.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    If the method is absent or returns an empty array, then the filters will not be displayed
</x-moonshine::alert>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;
use Leeto\MoonShine\Filters\TextFilter; // [tl! focus]

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Articles';
    //...

    // [tl! focus:start]
    public function filters(): array
    {
        return [
            TextFilter::make('header', 'title')
        ];
    }

    // Don't forget to connect filters to the resource
    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }

    // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filters.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filters_dark.png') }}"></x-image>

</x-page>
