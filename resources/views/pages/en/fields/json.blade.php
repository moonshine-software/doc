<x-page
    title="Json"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#key-value', 'label' => 'Key/Value'],
            ['url' => '#fields', 'label' => 'Field set'],
            ['url' => '#value-only', 'label' => 'Meaning only'],
            ['url' => '#default', 'label' => 'Default value'],
            ['url' => '#creatable-removable', 'label' => 'Add/Remove'],
            ['url' => '#nesting', 'label' => 'Nested values'],
            ['url' => '#vertical', 'label' => 'Vertical display'],
            ['url' => '#relation', 'label' => 'Relationships via Json'],
            ['url' => '#filter', 'label' => 'Filter'],
            ['url' => '#buttons', 'label' => 'Buttons'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    The <em>Json</em> field includes all the base methods.
</x-p>

<x-p>
    <em>Json</em> has several methods to set the field structure:
    <code>keyValue()</code>, <code>onlyValue()</code> and <code>fields()</code>.
</x-p>

<x-moonshine::alert class="mt-8" type="default" icon="heroicons.information-circle">
    In the database, the field must be of text or json type. Also cast eloquent of an array or json or collection model.
</x-moonshine::alert>

<x-sub-title id="key-value">Key/Value</x-sub-title>

<x-p>
    The easiest way to work with a <em>Json</em> field is to use the <code>keyValue()</code> method.<br />
    The result will be a simple json <x-moonshine::badge color="gray">{key: value}</x-moonshine::badge>.
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

<x-sub-title id="fields">With a set of fields</x-sub-title>

<x-p>
    For more advanced use, use the <code>fields()</code> method
    and pass the required set of fields.<br />
    As a result, the following json will be generated
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

<x-sub-title id="value-only">Meaning only</x-sub-title>

<x-p>
    Sometimes you only need to store values in the database,
    To do this, you can use the <code>onlyValue()</code> method.<br />
    The result will be json <x-moonshine::badge color="gray">['value']</x-moonshine::badge>.
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

<x-sub-title id="default">Default value</x-sub-title>

<x-p>
    You can use the <code>default()</code> method if you need to specify a default value for a field.
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

<x-sub-title id="creatable-removable">Add/Remove</x-sub-title>

<x-p>
    By default, the <em>Json</em> field contains only one entry,
    The <code>creatable()</code> method allows you to add entries,
    and the <code>removable()</code> method allows you to remove existing ones.
</x-p>

<x-code language="php">
creatable(
    Closure|bool|null $condition = null,
    ?int $limit = null,
    ?ActionButton $button = null
)
</x-code>

<x-ul>
    <li><code>$condition</code> - method execution condition,</li>
    <li><code>$limit</code> - number of records that can be added,</li>
    <li><code>$button</code> - custom add button.</li>
</x-ul>

<x-code language="php">
removable(
    Closure|bool|null $condition = null,
    array $attributes = []
)
</x-code>

<x-ul>
    <li><code>$condition</code> - condition for executing the method,</li>
    <li><code>$attributes</code> - additional button attributes.</li>
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

<x-moonshine::divider label="Custom add button" />

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

<x-moonshine::divider label="Attributes for the delete button" />

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

<x-sub-title id="nesting">Nested values</x-sub-title>

<x-p>
    You can get nested values of <em>JSON</em> fields using <code>.</code>.<br />
    Values can be edited, but the changes will not affect other keys.
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

<x-sub-title id="vertical">Vertical display</x-sub-title>

<x-p>
    The <code>vertical()</code> method allows you to change the horizontal layout of the fields to vertical.
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

<x-sub-title id="relation">Relationships via Json</x-sub-title>

<x-p>
    The <em>Json</em> field can work with relationships; the <code>asRelation()</code> method is used for this,
    to which you need to assign <em>ModelResource</em> relationships and specify an array of editable fields.
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
    For relationships, the presence of the ID field in the fields method is mandatory!
</x-moonshine::alert>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    When using <em>BelongsTo</em> it is necessary to use the method
    <code>setColumn()</code> set a field in a database table!
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/json_relation.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/json_relation_dark.png') }}"></x-image>

<x-sub-title id="filter">Filter</x-sub-title>

<x-p>
    If the field is used to build a filter, then you must use the <code>filterMode()</code> method.
    This method adapts the behavior of the field and sets <code>creatable = false</code>.
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

<x-sub-title id="buttons">Buttons</x-sub-title>

<x-p>
    The <code>buttons()</code> method allows you to add additional buttons to the <em>Json</em> field.
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
