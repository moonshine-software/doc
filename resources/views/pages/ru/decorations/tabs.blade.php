<x-page title="Вкладки">
<x-p>
    На форму для удобства можно добавить вкладки и сгруппировать поля
</x-p>

<x-code language="php">
use Leeto\MoonShine\Decorations\Tabs;
use Leeto\MoonShine\Decorations\Tab;
use Leeto\MoonShine\Decorations\Block;

//...
public function fields(): array
{
    return [
        Block::make('Основное', [
            Tabs::make([
                Tab::make('Основное', [
                    Text::make('Фамилия', 'last_name'),
                    Text::make('Имя', 'first_name'),
                ]),
                Tab::make('Контактная информация', [
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
