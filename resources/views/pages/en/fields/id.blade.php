<x-page title="ID">

<x-extendby :href="route('moonshine.page', 'fields-hidden')">
    Hidden
</x-extendby>

<x-p>
The <em>ID</em> field is used for the primary key.<br />
It, like the <em>Hidden</em> field, is displayed only in preview and is not displayed in forms.
</x-p>

<x-code language="php">
use MoonShine\Fields\ID; // [tl! focus]

//...

public function fields(): array
{
    return [
        ID::make()  // [tl! focus]
    ];
}

//...
</x-code>

<x-p>
    If the primary key has a name different from id, then you must specify the arguments to the <code>make()</code> method.
</x-p>

<x-code language="php">
use MoonShine\Fields\ID; // [tl! focus]

//...

public function fields(): array
{
    return [
        ID::make('ID', 'primary_key')  // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
