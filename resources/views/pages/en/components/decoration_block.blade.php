<x-page
    title="Decorator Block"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#wihtout-heading', 'label' => 'No title'],
            ['url' => '#icon', 'label' => 'Icon'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Block</em> decorator allows you to create stylized blocks.
</x-p>

<x-p>
    You can create a <em>Block</em> using the static <code>make()</code> method.
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


<x-sub-title id="wihtout-heading">No title</x-sub-title>

<x-p>
    If the block does not need title, then the <code>make()</code> method only has to pass an array.
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

<x-sub-title id="icon">Icon</x-sub-title>

@include('pages.en.components.shared.decoration_icon', ['decoration' => 'Block'])

</x-page>
