<x-page title="Url">

<x-extendby :href="route('moonshine.custom_page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Поле <em>Url</em> является расширением <em>Text</em>,
    которое по умолчанию устанавливает <code>type=url</code>.
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
