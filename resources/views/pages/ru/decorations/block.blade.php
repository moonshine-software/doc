<x-page title="Block">

<x-p>
    Подложка с заголовком для элементов формы
</x-p>

<x-code language="php">
use MoonShine\Decorations\Block;

//...
public function fields(): array
{
    return [
        Block::make('Block title', [
            Text::make('Имя', 'first_name'),
        ]),
    ];
}
//...
</x-code>

<x-p>
    Если не нужен заголовок
</x-p>

<x-code language="php">
use MoonShine\Decorations\Block;

//...
public function fields(): array
{
    return [
        Block::make([
            Text::make('Имя', 'first_name'),
        ]),
    ];
}
//...
</x-code>
</x-page>
