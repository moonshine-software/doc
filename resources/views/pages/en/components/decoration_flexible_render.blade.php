<x-page
    title="Decorator FlexibleRender"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>FlexibleRender</em> decorator allows you to quickly render simple text, html or blade views.
</x-p>

<x-p>
    You can create <em>FlexibleRender</em> using the static <code>make()</code> method
    class <code>FlexibleRender</code>.
</x-p>

<x-code language="php">
make(Closure|View|string $content, Closure|array $additionalData = [])
</x-code>

<x-code language="php">
use MoonShine\Decorations\FlexibleRender; // [tl! focus]

//...

public function components(): array
{
    return [
        FlexibleRender::make('HTML'), // [tl! focus]
        // or
        FlexibleRender::make(view('path_to_blade')), // [tl! focus]
        // or
        FlexibleRender::make(view('path_to_blade', ['data' => 'something'])), // [tl! focus]
        // or
        FlexibleRender::make(view('path_to_blade'), ['data' => 'something']), // [tl! focus]
        FlexibleRender::make(view('path_to_blade', ['var1' => 'something 1']), ['var2' => 'something 2']), // [tl! focus]
        //or
        FlexibleRender::make(fn($data) => view('path_to_blade', $data), fn() => ['data' => 'something']), // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
