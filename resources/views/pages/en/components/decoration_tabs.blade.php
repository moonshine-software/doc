<x-page
    title="Tabs"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#active-tab', 'label' => 'Active tab'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Tabs</em> component allows you to create tabs.
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

<x-sub-title id="active-tab">Active tab</x-sub-title>

<x-p>
    The method <code>active()</code> allows you to specify which tab should be active by default.
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
