<x-page title="Collapse">

<x-p>
    Декоратор Collapse позволяет сворачивать <code>fields</code> и <code>blocks</code> с сохранением состояния
</x-p>

<x-code language="php">
use Leeto\MoonShine\Decorations\Collapse;  // [tl! focus]
use Leeto\MoonShine\Decorations\Block;

//...
public function fields(): array
{
    return [
        Block::make('Block title', [
            Collapse::make('СЕО', [  // [tl! focus]
                Text::make('Seo title')
                ->fieldContainer(false),

                Text::make('Seo description')
                    ->fieldContainer(false),

                TinyMce::make('Description')
                    ->fullWidth(),
            ])  // [tl! focus]
            ->show() // отобразить развернутым (дополнительная опция) [tl! focus]
        ]);
    ];
}
//...
</x-code>

<x-image src="{{ asset('screenshots/collapse.png') }}"></x-image>
</x-page>
