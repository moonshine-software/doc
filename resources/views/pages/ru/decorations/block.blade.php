<x-page title="Block">

<x-p>
    Иногда для удобства необходимо разделить форму на несколько блоков, по умолчанию они
    идут друг под другом, но с помощью
    декорации <code>Flex</code>, также возможно спозиционировать блоки в линию
</x-p>

<x-code language="php">
use Leeto\MoonShine\Decorations\Block;

//...
public function fields(): array
{
    return [
        Block::make('Блок 1', [
            Text::make('Имя', 'first_name'),
        ]),

        Block::make('Блок 2', [
            Text::make('Фамилия', 'last_name'),
        ]),
    ];
}
//...
</x-code>

<x-image src="{{ asset('screenshots/block-flex-1.png') }}"></x-image>
</x-page>
