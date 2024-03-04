<x-page
    title="Декоратор Заголовок"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#gradation', 'label' => 'Заголовок'],
            ['url' => '#custom-tag', 'label' => 'Тэг'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Декоратор <em>Heading</em> позволяет добавлять заголовки для контента.
</x-p>

<x-p>
    Создать <em>Heading</em> можно воспользовавшись статическим методом <code>make()</code>,
    которому необходимо передать текст заголовка.
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

<x-sub-title id="gradation">Заголовок</x-sub-title>

<x-code language="php">
    h(int $gradation = 3, $asClass = true)
</x-code>

<x-p>
    Метод позволяет обернуть контент в тег <em>h1&nbsp;&mdash;&nbsp;h6</em>.<br>
    Первый параметр определяем градацию тега, второй определяет, использовать тег или класс.
</x-p>

<x-code language="php">
    use MoonShine\Decorations\Heading; // [tl! focus]
    use MoonShine\Fields\Text;

    //...

    public function components(): array
    {
        return [
            // Будут теги h1 - h4 [tl! focus]
            Heading::make('Dashboard')->h(1, false), // [tl! focus]
            Heading::make('MoonShine')->h(2, false), // [tl! focus]
            Heading::make('Demo version')->h(asClass: false), // [tl! focus]
            Heading::make('Heading')->h(4, false), // [tl! focus]

            // Будут div.h1 - div.h4 [tl! focus]
            Heading::make('Dashboard')->h(1), // [tl! focus]
            Heading::make('MoonShine')->h(2), // [tl! focus]
            Heading::make('Demo version')->h(), // h3 [tl! focus]
            Heading::make('Heading')->h(4), // [tl! focus]
        ];
    }

    //...
</x-code>

<x-sub-title id="custom-tag">Тэг</x-sub-title>

<x-code language="php">
    tag(string $tag)
</x-code>

<x-p>
    Метод позволяет обернуть контент в указанный тег.
</x-p>

<x-code language="php">
    use MoonShine\Decorations\Heading; // [tl! focus]
    use MoonShine\Fields\Text;

    //...

    public function components(): array
    {
        return [
            // Будут p.h1 - p.h4 [tl! focus]
            Heading::make('Dashboard')->tag('p')->h(1), // [tl! focus]
            Heading::make('MoonShine')->tag('p')->h(2), // [tl! focus]
            Heading::make('Demo version')->tag('p')->h(), // [tl! focus]
            Heading::make('Heading')->tag('p')->h(4), // [tl! focus]
        ];
    }

    //...
</x-code>

</x-page>
