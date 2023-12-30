<x-page title="Hidden">

<x-extendby :href="route('moonshine.page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    The <em>Hidden</em> field will be set by default to <code>type="hidden"</code>.<br />
    The field will be hidden when building forms, but displayed in preview, and its wrapper will also be hidden.
</x-p>

<x-code language="php">
use MoonShine\Fields\Hidden; // [tl! focus]

//...

public function fields(): array
{
    return [
        Hidden::make('category_id')  // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
