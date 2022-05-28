<x-page title="Дата">

<x-p>
    Input с типом date и дополнительным методом  <code>format</code>
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Date;

//...
public function fields(): array
{
    return [
        Date::make('Дата создания', 'created_at')
            ->format('d.m.Y') // Формат отображения даты на главной ресурса
    ];
}

//...
</x-code>

<x-next href="{{ route('section', 'fields-switch') }}">Переключатель</x-next>

</x-page>



