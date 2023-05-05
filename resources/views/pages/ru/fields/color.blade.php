<x-page
    title="Цвет"
    :videos="[
        ['url' => 'https://www.youtube.com/embed/7HGaebxlcFM?start=1375&end=1425', 'title' => 'Screencasts: Поле Color'],
    ]"
>

<x-extendby :href="route('moonshine.custom_page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Все тоже самое как и "Текстовое поле", меняется только input type = color
</x-p>

<x-code language="php">
use MoonShine\Fields\Color;

//...
public function fields(): array
{
    return [
        Color::make('Цвет', 'color')
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/color.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/color_dark.png') }}"></x-image>

</x-page>



