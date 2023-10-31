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
use MoonShine\Decorations\Tabs; // [tl! focus]
use MoonShine\Decorations\Tab; // [tl! focus]
use MoonShine\Fields\Text;

//...

public function components(): array
{
    return [
        Tabs::make([ // [tl! focus:1]
            Tab::make('Seo', [
                Text::make('Seo title')

                //...
            ]), // [tl! focus:1]
            Tab::make('Categories', [
                //...
            ])
        ]) // [tl! focus:-1]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/tabs.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/tabs_dark.png') }}"></x-image>

<x-sub-title id="active-tab">Активная вкладка</x-sub-title>

<x-p>
    Метод <code>active()</code> позволяет указать какая вкладка должна быть активной по умолчанию.
</x-p>

<x-code language="php">
use MoonShine\Decorations\Tabs;
use MoonShine\Decorations\Tab;

//...

public function components(): array
{
    return [
        Tabs::make([
            Tab::make('Seo', [
                //...
            ]),
            Tab::make('Categories', [
                //...
            ])
                ->active() // [tl! focus]
        ])
    ];
}

//...
</x-code>

</x-page>
