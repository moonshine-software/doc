<x-page
    title="Select"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#default', 'label' => 'Значение по умолчанию'],
            ['url' => '#nullable', 'label' => 'Nullable'],
            ['url' => '#groups', 'label' => 'Группы'],
            ['url' => '#multiple', 'label' => 'Несколько значений'],
            ['url' => '#searchable', 'label' => 'Поиск'],
            ['url' => '#async', 'label' => 'Асинхронный поиск'],
        ]
    ]"
>

<x-p>
    Поле <em>Select</em> включает в себя все базовые методы.
</x-p>

<x-code language="php">
use MoonShine\Fields\Select; // [tl! focus]

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ]) // [tl! focus:-4]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_dark.png') }}"></x-image>

<x-sub-title id="default">Значение по умолчанию</x-sub-title>

<x-p>
    Можно воспользоваться методом <code>default()</code>, если необходимо указать значение по умолчанию для поля.
</x-p>

<x-code language="php">
default(mixed $default)
</x-code>

<x-code language="php">
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->default('value 2') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="nullable">Nullable</x-sub-title>

<x-p>
    Как и у всех полей, если необходимо сохранять NULL, то нужно добавить метод <code>nullable()</code>
</x-p>

<x-code language="php">
nullable(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->nullable() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_nullable.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_nullable_dark.png') }}"></x-image>

<x-sub-title id="groups">Группы</x-sub-title>

<x-p>
    Можно объединять значения в группы.
</x-p>

<x-code language="php">
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('City', 'city_id')
            ->options([
                'Italy' => [
                    1 => 'Rome',
                    2 => 'Milan'
                ],
                'France' => [
                    3 => 'Paris',
                    4 => 'Marseille'
                ]
            ]) // [tl! focus:-9]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_group.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_group_dark.png') }}"></x-image>

<x-sub-title id="multiple">Выбор нескольких значений</x-sub-title>

<x-p>
    Для выбора нескольких значений необходим метод <code>multiple()</code>
</x-p>

<x-code language="php">
multiple(Closure|bool|null $condition = null)
</x-code>

<x-code language="php">
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->multiple() // [tl! focus]
    ];
}

//...
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    При использовании <code>multiple()</code> для <em>Eloquent</em> модели, требуется поле в базе типа text или json.<br>
    Также необходимо добавить <em>cast</em> - json или array или collection.
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/select_multiple.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_multiple_dark.png') }}"></x-image>

<x-sub-title id="searchable">Поиск</x-sub-title>

<x-p>
    Если необходимо добавить поиск среди значений, то нужно добавить метод <code>searchable()</code>
</x-p>

<x-code language="php">
searchable()
</x-code>

<x-code language="php">
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->searchable() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/select_searchable.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/select_searchable_dark.png') }}"></x-image>

<x-sub-title id="async">Асинхронный поиск</x-sub-title>

<x-p>
    У поля <em>Select</em> так же можно организовать асинхронный поиск.
    Для это необходимо методу <code>async()</code> передать <em>url</em>,
    на который будет отправляться запрос с <em>query</em> параметром для поиск.
</x-p>

<x-code language="php">
async(?string $asyncUrl = null)
</x-code>

<x-p>
    Возвращаемый ответ с результатами поиска должен быть в формате <em>json</em>.
</x-p>

<x-code language="json">
[
    {
        "value": 1,
        "label": "Option 1"
    },
    {
        "value": 2,
        "label": "Option 2"
    }
]
</x-code>

<x-code language="php">
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Select::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
            ->searchable() // [tl! focus]
            ->async('/search') // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
