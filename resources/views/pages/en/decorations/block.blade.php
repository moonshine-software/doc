<x-page title="Block">

<x-p>
    Substrate with header for form features
</x-p>

<x-code language="php">
use MoonShine\Decorations\Block; // [tl! focus]

//...
public function fields(): array
{
    return [
        Block::make('Block title', [ // [tl! focus]
            Text::make('Name', 'first_name'),
        ]), // [tl! focus]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/block.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/block_dark.png') }}"></x-image>

<x-p>
    If you don't need a header
</x-p>

<x-code language="php">
use MoonShine\Decorations\Block; // [tl! focus]

//...
public function fields(): array
{
    return [
        Block::make([ // [tl! focus]
            Text::make('Name', 'first_name'),
        ]), // [tl! focus]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/block_without_title.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/block_without_title_dark.png') }}"></x-image>

</x-page>
