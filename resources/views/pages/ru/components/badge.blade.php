<x-page
    title="Компонент Badge"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#color', 'label' => 'Цвета'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Компонент <em>Badge</em> позволяет создавать значки.
</x-p>

<x-p>
    Создать <em>Badge</em> можно воспользовавшись статическим методом <code>make()</code>
    класса <code>Badge</code>.
</x-p>

<x-code language="php">
make(string $value = '', string $color = 'purple')
</x-code>

<x-ul>
    <li><code>$value</code> - текст значка,</li>
    <li><code>$color</code> - цвет значка.</li>
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

<x-sub-title id="color">Цвета</x-sub-title>

@include("pages.ru.ui.shared.colors")

</x-page>
