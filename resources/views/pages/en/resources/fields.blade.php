<x-page title="Fields" :sectionMenu="$sectionMenu ?? null">

<x-p>
    Fields in most cases refer to table fields from the database. Within CRUD will be displayed
     on the main page of the section (resource) with a list and on the page for creating and editing records.
     In the MoonShine admin panel, there are many types of fields that cover all possible requirements!
     They also cover all possible relationships in Laravel and are named the same as relationship methods for convenience.
    <code>BelongsTo</code>, <code>BelongsToMany</code>, <code>HasOne</code>, <code>HasMany</code>,
    <code>HasOneThrough</code>, <code>HasManyThrough</code>, <code>MorphOne</code>, <code>MorphMany</code>
</x-p>

<x-p>
    Adding new fields is extremely easy! Enough in the <code>fields</code> method which returns an array,
     return all the required fields, and how the fields are arranged, we will consider in the <x-link link="{{ route('moonshine.custom_page', 'fields-index') }}">"Fields"</x-link> section.
</x-p>

<x-code language="php">
namespace Leeto\MoonShine\Resources;

use Leeto\MoonShine\Models\MoonshineUser;
use Leeto\MoonShine\Fields\ID; // [tl! focus]
use Leeto\MoonShine\Fields\Text; // [tl! focus]
use Leeto\MoonShine\Decorations\Block;

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
