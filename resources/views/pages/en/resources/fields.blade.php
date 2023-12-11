<x-page
    title="Fields"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#default', 'label' => 'Default'],
            ['url' => '#separate', 'label' => 'Field separation'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Fields in most cases refer to table fields from the database. Within <strong>CRUD</strong> will be displayed
    on the main page of the section (resource) with a list and on the page for creating and editing records.
    There are many types of fields in the MoonShine admin panel that cover all possible requirements!
    Also covers all possible relationships in Laravel and for convenience are called the same as relationship methods
    <code>BelongsTo</code>, <code>BelongsToMany</code>, <code>HasOne</code>, <code>HasMany</code>,
    <code>HasOneThrough</code>, <code>HasManyThrough</code>, <code>MorphOne</code>, <code>MorphMany</code>.
</x-p>

<x-p>
    Adding fields to <em>ModelResource</em> is easy!
</x-p>

<x-sub-title id="default">Default</x-sub-title>

<x-p>
    In <em>ModelResource</em> by default it is necessary in the <code>fields()</code> method
    return an array with all <x-link link="{{ route('moonshine.page', 'fields-index') }}">Fields</x-link>.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\ID; // [tl! focus]
use MoonShine\Fields\Text; // [tl! focus]
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function fields(): array // [tl! focus:start]
    {
        return [
            ID::make(),
            Text::make('Title'),
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/form.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/form_dark.png') }}"></x-image>


<x-sub-title id="separate">Field separation</x-sub-title>

<x-p>
    Sometimes there is a need to exclude or change the order of some fields in an index or detail page.
    To do this, you can use methods that allow you to redefine fields for the corresponding pages:
    <code>indexFields()</code>, <code>formFields()</code> or <code>detailFields()</code>.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\ID; // [tl! focus]
use MoonShine\Fields\Text; // [tl! focus]
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function indexFields(): array // [tl! focus:start]
    {
        return [
            ID::make(),
            Text::make('Title'),
        ];
    } // [tl! focus:end]

    public function formFields(): array // [tl! focus:start]
    {
        return [
            ID::make(),
            Text::make('Title'),
            Text::make('Subtitle'),
        ];
    } // [tl! focus:end]

    public function detailFields(): array // [tl! focus:start]
    {
        return [
            Text::make('Title', 'title'),
            Text::make('Subtitle'),
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

</x-page>
