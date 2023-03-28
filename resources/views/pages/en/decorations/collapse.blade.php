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
        Block::make('Block title', [
            Collapse::make('SEO', [  // [tl! focus]
                Text::make('Seo title')
                ->fieldContainer(false),

                Text::make('Seo description')
                    ->fieldContainer(false),

                TinyMce::make('Description')
                    ->fullWidth(),
            ])  // [tl! focus]
            ->show() // Display expanded (optional) [tl! focus]
        ]);
    ];
}
//...
</x-code>

<x-image src="{{ asset('screenshots/collapse.png') }}"></x-image>
</x-page>
