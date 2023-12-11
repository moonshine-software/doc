<x-page title="Color">

<x-extendby :href="route('moonshine.page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    The <em>Color</em> field is an extension of <em>Text</em>,
    which provides a convenient way to enter colors.
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



