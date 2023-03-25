<x-page title="Layout" :sectionMenu="[
    'Разделы' => [
        ['url' => '#flex', 'label' => 'Flex'],
        ['url' => '#grid-column', 'label' => 'Grid/Column'],
    ]
]">
<x-p>
    Иногда для удобства необходимо разделить форму на несколько блоков, по умолчанию они
    идут друг под другом, но с помощью
    декораций <code>Layout</code> можно легко менять отображение
</x-p>

<x-sub-title id="flex">Flex</x-sub-title>

<x-p>
    Изменение позиционирования полей в линию
</x-p>

<x-code language="php">
use Leeto\MoonShine\Decorations\Flex;

//...
public function fields(): array
{
    return [
        Flex::make([
            Text::make('Title'),
            Text::make('Slug'),
        ])
            // Дополнительные опции
            ->withoutSpace() // Исключить отступы
            ->justifyAlign('start') // На основе tailwind классов justify-[param]
            ->itemsAlign('start') // На основе tailwind классов items-[param]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/flex.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/flex_dark.png') }}"></x-image>

<x-sub-title id="grid-column">Grid/Column</x-sub-title>

<x-p>
    Сетка с колонками
</x-p>

<x-code language="php">
use Leeto\MoonShine\Decorations\Grid;
use Leeto\MoonShine\Decorations\Column;

//...
public function fields(): array
{
    return [
        Grid::make([
            Column::make([
                Block::make('Main information', [
                    // Fields here
                ])
            ])->columnSpan(6), // 6 из 12 - половина экрана

            Column::make([
                Block::make('Contact information', [
                    // Fields here
                ])
            ])->columnSpan(6), // 6 из 12 - половина экрана
        ])
    ];
}
//...
</x-code>

<x-p>
    Результат две колонки с блоками
</x-p>

<x-image theme="light" src="{{ asset('screenshots/grid.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/grid_dark.png') }}"></x-image>

</x-page>
