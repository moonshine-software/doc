<x-page title="Select">

<x-p>
    Текстовое поле включает в себя все базовые методы и дополнительные для селект полей
</x-p>

<x-code language="php">
use MoonShine\Fields\Select;

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

<x-image theme="light" src="{{ asset('screenshots/select.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_dark.png') }}"></x-image>

<x-p>
    Если необходимо сохранять NULL, то нужно добавить метод <code>nullable</code>
</x-p>

<x-code language="php">
    Select::make('Страна', 'country_id')
    ->nullable() // [tl! focus]
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_nullable.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_nullable_dark.png') }}"></x-image>

<x-p>
    Для выбора нескольких значений необходим метод <code>multiple</code>
</x-p>

<x-code language="php">
Select::make('Страна', 'country_id')
    ->multiple() // [tl! focus]
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Поле в базе необходимо типа text или json.<br>
    Также необходимо добавить cast для eloquent модели - json или array или collection.
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/select_multiple.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_multiple_dark.png') }}"></x-image>

<x-p>
    Если необходимо добавить поиск среди значений, то нужно добавить метод <code>searchable</code>
</x-p>

<x-code language="php">
    Select::make('Страна', 'country_id')
    ->searchable() // [tl! focus]
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_searchable.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_searchable_dark.png') }}"></x-image>

</x-page>
