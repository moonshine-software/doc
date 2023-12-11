<x-page title="Url">

<x-extendby :href="route('moonshine.page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    The <em>Url</em> field is an extension of <em>Text</em>,
    which by default sets <code>type=url</code>.
</x-p>

<x-code language="php">
use MoonShine\Fields\Url; // [tl! focus]

//...

public function fields(): array
{
    return [
        Url::make('Link') // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
