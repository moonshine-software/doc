<x-page title="Tabs">
    <x-p>
        You can add tabs and group fields in the form for convenience
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
            Block::make('Main', [
                Tabs::make([
                    Tab::make('Seo', [
                        Text::make('Seo title')
                            ->fieldContainer(false),
                        //...
                    ]),
                    Tab::make('Categories', [
                        Text::make('Category name'),
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

    <x-p>
        The <code>Tab</code> decorator also may be marked as active by default
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
                        Text::make('Seo title'),
                        //...
                    ]),
                    Tab::make('Categories', [
                        Text::make('Category name'),
                        //...
                    ])->active(),
                ]),
            ]),
        ];
    }
    //...
    </x-code>

    <x-image theme="light" src="{{ asset('screenshots/tabs_with_active.png') }}"></x-image>
    <x-image theme="dark" src="{{ asset('screenshots/tabs_with_active_dark.png') }}"></x-image>
</x-page>
