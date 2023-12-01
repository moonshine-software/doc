<x-page
    title="Декоратор FlexibleRender"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Декоратор <em>FlexibleRender</em> позволяет быстро рендерить простой текст, html или blade view.
</x-p>

<x-p>
    Создать <em>FlexibleRender</em> можно воспользовавшись статическим методом <code>make()</code>
    класса <code>FlexibleRender</code>.
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
