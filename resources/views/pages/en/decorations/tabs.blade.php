<x-page title="Tabs">
<x-p>
    You can add tabs and group fields on the form for convenience
</x-p>

<x-code language="php">
use Leeto\MoonShine\Decorations\Tabs;
use Leeto\MoonShine\Decorations\Tab;
use Leeto\MoonShine\Decorations\Block;

//...
public function fields(): array
{
    return [
        Block::make('Main', [
            Tabs::make([
                Tab::make('Main', [
                    Text::make('Surname', 'last_name'),
                    Text::make('Name', 'first_name'),
                ]),
                Tab::make('Contact info', [
                    Text::make('Телефон', 'phone'),
                    Text::make('E-mail', 'email'),
                ])
            ])
        ]),
    ];
}
//...
</x-code>

<x-image src="{{ asset('screenshots/tabs.png') }}"></x-image>
</x-page>
