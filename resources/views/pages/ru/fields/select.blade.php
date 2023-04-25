<x-page title="Select" :sectionMenu="[
    'Разделы' => [
        ['url' => '#nullable', 'label' => 'Nullable'],
        ['url' => '#groups', 'label' => 'Группы'],
        ['url' => '#multiple', 'label' => 'Несколько значений'],
        ['url' => '#searchable', 'label' => 'Поиск'],
    ]
]">

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

<x-sub-title id="nullable">Nullable</x-sub-title>

<x-p>
    Если необходимо сохранять NULL, то нужно добавить метод <code>nullable</code>
</x-p>

<x-code language="php">
Select::make('Страна', 'country_id')
    ->nullable() // [tl! focus]
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_nullable.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_nullable_dark.png') }}"></x-image>

<x-sub-title id="groups">Группы</x-sub-title>

<x-p>
    Можно объединять значения в группы
</x-p>

<x-code language="php">
Select::make('City')->options([
    'Italy' => [
        1 => 'Rome',
        2 => 'Milan'
    ],
    'France' => [
        3 => 'Paris',
        4 => 'Marseille'
    ],
]),
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_group.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_group_dark.png') }}"></x-image>

<x-sub-title id="multiple">Выбор нескольких значений</x-sub-title>

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

<x-sub-title id="searchable">Поиск</x-sub-title>

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
