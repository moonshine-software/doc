<x-page
    title="Decorator Header"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Heading</em> decorator allows you to add headings to your content.
</x-p>

<x-p>
    You can create a <em>Heading</em> using the static <code>make()</code> method,
    to which you need to pass the header text.
</x-p>

<x-code language="php">
use MoonShine\Decorations\Heading; // [tl! focus]
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Heading::make('Title/Slug'), // [tl! focus]
        Text::make('Title'),
        Text::make('Slug'),
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/heading.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/heading_dark.png') }}"></x-image>

</x-page>
