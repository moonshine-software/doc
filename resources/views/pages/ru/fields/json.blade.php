<x-page
    title="Json"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#key-value', 'label' => 'Ключ/Значение'],
            ['url' => '#fields', 'label' => 'Набор полей'],
            ['url' => '#value-only', 'label' => 'Только значение'],
            ['url' => '#default', 'label' => 'Значение по умолчанию'],
            ['url' => '#creatable-removable', 'label' => 'Добавление/удаление'],
            ['url' => '#nesting', 'label' => 'Вложенные значения'],
            ['url' => '#vertical', 'label' => 'Вертикальное отображение'],
            ['url' => '#relation', 'label' => 'Отношения через Json'],
            ['url' => '#filter', 'label' => 'Фильтр'],
            ['url' => '#buttons', 'label' => 'Кнопки'],
        ]
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

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

<x-p>
    В качестве ключей и значений по умолчанию используется поле <em>Text</em>,
    но можно использовать и другие поля для примитивных данных.
</x-p>

<x-code language="php">
use MoonShine\Fields\Json; // [tl! focus]
use MoonShine\Fields\Select;

//...

public function fields(): array
{
    return [
        Json::make('Label', 'data')->keyValue(
            keyField: Select::make('Key')->options(['vk' => 'VK', 'email' => 'E-mail']),
            valueField: Select::make('Value')->options(['1' => '1', '2' => '2']),
        ), // [tl! focus:-3]
    ];
}

//...
</x-code>

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
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;

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
creatable(
    Closure|bool|null $condition = null,
    ?int $limit = null,
    ?ActionButton $button = null
)
</x-code>

<x-ul>
    <li><code>$condition</code> - условие выполнения метода,</li>
    <li><code>$limit</code> - количество записей которые можно добавить,</li>
    <li><code>$button</code> - кастомная кнопка добавления.</li>
</x-ul>

<x-code language="php">
removable(
    Closure|bool|null $condition = null,
    array $attributes = []
)
</x-code>

<x-ul>
    <li><code>$condition</code> - условие выполнения метода,</li>
    <li><code>$attributes</code> - дополнительные атрибуты кнопки.</li>
</x-ul>

<x-code language="php">
use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data')
            ->keyValue()
            ->creatable(limit: 6) // [tl! focus]
            ->removable() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/json_removable.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/json_removable_dark.png') }}"></x-image>

<x-moonshine::divider label="Кастомная кнопка добавления" />

<x-code language="php">
use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data')
            ->keyValue()
            ->creatable(
                button: ActionButton::make('New', '#')->primary()
            ) // [tl! focus:-2]
    ];
}

//...
</x-code>

<x-moonshine::divider label="Атрибуты для кнопки удаления" />

<x-code language="php">
use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data', 'data.content')->fields([
            Text::make('Title'),
            Image::make('Image'),
            Text::make('Value'),
        ])
            ->removable(attributes: ['@click.prevent' => 'customAsyncRemove']) // [tl! focus]
            ->creatable()
    ];
}

//...
</x-code>

<x-sub-title id="nesting">Вложенные значения</x-sub-title>

<x-p>
    Получить вложенные значения <em>JSON</em> полей можно через <code>.</code>.<br />
    Значения можно редактировать, при этом изменения не затронут остальные ключи.
</x-p>

<x-code language="json">
{"info": [{"title": "Info title", "value": "Info value"}], "content": [{"title": "Content title", "value": "Content value"}]}
</x-code>

<x-code language="php">
use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data', 'data.content') // [tl! focus]
            ->fields([
                Text::make('Title'),
                Text::make('Value'),
            ])->removable()
    ];
}

//...
</x-code>

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
use MoonShine\Fields\ID;
use MoonShine\Fields\Json;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;

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
            ->removable()
    ];
}

//...
</x-code>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    Для отношений, наличие поля ID в методе fields обязательно!
</x-moonshine::alert>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    При использовании <em>BelongsTo</em> обязательно необходимо через метод
    <code>setColumn()</code> задать поле в таблице базы данных!
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/json_relation.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/json_relation_dark.png') }}"></x-image>

<x-sub-title id="filter">Фильтр</x-sub-title>

<x-p>
    Если поле используется для построения фильтра, то необходимо воспользоваться методом <code>filterMode()</code>.
    Данный метод адаптирует поведение поля и устанавливает <code>creatable = false</code>.
</x-p>

<x-code language="php">
use MoonShine\Fields\Json;
use MoonShine\Fields\Text;

//...

public function filters(): array
{
    return [
        Json::make('Data')
            ->fields([
                Text::make('Title', 'title'),
                Text::make('Value', 'value')
            ])
            ->filterMode() // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="buttons">Кнопки</x-sub-title>

<x-p>
    Метод <code>buttons()</code> позволяет добавить дополнительные кнопки к полю <em>Json</em>.
</x-p>

<x-code language="php">
buttons(array $buttons)
</x-code>

<x-code language="php">
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Fields\Json;

//...

public function fields(): array
{
    return [
        Json::make('Data', 'data.content')->fields([
            Text::make('Title'),
            Image::make('Image'),
            Text::make('Value'),
        ])->buttons([
            ActionButton::make('', '#')
                ->icon('heroicons.outline.trash')
                ->onClick(fn() => 'remove()', 'prevent')
                ->customAttributes(['class' => 'btn-secondary'])
                ->showInLine()
        ]) // [tl! focus:-5]
    ];
}

//...
</x-code>

</x-page>
