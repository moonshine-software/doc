<x-page title="Filters" :sectionMenu="$sectionMenu ?? null">

<x-p>
    To create filters, fields are also used:
    they are displayed only on the section main page.
</x-p>

<x-p>
    To specify which fields to filter data by,
    enough in your model resource in the <code>filters()</code> method,
    return an array with the required fields.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    If the method is missing or returns an empty array, then the filters will not be displayed
</x-moonshine::alert>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Some fields cannot participate in constructing a filtering request,
    therefore they will be automatically excluded from the filter list
</x-moonshine::alert>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\Text; // [tl! focus]
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function filters(): array // [tl! focus:start]
    {
        return [
            Text::make('Title', 'title'),
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filters.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filters_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Fields are a key element in building forms in the <strong>Moonshine</strong> admin panel.<br />
    <x-link link="{{ to_page('fields-index') }}">More about Fields</x-link>
</x-moonshine::alert>

<x-p>
    If you need to cache the filters state, use the <code>saveFilterState</code> property in the resource
</x-p>
<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $saveFilterState = true; // [tl! focus]
//...
}
</x-code>
</x-page>
