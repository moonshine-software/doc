# Json

- [Основы](#basics)
- [Набор полей](#fields)
- [Вертикальный режим](#vertical)
- [Режим "Ключ/значение"](#key-value)
- [Режим "Только значение"](#only-value)
- [Режим "Объект"](#object)
- [Вложенные Json](#nested)
- [Табличный preview](#table-preview)
- [Добавление/Удаление](#creatable-removable)
- [Кнопки](#buttons)
- [Модификаторы](#modify)
- [Сортировка перетаскиванием](#reorderable)
- [Сообщение при отсутствии элементов](#empty-message)
- [Применение в фильтрах](#filter)
- [Фильтрация "пустых" значений](#filter-empty)
- [Значение по умолчанию](#default)
- [Использование в blade](#blade-usage)

---

<a name="basics"></a>

## Основы

Содержит все [Базовые методы](/docs/{{version}}/fields/basic-methods).

Поле `Json` предназначено для работы с колонками, в которых хранится массив объектов.
Схема объекта задается через метод `fields()`, а каждая строка интерфейса соответствует одному объекту массива.

@include('_includes/note-about-multiple-cast')

<a name="fields"></a>

## Набор полей

Метод `fields()` задает поля, которые будут отображаться в каждой строке `Json`.

```php
fields(FieldsContract|Closure|iterable $fields, string $orientation = 'horizontal')
```

- `$fields` - набор полей.
- `$orientation` - расположение полей в строке: `horizontal` или `vertical`.

Пример:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
```

Для поля выше данные хранятся как массив объектов:

```json
[
    {
        "title": "Title 1",
        "value": "Value 1"
    },
    {
        "title": "Title 2",
        "value": "Value 2"
    }
]
```

<a name="vertical"></a>

## Вертикальный режим

Вертикальный режим меняет расположение полей внутри каждой строки `Json`: поля выводятся друг под другом, а не в одну линию.
Это удобно для длинных значений, Textarea, Select с большим количеством опций и вложенных компонентов.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ], orientation: 'vertical')
```

Также можно использовать метод `vertical()`:

```php
vertical(bool $condition = true)
```

При вызове без аргументов метод включает вертикальный режим. Если передать `false`, поле вернется к горизонтальному расположению.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Json;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
    ->vertical()
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Json;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ], orientation: 'vertical')
    ->vertical(false)
```

<a name="key-value"></a>

## Режим "Ключ/значение"

Метод `keyValue()` используется для JSON-объектов, где ключ хранится как имя свойства, а значение - как значение этого свойства.

```php
keyValue(
    string|FieldContract $key = 'Key',
    string|FieldContract $value = 'Value',
    ?FieldContract $keyField = null,
    ?FieldContract $valueField = null,
    string $orientation = 'horizontal',
)
```

По умолчанию для ключа и значения будут созданы текстовые поля:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Json;

Json::make('Contacts', 'contacts')
    ->keyValue()
```

Если нужно заменить поля ключа или значения, передайте свои поля:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;

Json::make('Contacts', 'contacts')
    ->keyValue(
        keyField: Select::make('Key')
            ->options([
                'vk' => 'VK',
                'email' => 'E-mail',
            ]),
        valueField: Text::make('Value'),
    )
```

<a name="only-value"></a>

## Режим "Только значение"

Метод `onlyValue()` используется для JSON-массивов, где каждая строка хранится как отдельное значение без объекта.

```php
onlyValue(string $value = 'Value', ?FieldContract $valueField = null)
```

- `$value` - заголовок поля. Используется для поля `Text` по умолчанию.
- `$valueField` - поле значения, если нужно заменить `Text` на другое поле.

Пример:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Json;

Json::make('Tags', 'tags')
    ->onlyValue()
```

Данные будут храниться как JSON-массив значений:

```json
[
    "lorem",
    "ipsum"
]
```

Если нужно заменить поле значения, передайте `$valueField`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Select;

Json::make('Contacts', 'contacts')
    ->onlyValue(
        valueField: Select::make('Type')
            ->options([
                'vk' => 'VK',
                'email' => 'E-mail',
            ]),
    )
```

<a name="object"></a>

## Режим "Объект"

По умолчанию `Json` работает с массивом объектов. Метод `object()` используется, когда в колонке должен храниться один JSON-объект, например `{"title": "Title", "active": false}`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

Json::make('Settings', 'settings')
    ->fields([
        Text::make('Title'),
        Switcher::make('Active'),
    ])
    ->object()
```

При использовании `object()` добавление и удаление строк недоступно. В интерфейсе отображаются только значения, заданные через `fields()`.

<a name="nested"></a>

## Вложенные Json

Внутри `Json` можно использовать другое поле `Json`, если нужно описать более сложную структуру данных.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;

Json::make('Products', 'products')
    ->fields([
        Text::make('Name', 'name'),
        Json::make('Prices', 'prices')
            ->fields([
                Number::make('Wholesale price', 'wholesale_price'),
                Number::make('Retail price', 'retail_price'),
            ])
            ->object(),
    ])
```

Данные будут храниться с вложенным объектом:

```json
[
    {
        "name": "product 1",
        "prices": {
            "wholesale_price": 1000,
            "retail_price": 1200
        }
    }
]
```

<a name="table-preview"></a>

## Табличный preview

По умолчанию preview поля `Json` выводится как список только для чтения, где заголовок каждого поля отображается рядом со значением.
Метод `table()` переводит поле в режим `preview` и выводит значение как таблицу только для чтения.

```php
table(bool $condition = true)
```

Пример:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Products', 'products')
    ->fields([
        Text::make('Name'),
        Json::make('Links')
            ->fields([
                Text::make('Label'),
                Text::make('Url'),
            ]),
    ])
    ->table()
```

Поле будет отображаться как таблица, где `Name` и `Links` будут заголовками таблицы.

Также можно включить табличный preview только для вложенного поля `Json`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Products', 'products')
    ->fields([
        Text::make('Name'),
        Json::make('Links')
            ->fields([
                Text::make('Label'),
                Text::make('Url'),
            ])
            ->table(),
    ])
```

<a name="creatable-removable"></a>

## Добавление/Удаление

По умолчанию строки можно добавлять и удалять.
Метод `creatable()` управляет добавлением новых строк, а `removable()` - удалением существующих.

```php
creatable(
    Closure|bool|null $condition = null,
    ?int $limit = null,
    ?ActionButtonContract $button = null,
    bool $hideButton = false,
)
```

- `$condition` - условие, при котором добавление строк доступно.
- `$limit` - максимальное количество строк.
- `$button` - кастомная кнопка добавления.
- `$hideButton` - скрывает кнопку добавления, не отключая возможность добавления строк на уровне поля.

Если указан `$limit`, кнопка добавления остается видимой, но блокируется при достижении лимита.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
    ->creatable(limit: 6)
```

Кастомизация кнопки добавления:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->keyValue()
    ->creatable(
        button: ActionButton::make('New')->primary()
    )
```

Скрытие кнопки добавления:

```php
Json::make('Data')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
    ->creatable(hideButton: true)
```

Метод `removable()` управляет отображением кнопки удаления строки.

```php
removable(
    Closure|bool|null $condition = null,
    array $attributes = [],
)
```

- `$condition` - условие, при котором удаление строк доступно.
- `$attributes` - HTML-атрибуты для кнопки удаления.

При `removable(false)` пользователь сможет добавлять новые строки, но не сможет удалять существующие.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
    ->removable(false)
```

HTML-атрибуты для кнопки удаления:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Data', 'data.content')
    ->fields([
        Text::make('Title'),
        Image::make('Image'),
        Text::make('Value'),
    ])
    ->removable(attributes: ['@click.prevent' => 'customAsyncRemove'])
    ->creatable()
```

<a name="buttons"></a>

## Кнопки

Метод `buttons()` позволяет переопределить кнопки, используемые в строках поля.
По умолчанию доступна только кнопка удаления.

```php
buttons(array $buttons)
```

Пример:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:5]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Data', 'data.content')
    ->fields([
        Text::make('Title'),
        Image::make('Image'),
        Text::make('Value'),
    ])
    ->buttons([
        ActionButton::make('')
            ->icon('trash')
            ->onClick(fn() => 'remove()', 'prevent')
            ->secondary()
            ->showInLine(),
    ])
```

<a name="modify"></a>

## Модификаторы

Поле `Json` позволяет модифицировать кнопки в режимах `preview` или `default`, не заменяя их полностью.
Для табличного preview также доступен модификатор таблицы.

### Модификатор кнопки добавления

Метод `modifyCreateButton()` позволяет изменить кнопку добавления.

```php
/**
 * @param Closure(ActionButton $button, self $field): ActionButton $callback
 */
modifyCreateButton(Closure $callback)
```

Пример:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->creatable()
    ->modifyCreateButton(
        fn(ActionButton $button): ActionButton => $button->customAttributes([
            'class' => 'btn-primary',
        ])
    )
```

### Модификатор кнопки удаления

Метод `modifyRemoveButton()` позволяет изменить кнопку удаления.

```php
/**
 * @param Closure(ActionButton $button, self $field): ActionButton $callback
 */
modifyRemoveButton(Closure $callback)
```

Пример:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->modifyRemoveButton(
        fn(ActionButton $button): ActionButton => $button->customAttributes([
            'class' => 'btn-secondary',
        ])
    )
```

### Модификатор таблицы

Метод `modifyTable()` позволяет модифицировать таблицу `TableBuilder` при выводе поля `Json` в preview-режиме.
Метод применяется только для табличного preview, то есть когда поле рендерится через `preview()` или `previewMode()` и включен метод `table()`.

```php
/**
 * @param Closure(TableBuilder $table, bool $preview): TableBuilder $callback
 */
modifyTable(Closure $callback)
```

Пример:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->table()
    ->modifyTable(
        fn(TableBuilder $table, bool $preview): TableBuilder => $table->customAttributes([
            'style' => 'width: 20%;',
        ])
    )
```

Также можно использовать совместимые настройки `TableBuilder`, которые поддерживает текущий табличный шаблон:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->table()
    ->modifyTable(
        fn(TableBuilder $table): TableBuilder => $table
            ->simple()
            ->sticky()
    )
```

Для строк и ячеек доступны `trAttributes()` и `tdAttributes()`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->table()
    ->modifyTable(
        fn(TableBuilder $table): TableBuilder => $table
            ->trAttributes(fn(): array => ['style' => 'background: red'])
            ->tdAttributes(fn(): array => ['style' => 'background: blue'])
    )
```

<a name="reorderable"></a>

## Сортировка перетаскиванием

По умолчанию сортировка строк перетаскиванием выключена.

Метод `reorderable()` управляет отображением кнопки перетаскивания строки.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
    ->reorderable()
```

Чтобы явно выключить сортировку перетаскиванием, укажите `false`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
    ->reorderable(false)
```

<a name="empty-message"></a>

## Сообщение при отсутствии элементов

Когда в поле `Json` нет строк, в интерфейсе отображается пустой блок.
Метод `emptyMessage()` управляет текстом внутри этого блока.

```php
emptyMessage(string $message)
```

Пример:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
    ->emptyMessage('No options added')
```

Для вложенных полей `Json` можно задать отдельное сообщение:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Products', 'products')
    ->fields([
        Text::make('Name'),
        Json::make('Links')
            ->fields([
                Text::make('Label'),
                Text::make('Url'),
            ])
            ->emptyMessage('No links added'),
    ])
```

<a name="filter"></a>

## Применение в фильтрах

Если поле используется в фильтрах, включите режим фильтрации с помощью метода `filterMode()`.
Он адаптирует поведение поля для фильтра и отключает добавление новых строк.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Data')
    ->fields([
        Text::make('Title', 'title'),
        Text::make('Value', 'value'),
    ])
    ->filterMode()
```

Для вложенного `Json` режим фильтрации задается отдельно:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Data')
    ->fields([
        Text::make('Title', 'title'),
        Json::make('Links', 'links')
            ->fields([
                Text::make('Label', 'label'),
                Text::make('Url', 'url'),
            ])
            ->filterMode(),
    ])
```

<a name="filter-empty"></a>

## Фильтрация "пустых" значений

По умолчанию поле `Json` фильтрует все пустые значения, но это поведение можно отключить.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Json;

Json::make('Data', 'data')
    ->stopFilteringEmpty()
```

<a name="default"></a>

## Значение по умолчанию

Как и в других полях, значение по умолчанию задается методом `default()`.
Для `Json` необходимо передать массив объектов.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
    ])
    ->default([
        [
            'title' => 'Default title',
            'value' => 'Default value',
        ],
    ])
```

<a name="blade-usage"></a>

## Использование в blade

Компонент поля можно использовать напрямую в Blade-шаблонах:

```bladehtml
<x-moonshine::json
    input-name="options"
    empty-message="No options added"
    :rows="[
        [
            'title' => 'Title 1',
            'value' => 'Value 1',
        ],
    ]"
    :fields="[
        [
            'column' => 'title',
            'label' => 'Title',
            'type' => 'text',
            'placeholder' => 'Title',
        ],
        [
            'column' => 'value',
            'label' => 'Value',
            'type' => 'text',
            'placeholder' => 'Value',
        ],
    ]"
/>
```

Возможные атрибуты:

```bladehtml
<x-moonshine::json
    :rows="$rows"
    :fields="$fields"
    :controls="$controls"
    :input-name="$inputName"
    :removable="$removable"
    :creatable="$creatable"
    :creatable-limit="$creatableLimit"
    :hide-create-button="$hideCreateButton"
    :create-button="$createButton"
    :buttons="$buttons"
    :remove-button="$removeButton"
    :remove-button-attributes="$removeButtonAttributes"
    :reorderable="$reorderable"
    :orientation="$orientation"
    :key-value="$keyValue"
    :only-value="$onlyValue"
    :object-mode="$objectMode"
    :filter-empty="$filterEmpty"
    :empty-message="$emptyMessage"
/>
```
