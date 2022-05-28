<x-page title="Заголовок">

<x-p>
    Для разделения зон формы можно добавлять заголовки
</x-p>

<x-code language="php">
use Leeto\MoonShine\Decorations\Heading;

//...
public function fields(): array
{
    return [
        Heading::make('Контактная информация'),

        Text::make('Фамилия', 'last_name'),
        Text::make('Имя', 'first_name'),
    ];
}
//...
</x-code>

<x-image src="{{ asset('screenshots/heading.png') }}"></x-image>

<x-next href="{{ route('section', 'filters-index') }}">Фильтры</x-next>
</x-page>