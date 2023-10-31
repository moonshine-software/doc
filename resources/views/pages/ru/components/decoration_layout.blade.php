<x-page
    title="Декорации Layout"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#flex', 'label' => 'Flex'],
            ['url' => '#grid-column', 'label' => 'Grid/Column'],
        ]
    ]"
>

<x-p>
    Иногда, для удобства восприятия, необходимо разделить форму на несколько блоков. По умолчанию они
    идут друг под другом, но с помощью декораций <code>Layout</code> можно легко изменить порядок отображения.
</x-p>

<x-sub-title id="flex">Flex</x-sub-title>

<x-p>
    Декорация <em>Flex</em> задает элементам соответствующее позиционирование.
</x-p>

<x-code language="php">
use MoonShine\Decorations\Flex; // [tl! focus]

//...

public function components(): array
{
    return [
        Flex::make([ // [tl! focus]
            Text::make('Title'),
            Text::make('Slug'),
        ]) // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/flex.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/flex_dark.png') }}"></x-image>

<x-moonshine::divider label="Дополнительные опции" />

<x-code language="php">
use MoonShine\Decorations\Flex;

//...

public function components(): array
{
    return [
        Flex::make([
            Text::make('Title'),
            Text::make('Slug'),
        ])
            ->withoutSpace() // Исключить отступы [tl! focus]
            ->justifyAlign('start') // На основе tailwind классов justify-[param] [tl! focus]
            ->itemsAlign('start') // На основе tailwind классов items-[param] [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::table
    :simple="true"
    :columns="['param', 'justifyAlign()', 'itemsAlign()']"
    :values="[
        ['normal', 'justify-content: normal;', null],
        ['start', 'justify-content: flex-start;', 'align-items: flex-start;'],
        ['end', 'justify-content: flex-end;', 'align-items: flex-end;'],
        ['center', 'justify-content: center;', 'align-items: center;'],
        ['between', 'justify-content: space-between;', null],
        ['around', 'justify-content: space-around;', null],
        ['evenly', 'justify-content: space-evenly;', null],
        ['baseline', null, 'align-items: baseline;'],
        ['stretch', 'justify-content: stretch;', 'align-items: stretch;'],
    ]"
/>

<x-sub-title id="grid-column">Grid/Column</x-sub-title>

<x-p>
    Организовать сетку с колонками позволяют декораторы <em>Grid</em> и <em>Column</em>.
</x-p>

<x-p>
    Метод <code>columnSpan()</code> позволяет задать ширину блока в <em>Grid</em> сетке.
</x-p>

<x-code language="php">
columnSpan(
    int $columnSpan,
    int $adaptiveColumnSpan = 12
)
</x-code>

<x-p>
    <code>$columnSpan</code> - значение для десктопной версии,<br>
    <code>$adaptiveColumnSpan</code> - значение для мобильной версии.
</x-p>

<x-code language="php">
use MoonShine\Decorations\Grid; // [tl! focus]
use MoonShine\Decorations\Column; // [tl! focus]

//...
public function components(): array
{
    return [
        Grid::make([ // [tl! focus:1]
            Column::make([
                // ...
            ])
                ->columnSpan(6), // [tl! focus:-1]

            Column::make([ // [tl! focus]
                // ...
            ])
                ->columnSpan(6) // [tl! focus:-1]
        ])
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    В админ-панели <strong>MoonShine</strong> используется 12 колоночная сетка.
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/grid.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/grid_dark.png') }}"></x-image>

</x-page>
