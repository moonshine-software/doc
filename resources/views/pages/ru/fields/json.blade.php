<x-page title="Json" :sectionMenu="[
    'Разделы' => [
        ['url' => '#key-value', 'label' => 'Ключ/Значение'],
        ['url' => '#fields', 'label' => 'С набором полей'],
        ['url' => '#removable', 'label' => 'Удаление'],
    ]
]">

<x-sub-title id="key-value">Ключ/Значение</x-sub-title>

<x-p>
    В базе поле должно иметь тип text или json. Также cast eloquent модели array или json или collection.
</x-p>

<x-p>
    Самый простой способ с использованием метода keyValue, в таком случае в базе будет
    простой json [{key: value}]
</x-p>

<x-code language="php">
use MoonShine\Fields\Json;

//...
public function fields(): array
{
    return [
        Json::make('Опции товара', 'options')
            ->keyValue('Характеристика', 'Значение') // Первый аргумент Лейбл ключа, второй лейбл Значения
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/json_fields.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/json_fields_dark.png') }}"></x-image>

<x-sub-title id="fields">С набором полей</x-sub-title>

<x-p>
    Для более расширенного использования воспользуйтесь методом fields и передайте необходимый набор
    полей подобно тому как работает ресурс
</x-p>

<x-code language="php">
use MoonShine\Fields\Json;

//...
public function fields(): array
{
    return [
        Json::make('Опции товара', 'options')
            ->fields([
                Text::make('Заголовок', 'title'),
                Text::make('Значение', 'value')
            ])
    ];
}
//...
</x-code>

<x-p>
    json [{title: 'value', value: 'value'}]
</x-p>

<x-image theme="light" src="{{ asset('screenshots/json_key_value.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/json_key_value_dark.png') }}"></x-image>

<x-sub-title id="removable">Удаление</x-sub-title>

<x-code language="php">
Json::make('Опции товара', 'options')
    ->keyValue('Характиристика', 'Значение')
    ->removable() // [tl! focus]
</x-code>

<x-image theme="light" src="{{ asset('screenshots/json_removable.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/json_removable_dark.png') }}"></x-image>

</x-page>
