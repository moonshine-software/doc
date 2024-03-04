<x-page
    title="Decorator Header"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#gradation', 'label' => 'Gradation'],
            ['url' => '#custom-tag', 'label' => 'Tag'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Heading</em> decorator allows you to add headings to the content.
</x-p>

<x-p>
    You can create a <em>Heading</em> by using the static method <code>make()</code>
    by passing the text heading to it.
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

<x-sub-title id="gradation">Gradation</x-sub-title>

<x-code language="php">
    h(int $gradation = 3, $asClass = true)
</x-code>

<x-p>
    The method allows you to wrap content in a tag <em>h1&nbsp;&mdash;&nbsp;h6</em>.<br>
    The first parameter determines the gradation of the tag, the second determines whether to use a tag or a class.
</x-p>

<x-code language="php">
    use MoonShine\Decorations\Heading; // [tl! focus]
    use MoonShine\Fields\Text;

    //...

    public function components(): array
    {
        return [
            // There will be tags h1 - h4 [tl! focus]
            Heading::make('Dashboard')->h(1, false), // [tl! focus]
            Heading::make('MoonShine')->h(2, false), // [tl! focus]
            Heading::make('Demo version')->h(asClass: false), // [tl! focus]
            Heading::make('Heading')->h(4, false), // [tl! focus]

            // There will be div.h1 - div.h4 [tl! focus]
            Heading::make('Dashboard')->h(1), // [tl! focus]
            Heading::make('MoonShine')->h(2), // [tl! focus]
            Heading::make('Demo version')->h(), // h3 [tl! focus]
            Heading::make('Heading')->h(4), // [tl! focus]
        ];
    }

    //...
</x-code>

<x-sub-title id="custom-tag">Tag</x-sub-title>

<x-code language="php">
    tag(string $tag)
</x-code>

<x-p>
    The method allows you to wrap content in a specified tag.
</x-p>

<x-code language="php">
    use MoonShine\Decorations\Heading; // [tl! focus]
    use MoonShine\Fields\Text;

    //...

    public function components(): array
    {
        return [
            // There will be p.h1 - p.h4 [tl! focus]
            Heading::make('Dashboard')->tag('p')->h(1), // [tl! focus]
            Heading::make('MoonShine')->tag('p')->h(2), // [tl! focus]
            Heading::make('Demo version')->tag('p')->h(), // [tl! focus]
            Heading::make('Heading')->tag('p')->h(4), // [tl! focus]
        ];
    }

    //...
</x-code>

</x-page>
