@php use MoonShine\Fields\Text; @endphp
<x-page
    title="TableBuilder"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#methods', 'label' => 'Methods'],
        ]
    ]"
>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    Fields and decorations in MoonShine are used inside tables in <code>preview</code> mode. TableBuilder is responsible for tables.
    Using TableBuilder, tables are displayed and filled with data.
    You can also use TableBuilder on your own pages or even outside of MoonShine.
</x-p>

<x-code language="php">
make(
    Fields|array $fields = [],
    protected iterable $items = [],
    protected ?Paginator $paginator = null
)
</x-code>

<x-ul>
    <li><code>fields</code> - fields,</li>
    <li><code>items</code> - field values</li>
    <li><code>paginator</code> - paginator object.</li>
</x-ul>

<x-code language="php">
TableBuilder::make([Text::make('Text')], [['text' => 'Value']])
</x-code>

<x-p>
    Same thing through methods:
</x-p>

<x-code language="php">
TableBuilder::make()
    ->fields([
        Text::make('Text')
    ])
    ->items([['text' => 'Value']])
</x-code>

<x-p>
    Helper is also available:
</x-p>

<x-code language="php">
@{!! table()
    ->fields([
        Text::make('Text')
    ])
    ->items([
        ['text' => 'Value']
    ])
!!}
</x-code>

{!!
    table()
        ->fields([
            Text::make('Text')
        ])
        ->items([
            ['text' => 'Value']
        ])
!!}

<x-sub-title id="methods">Methods</x-sub-title>

<x-moonshine::divider label="fields" />

<x-p>
    The <code>fields</code> method for declaring fields:
</x-p>

<x-code language="php">
TableBuilder::make()
    ->fields([
        Text::make('Text'),
    ])
</x-code>

<x-moonshine::divider label="items/paginator" />

<x-p>
    <code>items</code> method for filling the table with data:
</x-p>

<x-code language="php">
TableBuilder::make()
    ->fields([
        Text::make('Text'),
    ])
    ->items([['text' => 'Value']])
</x-code>

<x-p>
    The <code>paginator</code> method for the table to work with pagination:
</x-p>

<x-code language="php">
$paginator = Article::paginate();

TableBuilder::make()
    ->fields([
        Text::make('Text'),
    ])
    ->items($paginator->items())
    ->paginator($paginator)

// or simple

TableBuilder::make(items: Article::paginate())
    ->fields([
        Text::make('Text'),
    ])
</x-code>

<x-moonshine::divider label="cast" />

<x-p>
    The <code>cast</code> method for casting table values to a specific type.
    Since by default fields work with primitive types:
</x-p>

<x-code language="php">
use MoonShine\TypeCasts\ModelCast;

TableBuilder::make(items: User::paginate())
    ->fields([
        Text::make('Email'),
    ])
    ->cast(ModelCast::make(User::class))
</x-code>

<x-p>
    In this example, we cast the data to the <code>User</code> model format using <code>ModelCast</code>.
</x-p>

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.book-open">
        Read more about TypeCasts in the section of the same name.
    </x-moonshine::alert>
</x-p>

<x-moonshine::divider label="buttons" />
<x-p>
    To add new buttons based on <code>ActionButton</code>, use the <code>buttons</code> method.
    Buttons will be added for each row, and when bulk mode is enabled, they will be displayed in the footer for bulk actions:
</x-p>

<x-code language="php">
TableBuilder::make(items: Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->cast(ModelCast::make(Article::class))
    ->buttons([
        ActionButton::make('Delete', route('name.delete')),
        ActionButton::make('Edit', route('name.edit'))->showInDropdown(),
        ActionButton::make('Go to home', route('home'))->blank()->canSee(fn($data) => $data->active),
        ActionButton::make('Mass Delete', route('name.mass_delete'))->bulk()
    ])
</x-code>

<x-moonshine::divider label="async" />

<x-p>
    If you need to receive data from the table asynchronously (during pagination, sorting), then use the <code>async</code> method:
</x-p>

<x-code language="php">
TableBuilder::make()
    ->async('/async_url')
</x-code>

<x-moonshine::divider label="Attributes" />

<x-p>
    You can set any html attributes for the table using the <code>customAttributes</code> method:
</x-p>

<x-code>
TableBuilder::make()->customAttributes(['class' => 'custom-form']),
</x-code>

<x-p>
    You can set any html attributes for table rows and cells:
</x-p>

<x-code>
TableBuilder::make()->trAttributes(function(mixed $data, int $row, ComponentAttributeBag $attributes): ComponentAttributeBag {
    return $attributes->merge(['class' => 'bgc-green']);
}),
</x-code>

{!!
    table()
        ->simple()
        ->fields([
            Text::make('Text')
        ])
        ->items([
            ['text' => 'Value']
        ])->trAttributes(function(mixed $data, int $row, $attributes) {
            return $attributes->merge(['class' => 'bgc-green']);
        })
!!}

<x-code>
TableBuilder::make()->tdAttributes(function(mixed $data, int $row, int $cell, ComponentAttributeBag $attributes): ComponentAttributeBag {
    return $attributes->merge(['class' => 'bgc-red']);
}),
</x-code>

{!!
    table()
        ->simple()
        ->fields([
            Text::make('Text')
        ])
        ->items([
            ['text' => 'Value']
        ])->trAttributes(function(mixed $data, int $row, $attributes) {
            return $attributes->merge(['class' => 'bgc-red']);
        })
!!}

<x-moonshine::divider label="withNotFound" />

<x-p>
    By default, if the table has no data, it will be empty, but you can display the message “No records yet.”
    To do this, use the <code>withNotFound</code> method:
</x-p>

<x-code>
TableBuilder::make()->withNotFound(),
</x-code>

{!!
    table()
        ->fields([
            Text::make('Text')
        ])->withNotFound()
!!}

<x-moonshine::divider label="simple" />

<x-p>
    By default, the table is styled as MoonShine, but using the <code>simple</code> method you can display the table in a simplified style:
</x-p>

<x-code>
TableBuilder::make()->simple(),
</x-code>

{!!
    table()
        ->simple()
        ->fields([
            Text::make('Text')
        ])->items([['text' => 'Value']])
!!}

<x-moonshine::divider label="preview" />

<x-p>
    The <code>preview</code> method disables the display of buttons and sorts for the table:
</x-p>

<x-code>
TableBuilder::make()->preview(),
</x-code>

<x-moonshine::divider label="vertical" />

<x-p>
    Using the <code>vertical</code> method you can display the table in vertical mode:
</x-p>

<x-code>
TableBuilder::make()->vertical(),
</x-code>

{!!
    table()
        //->vertical() broken in alpha3, all done in repo
        ->fields([
            Text::make('Text'),
            Text::make('Text 2')
        ])->items([['text' => 'Value']])
!!}

<x-moonshine::divider label="creatable/reindex" />

<x-p>
    Using the <code>creatable()</code> method, you can create an "Add" button to generate new records in the table:
</x-p>

<x-code language="php">
TableBuilder::make()->creatable(),
</x-code>

<x-p>
    If the table contains fields in edit mode with a dynamic name,
    then you need to add a method or parameter <code>reindex</code>:
</x-p>

<x-code>
    TableBuilder::make()->creatable(reindex: true),
    // or
    TableBuilder::make()->creatable()->reindex(),
</x-code>

<x-p>
    If you want to limit the number of records that can be added, you must specify the <code>limit</code> parameter:
</x-p>

<x-code>
    TableBuilder::make()->creatable(limit: 6),
</x-code>

{!!
    table()
        ->creatable()
        ->fields([
            Text::make('Text'),
            Text::make('Text 2')
        ])->items([['text' => 'Value']])
!!}

<x-moonshine::divider label="editable" />

<x-p>
    By default, fields in the table are displayed in <code>preview()</code> mode,
    but if you want to display them as editable form elements,
    then you need to use the <code>editable()</code> method:
</x-p>

<x-code>
TableBuilder::make()->editable(),
</x-code>

{!!
    table(items: [['text' => 'Value', 'field' => 'Value'], ['text' => '', 'field' => '']])
        ->creatable()->reindex()->editable()
        ->fields([
            Text::make('Text'),
            Text::make('Field')
        ])
!!}

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.book-open">
        In append mode, the last element must be empty (the skeleton of the new entry):
    </x-moonshine::alert>
</x-p>

<x-moonshine::divider label="sortable" />

<x-p>
    To sort rows in a table, use the <code>sortable()</code> method:
</x-p>

<x-code language="php">
sortable(
    ?string $url = null,
    string $key = 'id',
    ?string $group = null
)
</x-code>

<x-ul>
    <li><code>url</code> - url handler</li>
    <li><code>key</code> - element key</li>
    <li><code>group</code> - grouping.</li>
</x-ul>

<x-code language="php">
TableBuilder::make()
    ->sortable(url: '/update_indexes_endpoint', key: 'id', group: 'nested'),
</x-code>

{!!
    table(items: [['text' => 'Value 1', 'field' => 'Value 1'], ['text' => 'Value 2', 'field' => 'Value 2']])
        ->sortable()
        ->fields([
            Text::make('Text'),
            Text::make('Field')
        ])
!!}

</x-page>
