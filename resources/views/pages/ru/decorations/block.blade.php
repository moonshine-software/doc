<x-page title="Block">

<x-p>
    Подложка с заголовком для элементов формы
</x-p>

<x-code language="php">
use MoonShine\Decorations\Block; // [tl! focus]

//...
public function fields(): array
{
    return [
        Block::make('Block title', [ // [tl! focus]
            Text::make('Имя', 'first_name'),
        ]), // [tl! focus]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/block.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/block_dark.png') }}"></x-image>

<x-p>
    Если не нужен заголовок
</x-p>

<x-code language="php">
use MoonShine\Decorations\Block; // [tl! focus]

//...
public function fields(): array
{
    return [
        Block::make([ // [tl! focus]
            Text::make('Имя', 'first_name'),
        ]), // [tl! focus]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/block_without_title.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/block_without_title_dark.png') }}"></x-image>

</x-page>
