<x-page
    title="Декоратор Block"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#wihtout-heading', 'label' => 'Без заголовка'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Декоратор <em>Block</em> позволяет создавать стилизованные блоки.
</x-p>

<x-p>
    Создать <em>Block</em> можно воспользовавшись статическим методом <code>make()</code>.
</x-p>

<x-code language="php">
make(Closure|string|array $labelOrFields = '', array $fields = [])
</x-code>

<x-code language="php">
use MoonShine\Decorations\Block; // [tl! focus]
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Block::make('Block title', [ // [tl! focus]
            Text::make('Name', 'first_name')
        ]) // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/block.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/block_dark.png') }}"></x-image>


<x-sub-title id="wihtout-heading">Без заголовка</x-sub-title>

<x-p>
    Если у блока не нужен заголовок, то методу <code>make()</code> необходимо передать только массив.
</x-p>

<x-code language="php">
use MoonShine\Decorations\Block; // [tl! focus]
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Block::make([ // [tl! focus]
            Text::make('Name', 'first_name')
        ]) // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/block_without_title.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/block_without_title_dark.png') }}"></x-image>

</x-page>
