<x-page title="Block">

<x-p>
    Header substrate for form elements
</x-p>

<x-code language="php">
use Leeto\MoonShine\Decorations\Block;

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
    If you don't need a headline
</x-p>

<x-code language="php">
use Leeto\MoonShine\Decorations\Block;

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
