<x-page title="Textarea">

<x-p>
    Поле <em>Textarea</em> включает в себя все базовые методы.
</x-p>

<x-code language="php">
use MoonShine\Fields\Textarea; // [tl! focus]

//...

public function fields(): array
{
    return [
        Textarea::make('Text') // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
