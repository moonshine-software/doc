<x-page title="HasOne">

<x-p>Поле для отношений в laravel типа hasOne</x-p>

<x-p>Создает новую запись в связанной таблице и привязывает к текущей записе</x-p>

<x-p>При существованнии связи, запись редактируется</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\HasOne;

//...
public function fields(): array
{
    return [
        HasOne::make('Город', 'city', 'name')
            ->fields([
                ID::make(),
                Text::make('Значение', 'name'),
            ])
    ];
}
//...
</x-code>

<x-image src="{{ asset('screenshots/has_one_1.png') }}"></x-image>
<x-image src="{{ asset('screenshots/has_one_2.png') }}"></x-image>

<x-next href="{{ route('section', 'fields-has_one_through') }}">HasOneThrough</x-next>

</x-page>



