<x-page title="ID">

<x-extendby :href="route('moonshine.custom_page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    It is almost always present and will be hidden by default on the add/edit page.
    If the primary key has a name other than id you have to specify its name as the first argument of the <code>make</code> method.
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

<x-code language="php">
use MoonShine\Fields\ID; // [tl! focus]

//...

public function fields(): array
{
    return [
        ID::make('primary_key')  // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
