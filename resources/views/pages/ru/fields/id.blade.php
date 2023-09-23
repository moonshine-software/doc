<x-page title="ID">

<x-extendby :href="route('moonshine.custom_page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Поле отображается почти всегда и будет скрыт по умолчанию на странице добавления/редактирования.
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
    Если primary key имеет наименование, отличное от id, то необходимо указать аргументы у метода <code>make()</code>.
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
