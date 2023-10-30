<x-page
    title="Вкладки"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#active-tab', 'label' => 'Активная вкладка'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Компонент <em>Tabs</em> позволяет создавать вкладки.
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
