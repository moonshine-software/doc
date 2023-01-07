<x-page title="Flex">

<x-p>
    Изменение позиционирования блоков либо полей в линию
</x-p>

<x-code language="php">
use Leeto\MoonShine\Decorations\Flex;

//...
public function fields(): array
{
    return [
        Flex::make('Title/Slug', [
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


<x-p>
    Удобно также для блоков
</x-p>

<x-code language="php">
use Leeto\MoonShine\Decorations\Flex;
use Leeto\MoonShine\Decorations\Block;

//...
public function fields(): array
{
    return [
        Flex::make('Title/Slug', [
            Block::make('left', [
                Text::make('Title'),
            ]),
            Block::make('right', [
                Text::make('Slug'),
            ]),
        ])
    ];
}
//...
</x-code>

<x-image src="{{ asset('screenshots/block-flex-2.png') }}"></x-image>
</x-page>
