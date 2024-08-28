<x-page
    title="Div Component"
>

<x-p>
    The <em>Div</em> component simply renders a div tag with the ability to specify nested components and add attributes.
</x-p>

<x-sub-title>Class</x-sub-title>

<x-code language="php">
    make(iterable $components)
</x-code>

<x-code language="php">
use MoonShine\Components\Layout\Div; // [tl! focus]

//...

public function components(): array
{
    return [
        Div::make([]) // [tl! focus:-3]
    ];
}

//...
</x-code>

<x-sub-title>Blade</x-sub-title>

<x-code language="blade" file="resources/views/examples/components/div.blade.php"></x-code>
</x-page>
