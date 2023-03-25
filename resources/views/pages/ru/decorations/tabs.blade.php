<x-page title="Вкладки">
<x-p>
    На форму для удобства можно добавить вкладки и сгруппировать поля
</x-p>

<x-code language="php">
use Leeto\MoonShine\Decorations\Block;
use Leeto\MoonShine\Decorations\Tabs;
use Leeto\MoonShine\Decorations\Tab;
use Leeto\MoonShine\Fields\Text;

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
