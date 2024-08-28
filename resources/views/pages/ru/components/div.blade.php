<x-page
    title="Компонент Div"
>

<x-p>
    Компонент <em>Div</em> просто выводит тег div c возможностью указывать вложенные компоненты и добавлять атрибуты.
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
