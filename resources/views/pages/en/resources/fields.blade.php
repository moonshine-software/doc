<x-page title="Fields" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Fields in most cases refer to table fields from the database. Within CRUD they will be displayed
    with a list on the main page of the section (resource) and on the page for creating and editing records.
    There are many types of fields in the MoonShine admin panel to cover all possible requirements!
    They also cover all possible relationships in Laravel and are named in the same way as relationship methods for convenience:
    <code>BelongsTo</code>, <code>BelongsToMany</code>, <code>HasOne</code>, <code>HasMany</code>,
    <code>HasOneThrough</code>, <code>HasManyThrough</code>, <code>MorphOne</code>, <code>MorphMany</code>
</x-p>

<x-p>
    Adding new fields is extremely easy! You can simply return all the required fields in the <code>fields</code> method which returns an array.
    And we will talk about fields structure in the <x-link link="{{ route('moonshine.custom_page', 'fields-index') }}">"Fields"</x-link> section.
</x-p>

<x-code language="php">
namespace MoonShine\Resources;

use MoonShine\Models\MoonshineUser;
use MoonShine\Fields\ID; // [tl! focus]
use MoonShine\Fields\Text; // [tl! focus]
use MoonShine\Decorations\Block;

class PostResource extends Resource
{
    public static string $model = App\Models\Post::class;

    public static string $title = 'Articles';
    //...

    public function fields(): array // [tl! focus:start]
    {
        return [
            Block::make('Block title', [
                ID::make(),
                Text::make('header', 'title'),
            ])
        ];
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/form.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/form_dark.png') }}"></x-image>

</x-page>
