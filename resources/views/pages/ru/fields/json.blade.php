<x-page
    title="Json"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#key-value', 'label' => 'Ключ/Значение'],
            ['url' => '#fields', 'label' => 'Набор полей'],
            ['url' => '#value-only', 'label' => 'Только значение'],
            ['url' => '#default', 'label' => 'Значение по умолчанию'],
            ['url' => '#creatable-removable', 'label' => 'Добавление/удаление'],
            ['url' => '#vertical', 'label' => 'Вертикальное отображение'],
            ['url' => '#relation', 'label' => 'Отношения через Json'],
        ]
    ]"
>

<x-p>
    Поле <em>Json</em> включает в себя все базовые методы.
</x-p>

<x-p>
    У <em>Json</em> существует несколько методов, чтобы задать структуру поля:
    <code>keyValue()</code>, <code>onlyValue()</code> и <code>fields()</code>.
</x-p>

<x-moonshine::alert class="mt-8" type="default" icon="heroicons.information-circle">
    В базе поле должно иметь тип text или json. Также cast eloquent модели array или json или collection.
</x-moonshine::alert>

<x-sub-title id="key-value">Ключ/Значение</x-sub-title>

<x-p>
    Самый простой способ работы с полем <em>Json</em> это использование метода <code>keyValue()</code>.<br />
    В результате будет получен простой json <x-moonshine::badge color="gray">{key: value}</x-moonshine::badge>.
</x-p>

<x-code language="php">
keyValue(
    string $key = 'Key',
    string $value = 'Value'
)
</x-code>

<x-code language="php">
use MoonShine\Fields\Json; // [tl! focus]

//...

public function fields(): array
{
    return [
        Json::make('Data') // [tl! focus]
            ->keyValue() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/json_key_value.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/json_key_value_dark.png') }}"></x-image>

<x-sub-title id="fields">С набором полей</x-sub-title>

<x-p>
    Для более расширенного использования воспользуйтесь методом <code>fields()</code>
    и передайте необходимый набор полей.<br />
    В результате будет формироваться json следующего вида
    <x-moonshine::badge color="gray">[{title: 'title', value: 'value', active: 'active'}]</x-moonshine::badge>
</x-p>

<x-code language="php">
fields(Fields|Closure|array $fields)
</x-code>

<x-code language="php">
use MoonShine\Fields\Json; // [tl! focus]
use MoonShine\Fields\Position; // [tl! focus]
use MoonShine\Fields\Switcher; // [tl! focus]
use MoonShine\Fields\Text; // [tl! focus]

//...

public function fields(): array
{
    return [
        Json::make('Product Options', 'options') // [tl! focus:start]
            ->fields([
                Position::make(),
                Text::make('Title'),
                Text::make('Value'),
                Switcher::make('Active')
            ]) // [tl! focus:end]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/json_fields.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/json_fields_dark.png') }}"></x-image>

<x-sub-title id="value-only">Только значение</x-sub-title>

<x-p>
    Иногда требуется сохранять в базе данных только значения,
    для этого можно воспользоваться методом <code>onlyValue()</code>.<br />
    В результате будет получен json <x-moonshine::badge color="gray">['value']</x-moonshine::badge>.
</x-p>

<x-code language="php">
onlyValue(string $value = 'Value')
</x-code>

<x-code language="php">
use MoonShine\Fields\Json; // [tl! focus]

//...

public function fields(): array
{
    return [
        Json::make('Data') // [tl! focus]
            ->onlyValue() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/json_only_value.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/json_only_value_dark.png') }}"></x-image>

<x-sub-title id="default">Значение по умолчанию</x-sub-title>

<x-p>
    Можно воспользоваться методом <code>default()</code>, если необходимо указать значение по умолчанию для поля.
</x-p>

<x-code language="php">
default(mixed $default)
</x-code>

<x-code language="php">
use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data')
            ->keyValue('Key', 'Value')
            ->default([
                [
                    'key' => 'Default key',
                    'value' => 'Default value'
                ]
            ]), // [tl! focus:-5]

        Json::make('Product Options', 'options')
            ->fields([
                Text::make('Title'),
                Text::make('Value'),
                Switcher::make('Active')
            ])
            ->default([
                [
                    'title' => 'Default title',
                    'value' => 'Default value',
                    'active' => true
                ]
            ]), // [tl! focus:-6]

        Json::make('Values')
            ->onlyValue()
            ->default([
                ['value' => 'Default value']
            ]) // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-sub-title id="creatable-removable">Добавление/удаление</x-sub-title>

<x-p>
    По умолчанию поле <em>Json</em> содержит только одну запись,
    метод <code>creatable()</code> позволяет добавлять записи,
    а метод <code>removable()</code> позволяет удалять существующие.
</x-p>

<x-code language="php">
creatable()
</x-code>

<x-code language="php">
removable()
</x-code>

<x-code language="php">
use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data')
            ->keyValue()
            ->creatable() // [tl! focus]
            ->removable() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/json_removable.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/json_removable_dark.png') }}"></x-image>

<x-sub-title id="vertical">Вертикальное отображение</x-sub-title>

<x-p>
    Метод <code>vertical()</code> позволяет изменить горизонтальное расположение полей на вертикальное.
</x-p>

<x-code language="php">
vertical()
</x-code>

<x-code language="php">
use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data')
            ->keyValue()
            ->vertical() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/json_vertical.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/json_vertical_dark.png') }}"></x-image>

<x-sub-title id="relation">Отношения через Json</x-sub-title>

<x-p>
    Поле <em>Json</em> может работать с отношениями, для этого используется метод <code>asRelation()</code>,
    которому необходимо предать <em>ModelResource</em> отношения и задать массив редактируемых полей.
</x-p>

<x-code language="php">
asRelation(ModelResource $resource)
</x-code>

<x-code language="php">
use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Comments', 'comments')
            ->asRelation(new CommentResource()) // [tl! focus:start]
            ->fields([
                ID::make(),
                BelongsTo::make('Article')
                    ->setColumn('article_id')
                    ->searchable(),
                BelongsTo::make('User')
                    ->setColumn('user_id'),
                Text::make('Text')->required(),
            ]) // [tl! focus:end]
            ->creatable()
            ->removable(),
    ];
}

//...
</x-code>

<x-moonshine::alert class="mt-8" type="default" icon="heroicons.information-circle">
    При использовании <em>BelongsTo</em> обязательно необходимо через метод
    <code>setColumn()</code> задать поле в таблице базы данных!
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/json_relation.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/json_relation_dark.png') }}"></x-image>

</x-page>
