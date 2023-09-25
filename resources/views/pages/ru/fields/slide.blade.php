<x-page title="Диапазон">

<x-extendby :href="route('moonshine.custom_page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Имеет такие же методы как и поле "Число" с дополнительными методами <code>step</code>,
    <code>fromField</code>, <code>toField</code>
</x-p>

<x-p>
    Так как диапазон имеет два значения, то необходимо указать их с помощью методов
    <code>fromField()</code> и <code>toField()</code>
</x-p>

<x-code language="php">
use MoonShine\Fields\SlideField;

//...
public function fields(): array
{
    return [
        SlideField::make('Age')
            ->fromField('age_from') // Поле в таблице для значения "От"
            ->toField('age_to') // Поле в таблице для значения "До"
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/slide.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/slide_dark.png') }}"></x-image>

</x-page>
