<x-page title="ID">

<x-extendby :href="to_page('fields-hidden')">
    Hidden
</x-extendby>

<x-p>
Поле <em>ID</em> используется для primary key.<br />
Оно так же как и поле <em>Hidden</em> отображается только в preview и не отображается в формах.
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
