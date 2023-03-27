<x-page title="Цвет">

<x-p>
    Все тоже самое как и "Текстовое поле", меняется только input type = color
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Color;

Color::make('Цвет', 'color')
</x-code>

<x-image theme="light" src="{{ asset('screenshots/color.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/color_dark.png') }}"></x-image>

</x-page>



