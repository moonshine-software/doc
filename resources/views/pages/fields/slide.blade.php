<x-page title="Диапазон">

<x-p>
    Имеет такие же методы как и поле "Число" с дополнительными методами <code>step</code>,
     <code>fromField</code>, <code>toField</code>
</x-p>

<x-p>
    Так как диапазон имеет 2 значения, то необходимо указать эти два поля в базе по средства методов
    <code>fromField</code> и <code>toField</code>
</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\SlideField;

//...
public function fields(): array
{
    return [
        SlideField::make('Стоимость', 'rating')
            ->fromField('price_from') // Поле в базе для значения "От"
            ->toField('price_to') // Поле в базе для значения "Да"
            ->min(100)
            ->max(1000)
            ->step(10) // Шаг ползунка
    ];
}

//...
</x-code>

<x-image src="{{ asset('screenshots/slide.png') }}"></x-image>

<x-next href="{{ route('section', 'fields-date') }}">Дата</x-next>

</x-page>



