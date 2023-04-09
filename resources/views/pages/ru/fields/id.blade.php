<x-page title="ID">

<x-extendby :href="route('moonshine.custom_page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Присутствует почти всегда и будет скрыто по умолчанию на странице добавления/редактирования.
    Если primary key имеет наименование отличное от id, то свое наименование указываем первым
    аргументом у метода make
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
