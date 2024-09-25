# TableBuilder (В процессе...)

# TODO
- [ ] Пагинатор с примером враппера
- [ ] Кейс с использованием на не объвленной странице
- [ ] Объясление важности полей
- [ ] head/body/footRows


- [Описание](#description)
- [Основное использование](#basic-usage)
- [Методы настройки](#configuration-methods)
  - [Поля](#fields)
  - [items](#items)
  - [paginator](#paginator)
  - [buttons](#buttons)
- [Дополнительные возможности](#additional-features)
  - [Вертикальное отображение](#vertical-display)
  - [Редактируемая таблица](#editable-table)
  - [Добавление новых строк](#adding-new-rows)
  - [Переиндексация](#reindexing)
  - [Сортировка перетаскиванием](#drag-and-drop-sorting)
  - [Упрощенный вид](#simple-view)
  - [Фиксированный заголовок](#sticky-header)
  - [Выбор колонок](#column-selection)
  - [Поиск](#search)
  - [Действие по клику](#click-action)
  - [Сохранение состояния в URL](#save-state-in-url)
  - [Удаление после клонирования](#remove-after-clone)
- [Настройка атрибутов](#attribute-configuration)
- [Асинхронная загрузка](#async-loading)
- [Кастомизация данных](#data-customization)

<a name="description"></a>
## Описание

`TableBuilder` - это инструмент в MoonShine для создания настраиваемых таблиц для отображения данных. Он используется на индексной и детальной CRUD страницах, а также для полей отношений таких как `HasMany`, `BelongsToMany`, `RelationRepeater` и поля `Json`.

<a name="basic-usage"></a>
## Основное использование

Пример использования TableBuilder:

```php
TableBuilder::make()
    ->items($this->getCollection())
    ->fields([
        ID::make()->sortable(),
        Text::make('Название', 'title'),
    ])
```

<a name="configuration-methods"></a>
## Методы настройки

<a name="fields"></a>
### Поля

Метод `fields` определяет поля таблицы:

```php
->fields([
    ID::make()->sortable(),
    Text::make('Название', 'title'),
])
```

<a name="items"></a>
### items

Метод `items` устанавливает данные для таблицы:

```php
->items($this->getCollection())
```

<a name="paginator"></a>
### paginator

Метод `paginator` устанавливает пагинатор для таблицы:

```php
->paginator($paginatorInstance)
```

<a name="buttons"></a>
### buttons

Метод `buttons` добавляет кнопки действий:

```php
->buttons([
    // Здесь определяются кнопки действий
])
```

<a name="additional-features"></a>
## Дополнительные возможности

<a name="vertical-display"></a>
### Вертикальное отображение

Метод `vertical()` отображает таблицу в вертикальном формате:

```php
->vertical()
```

<a name="editable-table"></a>
### Редактируемая таблица

Метод `editable()` делает таблицу редактируемой:

```php
->editable()
```

<a name="adding-new-rows"></a>
### Добавление новых строк

Метод `creatable()` позволяет добавлять новые строки:

```php
->creatable(reindex: true, limit: 5, label: 'Добавить', icon: 'plus')
```

<a name="reindexing"></a>
### Переиндексация

Метод `reindex()` позволяет переиндексировать элементы таблицы:

```php
->reindex()
```

<a name="drag-and-drop-sorting"></a>
### Сортировка перетаскиванием

Метод `reorderable()` добавляет возможность сортировки строк перетаскиванием:

```php
->reorderable('/reorder-url', 'id', 'group-name')
```

<a name="simple-view"></a>
### Упрощенный вид

Метод `simple()` применяет упрощенный стиль к таблице:

```php
->simple()
```

<a name="sticky-header"></a>
### Фиксированный заголовок

Метод `sticky()` делает заголовок таблицы фиксированным:

```php
->sticky()
```

<a name="column-selection"></a>
### Выбор колонок

Метод `columnSelection()` добавляет возможность выбора отображаемых колонок:

```php
->columnSelection()
```

<a name="search"></a>
### Поиск

Метод `searchable()` добавляет функцию поиска по таблице:

```php
->searchable()
```

<a name="click-action"></a>
### Действие по клику

Метод `clickAction()` задает действие при клике на строку:

```php
->clickAction(ClickAction::EDIT, '.edit-button')
```

<a name="save-state-in-url"></a>
### Сохранение состояния в URL

Метод `pushState()` сохраняет состояние таблицы в URL:

```php
->pushState()
```

<a name="remove-after-clone"></a>
### Удаление после клонирования

Метод `removeAfterClone()` удаляет элемент после клонирования:

```php
->removeAfterClone()
```

<a name="attribute-configuration"></a>
## Настройка атрибутов

TableBuilder предоставляет методы для настройки HTML-атрибутов:

```php
->trAttributes(fn($data, $row) => ['class' => $row % 2 ? 'bg-gray-100' : ''])
->tdAttributes(fn($data, $row, $cell) => ['class' => $cell === 0 ? 'font-bold' : ''])
->headAttributes(['class' => 'bg-blue-500 text-white'])
->bodyAttributes(['class' => 'text-sm'])
->footAttributes(['class' => 'bg-gray-200'])
```

<a name="async-loading"></a>
## Асинхронная загрузка

Метод `async()` настраивает асинхронную загрузку таблицы:

```php
->async('/load-data')
```

<a name="data-customization"></a>
## Кастомизация данных

Метод `cast()` позволяет кастомизировать данные:

```php
->cast(new CustomDataCaster())
```

TableBuilder в MoonShine предоставляет широкий спектр возможностей для создания гибких и функциональных таблиц в административной панели.
