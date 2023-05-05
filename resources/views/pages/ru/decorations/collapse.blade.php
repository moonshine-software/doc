<x-page
    title="Collapse"
    :videos="[
        ['url' => 'https://www.youtube.com/embed/7HGaebxlcFM?start=251&end=306', 'title' => 'Screencasts: Декорация Collapse'],
    ]"
>

<x-p>
    Декоратор Collapse позволяет сворачивать <code>fields</code> и <code>blocks</code> с сохранением состояния
</x-p>

<x-code language="php">
use MoonShine\Decorations\Collapse;  // [tl! focus]
use MoonShine\Decorations\Block;

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
            ->show() // отобразить развернутым (дополнительная опция) [tl! focus]
        ]);
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/collapse.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/collapse_dark.png') }}"></x-image>

</x-page>
