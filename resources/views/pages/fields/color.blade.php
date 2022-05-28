<x-page title="Цвет">

<x-p>
    Все тоже самое как и "Текстовое поле", меняется только input type = color
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Color;

Color::make('Цвет', 'color')
</x-code>

<x-next href="{{ route('section', 'fields-url') }}">Url</x-next>

</x-page>



