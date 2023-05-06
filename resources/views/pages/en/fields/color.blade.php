<x-page title="Colour">

<x-extendby :href="route('moonshine.custom_page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Everything is the same as "Text Box", the only difference is input type = color
</x-p>

<x-code language="php">
use MoonShine\Fields\Color;

Color::make('Colour', 'color')
</x-code>

<x-image theme="light" src="{{ asset('screenshots/color.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/color_dark.png') }}"></x-image>

</x-page>



