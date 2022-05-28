<x-page title="Текстовое поле">

<x-p>
    Текстовое поле включает в себя все базовые методы
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Text; // [tl! focus]

//...

public function fields(): array
{
    return [
        Text::make('Заголовок', 'title')  // [tl! focus]
    ];
}

//...
</x-code>

<x-next href="{{ route('section', 'fields-select') }}">Селект</x-next>

</x-page>



