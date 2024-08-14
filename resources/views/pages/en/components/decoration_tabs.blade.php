<x-page
    title="Tabs"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#vertical-tab', 'label' => 'Vertical tabs'],
            ['url' => '#active-tab', 'label' => 'Active tab'],
            ['url' => '#tab-icon', 'label' => 'Icon'],
            ['url' => '#tab-id', 'label' => 'Tab ID'],
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

<x-sub-title id="vertical-tab">Vertical display of the tabs.</x-sub-title>

<x-p>
    The method <code>vertical()</code> allows you to display tabs in vertical mode.
</x-p>

<x-code language="php">
vertical(Closure|bool|null $condition = null)
</x-code>

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

        ])->vertical() // [tl! focus]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/tabs_vertical.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/tabs_vertical_dark.png') }}"></x-image>

<x-p>
    By default, the minimum width of a tabbed block at which the inline display changes is <code>480px</code>. You can change the minimum width value via the method <code>customAttributes()</code>:
</x-p>
<x-code language="php">
    Tabs::make([
        //...
    ])
    ->customAttributes([ // [tl! focus]
        'data-tabs-vertical-min-width' => 600// [tl! focus]
    ]) // [tl! focus]

</x-code>

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

<x-sub-title id="tab-icon">Icon</x-sub-title>

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
                ->icon('heroicons.outline.pencil') // [tl! focus]
        ])
    ];
}

//...
</x-code>

<x-sub-title id="tab-id">Tab ID</x-sub-title>

<x-p>
    The <code>uniqueId()</code> method allows you to set the tab ID.<br />
    This way you can implement your own logic for tabs using <strong>Alpine.js</strong>.
</x-p>

<x-code language="php">
uniqueId(string $id)
</x-code>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Decorations\Tabs;
use MoonShine\Decorations\Tab;

//...

public function components(): array
{
    return [
        Tabs::make([
            Tab::make('Tab 1', [
                //...

                ActionButton::make('Go to tab 2')->onClick(fn() => 'setActiveTab(`my-tab-2`)', 'prevent'),
            ])
                ->uniqueId('my-tab-1'), // [tl! focus]

            Tab::make('Tab 2', [
                //...

                ActionButton::make('Go to tab 1')->onClick(fn() => 'setActiveTab(`my-tab-1`)', 'prevent'),
            ])
                ->uniqueId('my-tab-2') // [tl! focus]
        ])
    ];
}

//...
</x-code>

<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="12" colSpan="4">
        <x-moonshine::box class="flex items-center flex-wrap gap-4">
            {!!
                MoonShine\Decorations\Tabs::make([
                    MoonShine\Decorations\Tab::make('Tab 1', [
                        MoonShine\ActionButtons\ActionButton::make('Go to tab 2')->onClick(fn() => 'setActiveTab(`my-tab-2`)', 'prevent'),
                    ])
                        ->uniqueId('my-tab-1'), // [tl! focus]

                    MoonShine\Decorations\Tab::make('Tab 2', [
                        MoonShine\ActionButtons\ActionButton::make('Go to tab 1')->onClick(fn() => 'setActiveTab(`my-tab-1`)', 'prevent'),
                    ])
                        ->uniqueId('my-tab-2') // [tl! focus]
                ])
                    ->customAttributes(['class' => 'w-full'])
            !!}
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

</x-page>
