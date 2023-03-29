<x-page title="Collapse">

<x-p>
    The Collapse decorator allows you to collapse <code>fields</code> and <code>blocks</code>, preserving their state
</x-p>

<x-code language="php">
use Leeto\MoonShine\Decorations\Collapse;  // [tl! focus]
use Leeto\MoonShine\Decorations\Block;

//...
public function fields(): array
{
    return [
        Block::make([
            Collapse::make('Title/Slug', [  // [tl! focus]
                Text::make('Title')
                    ->fieldContainer(false),

                Text::make('Slug')
                    ->fieldContainer(false),
            ])  // [tl! focus]
            ->show() // Display expanded (optional) [tl! focus]
        ]);
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/collapse.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/collapse_dark.png') }}"></x-image>

</x-page>
