<x-page title="Цвет">

<x-extendby :href="route('moonshine.custom_page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Поле <em>Color</em> является расширением <em>Text</em>,
    которое предоставляет удобный способ для ввода цвета.
</x-p>

<x-code language="php">
use MoonShine\Fields\Color; // [tl! focus]

//...

public function fields(): array
{
    return [
        Color::make('Color') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/color.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/color_dark.png') }}"></x-image>

</x-page>



