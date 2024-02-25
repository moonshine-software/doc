<x-page
    title="Badge Component"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#color', 'label' => 'Colors'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Badge</em> component allows you to create badges.
</x-p>

<x-p>
    You can create a <em>Badge</em> using the static method <code>make()</code>
    class <code>Badge</code>.
</x-p>

<x-code language="php">
make(string $value = '', string $color = 'purple')
</x-code>

<x-ul>
    <li><code>$value</code> - icon text</li>
    <li><code>$color</code> - icon color.</li>
</x-ul>

<x-code language="php">
use MoonShine\Components\Badge; // [tl! focus]

//...

public function components(): array
{
    return [
        Badge::make(
            'new',
            'green'
        ) // [tl! focus:-3]
    ];
}

//...
</x-code>

<x-sub-title id="color">Colors</x-sub-title>

@include("pages.en.ui.shared.colors")

</x-page>
