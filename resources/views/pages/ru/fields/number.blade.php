<x-page
    title="Число"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#attributes', 'label' => 'Аттрибуты'],
            ['url' => '#stars', 'label' => 'Stars'],
        ]
    ]"
>

<x-extendby :href="route('moonshine.page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Поле <em>Number</em> является расширением <em>Text</em>,
    которое по умолчанию устанавливает <code>type=number</code> и имеет дополнительные методы.
</x-p>

<x-code language="php">
use MoonShine\Fields\Number; // [tl! focus]

//...

public function fields(): array
{
    return [
        Number::make('Sort') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="attributes">Аттрибуты</x-sub-title>

<x-p>
    Поле <em>Number</em> имеет дополнительные аттрибуты (кроме стандартных аттрибутов поля <em>Text</em>),
    которые можно задать через соответствующие методы.
</x-p>

<x-p>
    Методы <code>min()</code> и <code>max()</code>
    используются для задания минимального и максимального значения у поля.
</x-p>

<x-code language="php">
min(int|float $min)
</x-code>

<x-code language="php">
max(int|float $min)
</x-code>

<x-p>
    Метод <code>step()</code> используются для задания шага значений у поля.
</x-p>

<x-code language="php">
step(int|float $step)
</x-code>

<x-code language="php">
use MoonShine\Fields\Number;

//...
public function fields(): array
{
    return [
        Number::make('Price')
            ->min(0) // [tl! focus]
            ->max(100000) // [tl! focus]
            ->step(5) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="stars">Stars</x-sub-title>

<x-p>
    Метод <code>stars()</code> используется для отображения числового значения
    при preview в виде звезд (например для рейтинга).
</x-p>

<x-code language="php">
stars()
</x-code>

<x-code language="php">
use MoonShine\Fields\Number;

//...

public function fields(): array
{
    return [
        Number::make('Rating')
            ->stars() // [tl! focus]
            ->min(1)
            ->max(5)
    ];
}

//...
</x-code>

</x-page>
