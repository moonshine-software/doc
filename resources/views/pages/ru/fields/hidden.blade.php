<x-page title="Hidden">

<x-extendby :href="route('moonshine.page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    У поля <em>Hidden</em> по умолчанию будет установлен <code>type="hidden"</code>.<br />
    Поле будет скрыто при построении форм, но отображается в preview, так же будет скрыт и его wrapper.
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
