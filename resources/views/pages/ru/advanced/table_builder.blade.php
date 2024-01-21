@php use MoonShine\Fields\Text; @endphp

<x-page
    title="TableBuilder"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#fields', 'label' => 'Поля'],
            ['url' => '#items', 'label' => 'Данные'],
            ['url' => '#paginator', 'label' => 'Пагинация'],
            ['url' => '#cast', 'label' => 'Приведение к типу'],
            ['url' => '#buttons', 'label' => 'Кнопки'],
            ['url' => '#async', 'label' => 'Асинхронный режим'],
            ['url' => '#attributes', 'label' => 'Атрибуты'],
            ['url' => '#notfound', 'label' => 'Отсутствие элементов'],
            ['url' => '#simple', 'label' => 'Упрощённый стиль'],
            ['url' => '#preview', 'label' => 'Preview'],
            ['url' => '#vertical', 'label' => 'Вертикальный режим'],
            ['url' => '#creatable', 'label' => 'Добавление записей'],
            ['url' => '#editable', 'label' => 'Редактируемые записи'],
            ['url' => '#sortable', 'label' => 'Сортируемые записи'],
        ]
    ]"
>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Поля и декорации в <strong>MoonShine</strong> используются внутри таблиц в режиме <code>preview</code>.<br/>
    За таблицы отвечает <em>TableBuilder</em>.<br/>
    Благодаря <em>TableBuilder</em> таблицы отображаются и наполняются данными.<br/>
    Вы также можете использовать <em>TableBuilder</em> на собственных страницах или даже вне <strong>MoonShine</strong>.
</x-p>

<x-code language="php">
TableBuilder::make(
    Fields|array $fields = [],
    array|Paginator|iterable $items = [],
    ?Paginator $paginator = null
)
</x-code>

<x-ul>
    <li><code>$fields</code> - поля,</li>
    <li><code>$items</code> - значения полей,</li>
    <li><code>$paginator</code> - объект пагинатора.</li>
</x-ul>

<x-code language="php">
TableBuilder::make(
    [Text::make('Text')],
    [['text' => 'Value']]
)
</x-code>

<x-p>
    Можно использовать методы:
</x-p>

<x-code language="php">
TableBuilder::make()
    ->fields([Text::make('Text')]) // [tl! focus]
    ->items([['text' => 'Value']]) // [tl! focus]
</x-code>

<x-p>
    Также доступен helper <code>table()</code>:
</x-p>

<x-code language="php">
@{!!
    table() // [tl! focus]
        ->fields([Text::make('Text')])
        ->items([['text' => 'Value']])
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

<x-sub-title id="fields">Поля</x-sub-title>

<x-p>
    Метод <code>fields()</code> позволяет задать перечень полей для построения таблицы:
</x-p>

<x-code language="php">
TableBuilder::make()
    ->fields([
        Text::make('Text'),
    ]) // [tl! focus:-2]
</x-code>

<x-sub-title id="items">Данные</x-sub-title>

<x-p>
    Метод <code>items()</code> служит для наполнения таблицы данными:
</x-p>

<x-code language="php">
TableBuilder::make()
    ->fields([Text::make('Text')])
    ->items([['text' => 'Value']]) // [tl! focus]
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Соответствие данных с полями осуществляется через значение
    <x-link link="{{ route('moonshine.page', 'fields-index') }}#make">column</x-link>
    поля!
</x-moonshine::alert>

<x-sub-title id="paginator">Пагинация</x-sub-title>

<x-p>
    Метод <code>paginator</code> для того чтобы таблица работала с пагинацией:
</x-p>

<x-code language="php">
$paginator = Article::paginate();

TableBuilder::make()
    ->fields([Text::make('Text')])
    ->items($paginator->items())
    ->paginator($paginator)  // [tl! focus]
</x-code>

Или сразу передать пагинатор:

<x-code language="php">
TableBuilder::make(
    items: Article::paginate()  // [tl! focus]
)
    ->fields([Text::make('Text')])
</x-code>

<x-sub-title id="cast">Приведение к типу</x-sub-title>

<x-p>
    Метод <code>cast()</code> служит для приведения значений таблицы к определенному типу.<br/>
    Так как по умолчанию поля работают с примитивными типами:
</x-p>

<x-code language="php">
use MoonShine\TypeCasts\ModelCast;

TableBuilder::make(items: User::paginate())
    ->fields([Text::make('Email')])
    ->cast(ModelCast::make(User::class)) // [tl! focus]
</x-code>

<x-p>
    В этом примере мы привели данные к формату модели <code>User</code> с использованием <code>ModelCast</code>.
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open">
    За более подробной информацией обратитесь к разделу
    <x-link link="{{ route('moonshine.page', 'advanced-type_casts') }}">TypeCasts</x-link>
</x-moonshine::alert>

<x-sub-title id="buttons">Кнопки</x-sub-title>

<x-p>
    Для добавления новых кнопок на основе <em>ActionButton</em>, воспользуйтесь методом <code>buttons()</code>.<br/>
    Кнопки будут добавляться для каждого row, а при включении режима <code>bulk()</code> отображаться в футере для массовых действий:
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
    ]) // [tl! focus:-5]
</x-code>

<x-sub-title id="async">Асинхронный режим</x-sub-title>

<x-p>
    Если необходимо получать данные из таблицы асинхронно (при пагинации, сортировке),
    то воспользуйтесь методом <code>async()</code>:
</x-p>

<x-code language="php">
TableBuilder::make()
    ->async('/async_url') // [tl! focus]
</x-code>

<x-sub-title id="attributes">Атрибуты</x-sub-title>

<x-p>
    Вы можете задать любые html атрибуты для таблицы через метод <code>customAttributes()</code>:
</x-p>

<x-code language="php">
TableBuilder::make()
    ->customAttributes(['class' => 'custom-table']) // [tl! focus]
</x-code>

<x-p>
    Вы можете задать любые html атрибуты для строк и ячеек таблицы:
</x-p>

<x-code language="php">
TableBuilder::make()
    ->trAttributes(
        function(
            mixed $data,
            int $row,
            ComponentAttributeBag $attributes
        ): ComponentAttributeBag {
            return $attributes->merge(['class' => 'bgc-green']);
        }
    ) // [tl! focus:-8]
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

<x-code language="php">
TableBuilder::make()
    ->tdAttributes(
        function(
            mixed $data,
            int $row,
            int $cell,
            ComponentAttributeBag $attributes
        ): ComponentAttributeBag {
            return $attributes->merge(['class' => 'bgc-red']);
        }
    ) // [tl! focus:-8]
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

<x-sub-title id="notfound">Отсутствие элементов</x-sub-title>

<x-p>
    По умолчанию, если у таблицы нет данных, то она будет пустой,
    но можно вывести сообщение <em>"Пока записей нет"</em>.<br/>
    Для этого воспользуйтесь методом <code>withNotFound()</code>:
</x-p>

<x-code language="php">
TableBuilder::make()
    ->withNotFound() // [tl! focus]
</x-code>

{!!
    table()
        ->fields([
            Text::make('Text')
        ])->withNotFound()
!!}

<x-sub-title id="simple">Упрощённый стиль</x-sub-title>

<x-p>
    По умолчанию таблица стилизована под MoonShine,
    но с помощью метода <code>simple()</code> можно отобразить таблицу в упрощённом стиле:
</x-p>

<x-code language="php">
TableBuilder::make()
    ->simple() // [tl! focus]
</x-code>

{!!
    table()
        ->simple()
        ->fields([
            Text::make('Text')
        ])->items([['text' => 'Value']])
!!}

<x-sub-title id="preview">Preview</x-sub-title>

<x-p>
    Метод <code>preview()</code> отключает отображение кнопок и сортировок для таблицы:
</x-p>

<x-code language="php">
TableBuilder::make()
    ->preview() // [tl! focus]
</x-code>

<x-sub-title id="vertical">Вертикальный режим</x-sub-title>

<x-p>
    С помощью метода <code>vertical()</code> можно отобразить таблицу в вертикальном режиме:
</x-p>

<x-code language="php">
TableBuilder::make()
    ->vertical() // [tl! focus]
</x-code>

{!!
    table()
        ->vertical()
        ->fields([
            Text::make('Property 1', 'property_1'),
            Text::make('Property 2', 'property_2')
        ])
        ->items([
            ['property_2' => 'Value 2', 'property_1' => 'Value 1']
        ])
!!}

<x-sub-title id="creatable">Добавление записей</x-sub-title>

<x-p>
    С помощью метода <code>creatable()</code> можно создать кнопку "Добавить" для генерации новых записей в таблице:
</x-p>

<x-code language="php">
creatable(
    bool $reindex = true,
    ?int $limit = null,
    ?string $label = null,
    ?string $icon = null,
    array $attributes = [],
    ?ActionButton $button = null
)
</x-code>

<x-ul>
    <li><code>$reindex</code> - режим редактирования с динамическим name,</li>
    <li><code>$limit</code> - количество записей которые можно добавить,</li>
    <li><code>$label</code> - название кнопки,</li>
    <li><code>$icon</code> - иконка у кнопки,</li>
    <li><code>$attributes</code> - дополнительные атрибуты,</li>
    <li><code>$button</code> - кастомная кнопка добавления.</li>
</x-ul>

<x-code language="php">
TableBuilder::make()
    ->creatable(
        icon: 'heroicons.outline.pencil',
        attributes: ['class' => 'my-class']
    ) // [tl! focus:-4]
    ->fields([
        Text::make('Title'),
        Text::make('Text')
    ])->items([
        ['title' => 'Value 1', 'text' => 'Value 2'],
        ['title' => '', 'text' => '']
    ])
</x-code>

{!!
    table()
        ->creatable()
        ->fields([
            Text::make('Title'),
            Text::make('Text')
        ])->items([
            ['title' => 'Value 1', 'text' => 'Value 2'],
            ['title' => '', 'text' => '']
        ])
!!}

<x-p>
    <x-moonshine::alert type="default" icon="heroicons.information-circle">
        В режиме добавления необходимо, чтобы последний элемент был пустым (скелет новой записи)!
    </x-moonshine::alert>
</x-p>

<x-moonshine::divider label="reindex" />

<x-p>
    Если в таблице находятся поля в режиме редактирования с динамическим name,
    то нужно добавить метод или параметр <code>reindex</code>:
</x-p>

<x-code language="php">
TableBuilder::make()
    ->creatable(reindex: true) // [tl! focus]
</x-code>

<x-p>
    или
</x-p>

<x-code language="php">
TableBuilder::make()
    ->creatable()
    ->reindex() // [tl! focus]
</x-code>

<x-moonshine::divider label="limit" />

<x-p>
    Если требуется ограничить количество записей которые можно добавить, то необходимо указать параметр <code>limit</code>:
</x-p>

<x-code language="php">
TableBuilder::make()
    ->creatable(limit: 6) // [tl! focus]
</x-code>

<x-moonshine::divider label="Кастомная кнопка добавления" />

<x-code language="php">
TableBuilder::make()
    ->creatable(
        button: ActionButton::make('Foo', '#')
    ) // [tl! focus:-2]
</x-code>

<x-sub-title id="editable">Редактируемые записи</x-sub-title>

<x-p>
    По умолчанию поля в таблице отображаются в режиме <code>preview</code>,<br/>
    но если требуется отобразить их как элементы формы с возможностью редактирования,<br/>
    то необходимо воспользоваться методом <code>editable()</code>:
</x-p>

<x-code language="php">
TableBuilder::make()
    ->editable() // [tl! focus]
</x-code>

{!!
    table(items: [['title' => 'Value 1', 'text' => 'Value 2'], ['title' => '', 'text' => '']])
        ->creatable()
        ->reindex()
        ->editable()
        ->fields([
            Text::make('Title'),
            Text::make('Text')
        ])
!!}

<x-sub-title id="sortable">Сортируемые записи</x-sub-title>

<x-p>
    Для сортировки строк в таблице воспользуйтесь методом <code>sortable()</code>:
</x-p>

<x-code language="php">
sortable(
    ?string $url = null,
    string $key = 'id',
    ?string $group = null
)
</x-code>

<x-ul>
    <li><code>$url</code> - url-обработчика,</li>
    <li><code>$key</code> - ключ элемента,</li>
    <li><code>$group</code> - группировка.</li>
</x-ul>

<x-code language="php">
TableBuilder::make()
    ->sortable(
        url: '/update_indexes_endpoint',
        key: 'id',
        group: 'nested'
    ) // [tl! focus:-4]
</x-code>

{!!
    table(items: [['title' => 'Value 1', 'text' => 'Value 2'], ['title' => 'Value 3', 'text' => 'Value 4']])
        ->sortable()
        ->fields([
            Text::make('Title'),
            Text::make('Text')
        ])
!!}

</x-page>
