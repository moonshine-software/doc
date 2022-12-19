<x-page title="Вкладки">
<x-p>
    На форму для удобства можно добавить вкладки и сгруппировать поля
</x-p>

<x-code language="php">
use Leeto\MoonShine\Decorations\Tab;

//...
public function fields(): array
{
    return [
        Tab::make('Основное', [
            Text::make('Фамилия', 'last_name'),
            Text::make('Имя', 'first_name'),
        ])
    ];
}
//...
</x-code>

<x-image src="{{ asset('screenshots/tabs.png') }}"></x-image>
</x-page>
