<x-page
    title="Компонент Carousel"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#items', 'label' => 'Images'],
            ['url' => '#portrait', 'label' => 'Portrait orientation'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Carousel</em> component allows you to create image carousel.
</x-p>

<x-p>
    You can create a <em>Carousel</em> using the static method <code>make()</code> class <code>Carousel</code>.
</x-p>

<x-code language="php">
make(
    Closure|string $alt = '',
    Closure|string|array $items = '',
    Closure|boolean $portrait = false
)
</x-code>

<x-ul>
    <li><code>$alt</code> - attribute holds a textual replacement for the image,</li>
    <li><code>$items</code> - images,</li>
    <li><code>$portrait</code> - portrait orientation</li>
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


<x-sub-title id="items">Images</x-sub-title>

<x-p>
    To add an images carousel to a card, you can use the <code>items()</code> method.
</x-p>

<x-code language="php">
    items(Closure|string|array $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>url</em> of the image or array <em>urls</em> of image or closure.</li>
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

<x-sub-title id="portrait">Portrait orientation</x-sub-title>

<x-p>
    To use a carousel with vertical images, add a parameter <code>portrait: true</code> to <code>make()</code> method.
</x-p>

<x-code language="php">
    bool portrait = false
</x-code>

<x-code language="php">
Carousel::make(
    alt: fake()->sentence(3),
    portrait: true // [tl! focus]
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
