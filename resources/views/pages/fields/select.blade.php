<x-page title="Селект поле">

<x-p>
    Текстовое поле включает в себя все базовые методы и дополнительные для селект полей
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Страна', 'country_id')
            ->options([
                'value 1' => 'Option Label 2',
                'value 2' => 'Option Label 2'
            ])
    ];
}

//...
</x-code>

<x-p>
    Для выбора нескольких значений необходим метод <code>multiple</code>
</x-p>

<x-code language="php">
Select::make('Страна', 'country_id')
    ->multiple() // [tl! focus]
</x-code>

<x-p>
    Если необходимо добавить поиск среди значений, то нужно добавить метод <code>searchable</code>
</x-p>

<x-code language="php">
    Select::make('Страна', 'country_id')
    ->searchable() // [tl! focus]
</x-code>

<x-next href="{{ route('section', 'fields-enum') }}">Enum</x-next>

</x-page>



