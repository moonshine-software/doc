<x-page
    title="Card Component"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#header', 'label' => 'Header'],
            ['url' => '#actions', 'label' => 'Buttons'],
            ['url' => '#subtitle', 'label' => 'Subtitle'],
            ['url' => '#url', 'label' => 'Link'],
            ['url' => '#thumbnail', 'label' => 'Thumbnail'],
            ['url' => '#thumbnails', 'label' => 'Thumbnails'],
            ['url' => '#values', 'label' => 'List of values'],
            ['url' => '#overlay', 'label' => 'Overlay mode'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Card</em> component allows you to create element cards.
</x-p>

<x-p>
    You can create a <em>Card</em> using the static method <code>make()</code>
    class <code>Card</code>.
</x-p>

<x-code language="php">
make(
    Closure|string $title = '',
    Closure|string $thumbnail = '',
    Closure|string|array $thumbnails = '',
    Closure|string $url = '#',
    Closure|array $values = [],
    Closure|string|null $subtitle = null
)
</x-code>

<x-ul>
    <li><code>$title</code> - card title,</li>
    <li><code>$thumbnail</code> - image,</li>
    <li><code>$thumbnails</code> - images,</li>
    <li><code>$url</code> - link,</li>
    <li><code>$values</code> - list of values</li>
    <li><code>$subtitle</code> - subtitle.</li>
</x-ul>

<x-code language="php">
use MoonShine\Components\Card; // [tl! focus]

//...

public function components(): array
{
    return [
        Card::make(
            title: fake()->sentence(3),
            thumbnail: '/images/image_1.jpg',
            url: fn() => 'https://cutcode.dev',
            values: ['ID' => 1, 'Author' => fake()->name()],
            subtitle: date('d.m.Y')
        ) // [tl! focus:-6]
    ];
}

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
{!!
    \MoonShine\Components\Card::make(
        title: fake()->sentence(3),
        thumbnail: '/images/image_1.jpg',
        url: fn() => 'https://cutcode.dev',
        values: ['ID' => 1, 'Author' => fake()->name()],
        subtitle: date('d.m.Y')
    )
!!}
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="header">Header</x-sub-title>

<x-p>
    The <code>header()</code> method allows you to set the header for cards.
</x-p>

<x-code language="php">
header(Closure|string $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>column</em> or closure returning <em>html</em> code.</li>
</x-ul>

<x-code language="php">
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_2.jpg',
)
    ->header(static fn() => Badge::make('new', 'success')) // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
{!!
    \MoonShine\Components\Card::make(
        title: fake()->sentence(3),
        thumbnail: '/images/image_2.jpg',
    )
        ->header(static fn() => \MoonShine\Components\Badge::make('new', 'success'))
!!}
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="actions">Buttons</x-sub-title>

<x-p>
    To add buttons to a card, you can use the <code>actions()</code> method.
</x-p>

<x-code language="php">
actions(Closure|string $value)
</x-code>

<x-code language="php">
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_1.jpg',
)
    ->actions(
        static fn() => ActionButton::make('Edit', route('name.edit'))
    ) // [tl! focus:-4]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
{!!
    \MoonShine\Components\Card::make(
        title: fake()->sentence(3),
        thumbnail: '/images/image_1.jpg',
    )
        ->actions(
            static fn() => \MoonShine\ActionButtons\ActionButton::make('Edit', route('async'))
        )
!!}
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="subtitle">Subtitle</x-sub-title>

<x-code language="php">
subtitle(Closure|string $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>column</em> or a closure that returns a subtitle.</li>
</x-ul>

<x-code language="php">
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_2.jpg',
)
    ->subtitle(static fn() => 'Subtitle') // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
{!!
    \MoonShine\Components\Card::make(
        title: fake()->sentence(3),
        thumbnail: '/images/image_2.jpg',
    )
        ->subtitle(static fn() => 'Subtitle')
!!}
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="url">Link</x-sub-title>

<x-p>
    The <code>url()</code> method allows you to set a link for the card title.
</x-p>

<x-code language="php">
url(Closure|string $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>url</em> or closure.</li>
</x-ul>

<x-code language="php">
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_1.jpg',
)
    ->url(static fn() => 'https://cutcode.dev') // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
{!!
    \MoonShine\Components\Card::make(
        title: fake()->sentence(3),
        thumbnail: '/images/image_1.jpg',
    )
        ->url(static fn() => 'https://cutcode.dev')
!!}
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="thumbnail">Thumbnail</x-sub-title>

<x-p>
    To add an image to a card, you can use the <code>thumbnail()</code> method.
</x-p>

<x-code language="php">
thumbnail(Closure|string $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>url</em> of the image or closure.</li>
</x-ul>

<x-code language="php">
Cards::make(
    title: fake()->sentence(3),
)
    ->thumbnail('/images/image_2.jpg') // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
{!!
    \MoonShine\Components\Card::make(
        title: fake()->sentence(3),
    )
        ->thumbnail('/images/image_2.jpg')
!!}
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="thumbnail">Thumbnails</x-sub-title>

<x-p>
    To add an images carousel to a card, you can use the <code>thumbnails()</code> method.
</x-p>

<x-code language="php">
    thumbnails(Closure|string|array $value)
</x-code>

<x-ul>
    <li><code>$value</code> - <em>url</em> of the image or array <em>urls</em> of image or closure.</li>
</x-ul>

<x-code language="php">
Cards::make(
    title: fake()->sentence(3),
)
->thumbnail(['/images/image_2.jpg','/images/image_1.jpg']) // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        {!!
            \MoonShine\Components\Card::make(
                title: fake()->sentence(3),
            )
                ->thumbnails(['/images/image_2.jpg','/images/image_1.jpg'])
        !!}
    </x-moonshine::column>
</x-moonshine::grid>

<x-sub-title id="values">List of values</x-sub-title>

<x-p>
    To add a list of values to a card, you can use the <code>values()</code> method.
</x-p>

<x-code language="php">
    values(Closure|array $value)
</x-code>

<x-ul>
    <li><code>$value</code> - associative array of values or closure.</li>
</x-ul>

<x-code language="php">
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_1.jpg',
)
    ->values([
        'ID' => 1,
        'Author' => fake()->name()
    ]) // [tl! focus:-3]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
{!!
    \MoonShine\Components\Card::make(
        title: fake()->sentence(3),
        thumbnail: '/images/image_1.jpg',
    )
        ->values([
            'ID' => 1,
            'Author' => fake()->name()
        ])
!!}
    </x-moonshine::column>
</x-moonshine::grid>


<x-sub-title id="overlay">Overlay mode</x-sub-title>

<x-p>
    The <em>overlay</em> mode allows you to place the header and headings on top of the card image.<br/>
    This mode is activated by the <code>overlay()</code> method of the same name.
</x-p>

<x-code language="php">
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_2.jpg',
    url: fn() => 'https://cutcode.dev',
    values: ['ID' => 1, 'Author' => fake()->name()],
    subtitle: date('d.m.Y')
)
    ->header(static fn() => Badge::make('new', 'success'))
    ->overlay() // [tl! focus]
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
{!!
    \MoonShine\Components\Card::make(
        title: fake()->sentence(3),
        thumbnail: '/images/image_2.jpg',
        url: fn() => 'https://cutcode.dev',
        values: ['ID' => 1, 'Author' => fake()->name()],
        subtitle: date('d.m.Y')
    )
        ->header(static fn() => \MoonShine\Components\Badge::make('new', 'success'))
        ->overlay()
!!}
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
