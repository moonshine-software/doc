<x-page
    title="Декоратор Заголовок"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
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

</x-page>
