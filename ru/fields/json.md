# Json

- [Основы](#basics)
- [Набор полей](#fields)
- [Режим "Ключ/Значение"](#key-value)
- [Режим "Только значения"](#only-value)
- [Режим "Объект"](#object-mode)
- [Значение по умолчанию](#default)
- [Фильтрация "пустых" значений](#filtering-empty)
- [Добавление/Удаление](#creatable-removable)
- [Вертикальный режим](#vertical)
- [Применение в фильтрах](#filter)
- [Кнопки](#buttons)
- [Модификаторы](#modify)

---

<a name="basics"></a>
## Основы

Содержит все [Базовые методы](/docs/{{version}}/fields/basic-methods).

Поле `Json` предназначено для удобной работы с типом данных json.
В большинстве случаев оно используется с массивами объектов через `TableBuilder`, но также поддерживает режим работы с одним объектом.

@include('_includes/note-about-multiple-cast')

<a name="fields"></a>
## Набор полей

Предположим, что структура вашего json имеет следующий вид:

```json
[{"title": "title", "value": "value", "active": true}]
```

Это набор объектов с полями "title", "value" и "active".
Чтобы указать такой набор полей, используется метод `fields()`.

```php
fields(FieldsContract|Closure|iterable $fields)
```

Пример:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Position;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields([
        Position::make(),
        Text::make('Title'),
        Text::make('Value'),
        Switcher::make('Active'),
    ])
```

![json_fields](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_fields.png#light)
![json_fields_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_fields_dark.png#dark)

Поля также можно передавать через замыкание, что позволяет получить доступ к контексту поля и его данным.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Position;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

Json::make('Product Options', 'options')
    ->fields(
        static fn(Json $ctx) => $ctx->getData()->getOriginal()->is_active ? [
            Position::make(),
            Text::make('Title'),
            Text::make('Value'),
            Switcher::make('Active')
        ] : [
            Text::make('Title')
        ]
    )
```

<a name="key-value"></a>
## Режим "Ключ/Значение"

Когда ваши данные имеют структуру ключ/значение, как в следующем примере `{"key": "value"}`, используется метод `keyValue()`.

```php
keyValue(
    string $key = 'Key',
    string $value = 'Value',
    ?FieldContract $keyField = null,
    ?FieldContract $valueField = null,
)
```

- `$key` — заголовок поля "ключ",
- `$value` — заголовок поля "значение",
- `$keyField` — возможность заменить поле "ключ" на своё (по умолчанию — `Text`),
- `$valueField` — возможность заменить поле "значение" на своё (по умолчанию — `Text`).

Пример:

```php
Json::make('Data')
    ->keyValue()
```

![json_key_value](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_key_value.png#light)
![json_key_value_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_key_value_dark.png#dark)

Пример с изменением типов полей:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;

Json::make('Label', 'data')
    ->keyValue(
        keyField: Select::make('Key')
            ->options(['vk' => 'VK', 'email' => 'E-mail']),
        valueField: Text::make('Value'),
    )
```

<a name="only-value"></a>
## Режим "Только значения"

Если необходимо хранить только значения, как в примере `["value_1", "value_2"]`, используется метод `onlyValue()`.

```php
onlyValue(
    string $value = 'Value',
    ?FieldContract $valueField = null,
)
```

- `$value` - заголовок поля "значение",
- `$valueField` -  возможность заменить поле "значение" на своё (по умолчанию — `Text`).

Пример:

```php
Json::make('Data')
    ->onlyValue()
```

![json_only_value](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_only_value.png#light)
![json_only_value_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_only_value_dark.png#dark)

<a name="object-mode"></a>
## Режим "Объект"

В большинстве случаев поле `Json` работает с массивом объектов через `TableBuilder`.
Однако возможен и режим работы с объектом, например, `{"title": "Title", "active": false}`.
Для этого используется метод `object()`.

Пример:

```php
Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Switcher::make('Active'),
    ])
    ->object()
```

<a name="default"></a>
## Значение по умолчанию

Как и в других полях, здесь есть возможность указать значение по умолчанию с помощью метода `default()`.
В данном случае необходимо передать массив.

```php
default(mixed $default)
```

Пример:

```php
Json::make('Data')
    ->keyValue('Key', 'Value')
    ->default([
        [
            'key' => 'Default key',
            'value' => 'Default value',
        ]
    ]),

Json::make('Product Options', 'options')
    ->fields([
        Text::make('Title'),
        Text::make('Value'),
        Switcher::make('Active'),
    ])
    ->default([
        [
            'title' => 'Default title',
            'value' => 'Default value',
            'active' => true,
        ]
    ]),

Json::make('Values')
    ->onlyValue()
    ->default([
        ['value' => 'Default value']
    ])
```

<a name="filtering-empty"></a>
## Фильтрация "пустых" значений

По умолчанию поле `Json` фильтрует все пустые значения, но это поведение можно отключить.

```php
Json::make('data')->stopFilteringEmpty()
```

<a name="creatable-removable"></a>
## Добавление/Удаление

По умолчанию поле `Json` содержит только один элемент.
Метод `creatable()` позволяет добавлять новые элементы, а `removable()` — удалять их.

```php
creatable(
    Closure|bool|null $condition = null,
    ?int $limit = null,
    ?ActionButtonContract $button = null,
)
```

- `$condition` - условие, при котором метод должен быть применён,
- `$limit` - ограничение на количество возможных элементов,
- `$button` - возможность заменить кнопку добавления на свою.

```php
removable(
    Closure|bool|null $condition = null,
    array $attributes = [],
)
```

- `$condition` - условие, при котором метод должен быть применён,
- `$attributes` - HTML атрибуты для кнопки удаления.

Пример:

```php
Json::make('Data')
    ->keyValue()
    ->creatable(limit: 6)
    ->removable()
```

![json_removable](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_removable.png#light)
![json_removable_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_removable_dark.png#dark)

### Кастомизация кнопки добавления

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->keyValue()
    ->creatable(
        button: ActionButton::make('New')->primary()
    )
```

### HTML атрибуты для кнопки удаления

```php
Json::make('Data', 'data.content')
    ->fields([
        Text::make('Title'),
        Image::make('Image'),
        Text::make('Value'),
    ])
    ->removable(attributes: ['@click.prevent' => 'customAsyncRemove'])
    ->creatable()
```

<a name="vertical"></a>
## Вертикальный режим

Метод `vertical()` позволяет изменить отображение таблицы из горизонтального режима на вертикальный.

Пример:

```php
Json::make('Data')
    ->vertical()
```

![json_vertical](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_vertical.png#light)
![json_vertical_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/json_vertical_dark.png#dark)

<a name="filter"></a>
## Применение в фильтрах

Если поле используется в фильтрах, необходимо включить режим фильтрации с помощью метода `filterMode()`.
Этот метод адаптирует поведение поля для фильтрации и отключает возможность добавления новых элементов.

```php
Json::make('Data')
    ->fields([
        Text::make('Title', 'title'),
        Text::make('Value', 'value')
    ])
    ->filterMode()
```

<a name="buttons"></a>
## Кнопки

Метод `buttons()` позволяет переопределить кнопки, используемые в поле.
По умолчанию доступна только кнопка удаления.

```php
buttons(array $buttons)
```

Пример:

```php
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
            ->showInLine()
    ])
```

<a name="modify"></a>
## Модификаторы

Поле `Json` предоставляет возможность модифицировать кнопки или таблицу в режимах "preview" или "default", вместо их полного замещения.

### Модификатор кнопки удаления

Метод `modifyRemoveButton()` позволяет изменить кнопку удаления.

```php
/**
 * @param  Closure(ActionButton $button, self $field): ActionButton  $callback
 */
modifyRemoveButton(Closure $callback)
```

Пример:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->modifyRemoveButton(
        fn(ActionButton $button) => $button->customAttributes([
            'class' => 'btn-secondary'
        ])
    )
```

### Модификатор таблицы

Метод `modifyTable()` позволяет модифицировать таблицу (`TableBuilder`) для всех визуальных режимов поля.

```php
/**
 * @param  Closure(TableBuilder $table, bool $preview): TableBuilder $callback
 */
modifyTable(Closure $callback)
```

Пример:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Json;

Json::make('Data')
    ->modifyTable(
        fn(TableBuilder $table, bool $preview) => $table->customAttributes([
            'style' => 'width: 50%;'
        ])
    )
```
