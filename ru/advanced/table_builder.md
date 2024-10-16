# TableBuilder

- [Основы](#basics)
- [Поля](#fields)
- [Элементы](#items)
- [Пагинатор](#paginator)
- [Приведение типов](#cast)
- [Кнопки](#buttons)
- [Асинхронный режим](#async)
- [Атрибуты](#attributes)
- [Отсутствующие элементы](#notfound)
- [Упрощенный стиль](#simple)
- [Липкая шапка](#sticky)
- [Предпросмотр](#preview)
- [Вертикальный режим](#vertical)
- [Добавление записей](#creatable)
- [Редактируемые](#editable)
- [Сортируемые](#sortable)
- [Отображение колонок](#column-display)

---

<a name="basics"></a>
## Основы

Поля и декорации в *MoonShine* используются внутри таблиц в режиме `preview`.<br/>
За таблицы отвечает *TableBuilder*.<br/>
С помощью *TableBuilder* отображаются таблицы и заполняются данными.<br/>
Вы также можете использовать *TableBuilder* на своих собственных страницах или даже вне **MoonShine**.<br/>

```php
TableBuilder::make(
    Fields|array $fields = [],
    Paginator|iterable $items = [],
    ?Paginator $paginator = null
)
```

-`$fields` - поля,
-`$items` - значения полей,
-`$paginator` - объект пагинатора.

```php
use MoonShine\Components\TableBuilder;

TableBuilder::make(
    [Text::make('Text')],
    [['text' => 'Value']]
)
```
То же самое через методы:

```php
TableBuilder::make()
    ->fields([Text::make('Text')])
    ->items([[ 'text' => 'Value' ]])
```


Также доступен хелпер `table()`:

```php
{!!
    table()
        ->fields([Text::make('Text')])
        ->items([['text' => 'Value']])
!!}
```

## Текст
### Значение



<a name="fields"></a>
## Поля

Метод `fields()` позволяет указать список полей для построения таблицы:

```php
TableBuilder::make()
    ->fields([
        Text::make('Text'),
    ])
```

<a name="items"></a>
## Элементы

Метод `items()` используется для заполнения таблицы данными:

```php
TableBuilder::make()
    ->fields([Text::make('Text')])
    ->items([[ 'text' => 'Value' ]])
```

> [!NOTE]
> Соответствие данных с полями осуществляется через значение [column](https://moonshine-laravel.com/docs/resource/fields/fields-index#make) полей!




<a name="paginator"></a>
## Пагинатор

Метод `paginator()` для работы таблицы с пагинацией:

```php
$paginator = Article::paginate();

TableBuilder::make()
    ->fields([Text::make('Text')])
    ->items($paginator->items())
    ->paginator($paginator)
```
Или напрямую передать пагинатор:

```php
TableBuilder::make(
    items: Article::paginate()
)
    ->fields([Text::make('Text')])
```

*TableBuilder* работает с массивами элементов;<br/>

если у вас нет массивов, необходимо привести пагинатор к массивам:

```php
$paginator = Article::paginate();

TableBuilder::make()
    ->fields([Text::make('Text')])
    ->items($paginator->through(fn($item) => $item->toArray()))
    ->paginator($paginator)
```

Или вы можете использовать метод `cast()` вместо этого.

<a name="cast"></a>
## Приведение типов

Метод `cast()` используется для приведения значений таблицы к определенному типу.<br/>
Поскольку по умолчанию поля работают с примитивными типами:

```php
use MoonShine\TypeCasts\ModelCast;

TableBuilder::make(items: User::paginate())
    ->fields([Text::make('Email')])
    ->cast(ModelCast::make(User::class))
```

В этом примере мы приводим данные к формату модели `User` с помощью `ModelCast`.


> [!NOTE]
> Для более подробной информации обратитесь к разделу [TypeCasts](https://moonshine-laravel.com/docs/resource/advanced/advanced-type_casts).


<a name="buttons"></a>
## Кнопки

Чтобы добавить новые кнопки на основе *ActionButton*, используйте метод `buttons()`.<br/>
Кнопки будут добавлены для каждой строки, а при включенном режиме `bulk()` они будут отображаться в подвале для массовых действий:

```php
TableBuilder::make(items: Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->cast(ModelCast::make(Article::class))
    ->buttons([
        ActionButton::make('Delete', route('name.delete')),
        ActionButton::make('Edit', route('name.edit'))->showInDropdown(),
        ActionButton::make('Go to home', route('home'))->blank()->canSee(fn($data) => $data->active),
        ActionButton::make('Mass Delete', route('name.mass_delete'))->bulk()
    ])
```

<a name="async"></a>
## Асинхронный режим

Если вам нужно получать данные из таблицы асинхронно (во время пагинации, сортировки), то используйте метод `async()`:

```php
async(
    ?string $asyncUrl = null,
    string|array|null $asyncEvents = null,
    ?string $asyncCallback = null
)
```
-`asyncUrl` - url запроса,
-`asyncEvents` - события, вызываемые после успешного запроса,
-`asyncCallback` - js функция обратного вызова после получения ответа.

```php
TableBuilder::make()
    ->async('/async_url')
```

После успешного запроса вы можете поднять события, добавив параметр `asyncEvents`.

```php
TableBuilder::make()
        ->name('crud')
        ->async(asyncEvents: ['table-updated-crud', 'form-reset-main-form'])
```

**MoonShine** уже имеет набор готовых событий:
- `table-updated-{name}` - обновление асинхронной таблицы по ее имени,
- `form-reset-{name}` - сброс значений формы по ее имени,
- `fragment-updated-{name}` - обновление blade-фрагмента по его имени.


> [!NOTE]
> Метод `async()` должен идти после метода `name()`!

<a name="attributes"></a>
## Атрибуты

Вы можете установить любые html-атрибуты для таблицы с помощью метода `customAttributes()`:

```php
TableBuilder::make()
    ->customAttributes(['class' => 'custom-table'])
```
Вы можете установить любые html-атрибуты для строк и ячеек таблицы:
```php
TableBuilder::make()
    ->trAttributes(function(
        mixed $data,
        int $row,
        ComponentAttributeBag $attributes
    ): ComponentAttributeBag {
        return $attributes->merge(['class' => 'bgc-green']);
    })
```
              
```php
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
    )
```

<a name="notfound"></a>
## Отсутствующие элементы

По умолчанию, если в таблице нет данных, она будет пустой, но вы можете отобразить сообщение *"Записей пока нет"*.<br/>
Для этого используйте метод `withNotFound()`:

```php
TableBuilder::make()
    ->withNotFound()
```

<a name="simple"></a>
## Упрощенный стиль

По умолчанию таблица стилизована как MoonShine,<br/>
но с помощью метода `simple()` вы можете отобразить таблицу в упрощенном стиле:

```php
TableBuilder::make()
    ->simple()
```

<a name="sticky"></a>
## Липкая шапка

Метод `sticky()` позволяет зафиксировать шапку при прокрутке таблицы с большим количеством элементов.

```php
TableBuilder::make()
    ->sticky()
```

<a name="preview"></a>
## Предпросмотр

Метод `preview()` отключает отображение кнопок и сортировок для таблицы:

```php
TableBuilder::make()
    ->preview()
```

<a name="vertical"></a>
## Вертикальный режим

С помощью метода `vertical()` вы можете отобразить таблицу в вертикальном режиме:

```php
TableBuilder::make()
    ->vertical()
```

<a name="creatable"></a>
## Добавление записей

С помощью метода `creatable()` вы можете создать кнопку "Добавить" для генерации новых записей в таблице:


```php
creatable(
    bool $reindex = true,
    ?int $limit = null,
    ?string $label = null,
    ?string $icon = null,
    array $attributes = [],
    ?ActionButton $button = null
)
```

-`$reindex` - режим редактирования с динамическим именем,
-`$limit` - количество записей, которые можно добавить,
-`$label` - название кнопки,
-`$icon` - иконка кнопки,
-`$attributes` - дополнительные атрибуты,
-`$button` - пользовательская кнопка добавления.






```
TableBuilder::make()
    ->creatable(
        icon: 'heroicons.outline.pencil',
        attributes: ['class' => 'my-class']
    )
    ->fields([
        Text::make('Title'),
        Text::make('Text')
    ])->items([
        ['title' => 'Value 1', 'text' => 'Value 2'],
        ['title' => '', 'text' => '']
    ])

```

> [!NOTE]
> В режиме добавления последний элемент должен быть пустым (скелет новой записи)!

Если таблица содержит поля в режиме редактирования с динамическим именем,
то необходимо добавить метод или параметр `reindex`:

```php
TableBuilder::make()
    ->creatable(reindex: true)
```

или

```php
TableBuilder::make()
    ->creatable()
    ->reindex()
```

#### limit

Если вы хотите ограничить количество записей, которые можно добавить, необходимо указать параметр `limit`:
```php
TableBuilder::make()
    ->creatable(limit: 6)
```
#### Пользовательская кнопка добавления
```php
TableBuilder::make()
    ->creatable(
        button: ActionButton::make('Foo', '#')
    )
```

<a name="editable"></a>
## Редактируемые

По умолчанию поля в таблице отображаются в режиме `preview`,<br/>
но если вы хотите отобразить их как редактируемые элементы формы,<br/>
то необходимо использовать метод `editable()`:

```php
TableBuilder::make()
    ->editable()
```

<a name="sortable"></a>
## Сортируемые

Для сортировки строк в таблице используйте метод `sortable()`:
```php
TableBuilder::make()
    ->sortable(
        url: '/update_indexes_endpoint',
        key: 'id',
        group: 'nested'
    )
```

-`$url` - обработчик url,
-`$key` - ключ элемента,
-`$group` - группировка.

```php
TableBuilder::make()
    ->sortable(
        url: '/update_indexes_endpoint',
        key: 'id',
        group: 'nested'
    )
```

<a name="column-display"></a>
## Отображение колонок

Вы можете позволить пользователям решать, какие колонки отображать в таблице, сохраняя выбор.<br/>
Для этого необходимо установить параметр ресурса `$columnSelection`.

```php
columnSelection(string $uniqueId = '')
```

-`$uniqueId` - уникальный Id таблицы для сохранения выбора отображаемых колонок.

```php
TableBuilder::make()
    ->fields([
        Text::make('Title'),
        Text::make('Text')
    ])
    ->columnSelection('unique-id')
```

Если вам нужно исключить поля из выбора, используйте метод `columnSelection()`.

```php
public function columnSelection(bool $active = true)
```

```php
TableBuilder::make()
    ->fields([
        Text::make('Title')
            ->columnSelection(false),
        Text::make('Text')
    ])
    ->columnSelection('unique-id')

```
