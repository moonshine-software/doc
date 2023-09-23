<x-page title="Вкладки">
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
                        Text::make('Seo title'),
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
        Декоратор <code>Tab</code> можно пометить, как активный по-умолчанию
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
                    ])->active()
                ])
            ]),
        ];
    }
    //...
    </x-code>


    <x-image theme="light" src="{{ asset('screenshots/tabs_with_active.png') }}"></x-image>
    <x-image theme="dark" src="{{ asset('screenshots/tabs_with_active_dark.png') }}"></x-image>

</x-page>
