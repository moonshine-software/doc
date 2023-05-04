<x-page title="Block">

<x-p>
    Substrate with header for form features
</x-p>

<x-code language="php">
use MoonShine\Decorations\Block;

//...
public function fields(): array
{
    return [
        Block::make('Block title', [
            Text::make('Name', 'first_name'),
        ]),
    ];
}
//...
</x-code>

<x-p>
    If you don't need a header
</x-p>

<x-code language="php">
use MoonShine\Decorations\Block;

//...
public function fields(): array
{
    return [
        Block::make([
            Text::make('Name', 'first_name'),
        ]),
    ];
}
//...
</x-code>
</x-page>
