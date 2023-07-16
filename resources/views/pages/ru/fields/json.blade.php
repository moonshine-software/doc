<x-page
    title="Json"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#key-value', 'label' => 'Ключ/Значение'],
            ['url' => '#fields', 'label' => 'С набором полей'],
            ['url' => '#removable', 'label' => 'Удаление'],
            ['url' => '#value-only', 'label' => 'Только значение'],
        ]
    ]"
    :videos="[
        ['url' => 'https://www.youtube.com/embed/7HGaebxlcFM?start=1607&end=1789', 'title' => 'Screencasts: Поле Json'],
    ]"
>

<x-moonshine::alert class="mt-8" type="default" icon="heroicons.information-circle">
    В базе поле должно иметь тип text или json. Также cast eloquent модели array или json или collection.
</x-moonshine::alert>

<x-sub-title id="key-value">Ключ/Значение</x-sub-title>

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
        Json::make('Product Options', 'options') // [tl! focus]
            ->keyValue('Characteristic', 'Value') // Первый аргумент Лейбл ключа, второй лейбл значения [tl! focus]
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
        Json::make('Product Options', 'options') // [tl! focus:start]
            ->fields([
                Text::make('Title', 'title'),
                Text::make('Value', 'value')
            ]) // [tl! focus:end]
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
Json::make('Product Options', 'options')
    ->keyValue('Characteristics', 'Value')
    ->removable() // [tl! focus]
</x-code>

<x-image theme="light" src="{{ asset('screenshots/json_removable.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/json_removable_dark.png') }}"></x-image>

<x-sub-title id="value-only">Только значение</x-sub-title>

<x-p>
    Иногда требуется сохранять в базе данных только значения,
    для этого можно воспользоваться методом <code>onlyValue()</code>.
</x-p>

<x-code language="php">
Json::make('Product Options', 'options')
    ->onlyValue() // [tl! focus]
</x-code>

</x-page>
