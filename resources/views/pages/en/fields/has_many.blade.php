<x-page
    title="HasMany"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#fields', 'label' => 'Fields'],
            ['url' => '#creatable', 'label' => 'Creating a Relationship Object'],
            ['url' => '#limit', 'label' => 'Number of records'],
            ['url' => '#only-link', 'label' => 'Link only'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

@include('pages.en.fields.shared.relation_make', ['field' => 'HasMany', 'label' => 'Comments'])

<x-sub-title id="fields">Fields</x-sub-title>

<x-p>
    The <code>fields()</code> method allows you to set the fields that will be displayed in the <em>preview</em>.
</x-p>

<x-code language="php">
fields(Fields|Closure|array $fields)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->fields([
                BelongsTo::make('User'),
                Text::make('Text'),
            ]) // [tl! focus:-3]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/has_many_fields.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_many_fields_dark.png') }}"></x-image>

<x-sub-title id="creatable">Creating a Relationship Object</x-sub-title>

@include('pages.en.fields.shared.relation_creatable', ['field' => 'HasMany', 'label' => 'Comments'])

<x-sub-title id="limit">Number of records</x-sub-title>

<x-p>
    The <code>limit()</code> method allows you to limit the number of records displayed in <em>preview</em>.
</x-p>

<x-code language="php">
limit(int $limit)
</x-code>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->limit(1) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="only-link">Link only</x-sub-title>

<x-p>
    The <code>onlyLink()</code> method will allow you to display the relationship as a link with the number of elements.
</x-p>

<x-code language="php">
onlyLink(?string $linkRelation = null, Closure|bool|null $condition = null)
</x-code>

<x-p>
    You can pass optional parameters to the method:
    <x-ul>
        <li><code>linkRelation</code> - relation reference;</li>
        <li>
            <code>condition</code> - closure or boolean value,
            responsible for displaying the relationship as a link.
        </li>
    </x-ul>
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/has_many_link.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/has_many_link_dark.png') }}"></x-image>

<x-moonshine::divider label="linkRelation"></x-moonshine::divider>

<x-p>
    To retrieve relation values for a parent resource,
    You must set the <code>$parentRelations</code> property in the relationship resource.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class CommentResource extends ModelResource
{
    //...

    protected array $parentRelations = ['user'];

    //...
}
</x-code>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    The route will be available:<br />
    <em>/resource/comment-resource/index-page/user-{id}</em>
</x-moonshine::alert>

<x-p>
    The <code>linkRelation</code> parameter allows you to create a link to a relation with a parent resource binding.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink('user') // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::divider label="condition"></x-moonshine::divider>

<x-p>
    The <code>condition</code> parameter via a closure will allow you to change the display method depending on the conditions.
</x-p>

<x-code language="php">
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink(condition: function (int $count, Field $field): bool {
                return $count > 10;
            }) // [tl! focus:-2]
    ];
}

//...
</x-code>

</x-page>
