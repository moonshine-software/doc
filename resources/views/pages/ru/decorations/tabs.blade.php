<x-page
    title="Вкладки"
    :videos="[
        ['url' => 'https://www.youtube.com/embed/7HGaebxlcFM?start=713&end=819', 'title' => 'Screencasts: Декорация Tabs'],
    ]"
>

<x-p>
    На форму для удобства можно добавить вкладки и сгруппировать поля
</x-p>

<x-code language="php">
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Tabs;
use MoonShine\Decorations\Tab;
use MoonShine\Fields\Text;

//...
public function fields(): array
{
    return [
        Block::make('Основное', [
            Tabs::make([
                Tab::make('Seo', [
                    Text::make('Seo title')
                        ->fieldContainer(false),
                    //...
                ]),
                Tab::make('Categories', [
                    //...
                ])
            ])
        ]),
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/tabs.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/tabs_dark.png') }}"></x-image>

</x-page>
