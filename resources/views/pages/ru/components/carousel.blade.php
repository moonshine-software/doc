<x-page
    title="Компонент Carousel"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#items', 'label' => 'Изображения'],
            ['url' => '#portrait', 'label' => 'Портретная ориентация'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Компонент <em>Carousel</em> позволяет создавать карусель изображений.
</x-p>

<x-p>
    Создать <em>Carousel</em> можно воспользовавшись статическим методом <code>make()</code>
    класса <code>Carousel</code>.
</x-p>

<x-code language="php">
make(
    Closure|string $alt = '',
    Closure|string|array $items = '',
    Closure|boolean $portrait = false
)
</x-code>

<x-ul>
    <li><code>$alt</code> - alt изображений,</li>
    <li><code>$items</code> - изображения,</li>
    <li><code>$portrait</code> - портретная ориентация</li>
</x-ul>

<x-code language="php">
use MoonShine\Components\Carousel; // [tl! focus]

//...

public function components(): array
{
    return [
        Carousel::make(
            alt: fake()->sentence(3),
            items: ['/images/image_2.jpg','/images/image_1.jpg'],
            portrait: false
        ) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        {!!
            \MoonShine\Components\Carousel::make(
                alt: fake()->sentence(3),
                items: ['/images/image_2.jpg','/images/image_1.jpg'],
                portrait: false
            )
        !!}
    </x-moonshine::column>
</x-moonshine::grid>


<x-sub-title id="items">Изображения</x-sub-title>

<x-p>
    Для добавления изображений можно воспользоваться методом <code>items()</code>.
</x-p>

<x-code language="php">
    items(Closure|string|array $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>url</em> изображения, или массив <em>url-ов</em>  изображений, или замыкание.</li>
</x-ul>

<x-code language="php">
Carousel::make(
    alt: fake()->sentence(3),
)
->items(['/images/image_2.jpg','/images/image_1.jpg']) // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        {!!
            \MoonShine\Components\Carousel::make(
                alt: fake()->sentence(3),
            )
            ->items(['/images/image_2.jpg','/images/image_1.jpg'])
        !!}
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="portrait">Портретная ориентация</x-sub-title>

<x-p>
    Для использования карусели с вертикальными изображениями добавить в метод <code>make()</code> параметр <code>portrait: true</code>.
</x-p>

<x-code language="php">
bool portrait = false
</x-code>

<x-code language="php">
Carousel::make(
    alt: fake()->sentence(3),
    portrait: true// [tl! focus]
)
->items(['/images/image_2.jpg','/images/image_1.jpg'])
</x-code>
<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        {!!
            \MoonShine\Components\Carousel::make(
                alt: fake()->sentence(3),
                items: ['/images/image_portrait_1.jpg','/images/image_portrait_2.jpg'],
                portrait: true
            )
        !!}
    </x-moonshine::column>
</x-moonshine::grid>
</x-page>
