# TableBuilder (В процессе...)

- [Описание](#description)
- [Основное использование](#basic-usage)
- [Методы настройки](#configuration-methods)
  - [Поля](#fields)
  - [Данные](#items)
  - [Пагинация](#paginator)
  - [Кнопки](#buttons)
  - [Кастомизация строк](#rows)
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
- [Настройка атрибутов](#attribute-configuration)
- [Асинхронная загрузка](#async-loading)
- [Кастомизация данных](#data-customization)

<a name="description"></a>
## Описание

`TableBuilder` - это инструмент в MoonShine для создания настраиваемых таблиц для отображения данных. Он используется на индексной и детальной CRUD страницах, а также для полей отношений таких как `HasMany`, `BelongsToMany`, `RelationRepeater` и поля `Json`.

```php
TableBuilder::make(iterable $fields = [], iterable $items = [])
```

<a name="basic-usage"></a>
## Основное использование

Пример использования TableBuilder:

```php
TableBuilder::make()
    ->items([
      ['id' => 1, 'title' => 'Hello world']
    ])
    ->fields([
        ID::make()->sortable(),
        Text::make('Название', 'title'),
    ])
```

<a name="configuration-methods"></a>
## Методы настройки

<a name="fields"></a>
### Поля

Поля для TableBuilder упрощают наполнение данными и отображение ячеек таблицы.
По умолчанию поля выводятся в режиме `preview`.
Метод `fields` определяет поля таблицы, каждое поле является ячейкой таблицы (`td`):

```php
->fields([
    ID::make()->sortable(),
    Text::make('Название', 'title'),
])
```

Если необходимо указать атрибуты для `td`, то необходимо воспользоваться методом `customWrapperAttributes`

```php
->fields([
    ID::make()->sortable(),
    Text::make('Название', 'title')->customWrapperAttributes(['class' => 'my-class']),
])
```

<a name="items"></a>
### Данные

Метод `items` устанавливает данные для таблицы:

```php
->items($this->getCollection())
```

<a name="paginator"></a>
### Пагинация

Метод `paginator` устанавливает пагинатор для таблицы, необходимо передать объект реализующий интерфейс `MoonShine\Contracts\Core\Paginator\PaginatorContract`:

> [!NOTE]
> Если необходимо указать пагинатор для QueryBuilder, то можно воспользоваться встроенным `ModelCaster` как в примере ниже:

```php
->paginator(
  (new ModelCaster(Article::class))
    ->paginatorCast(
        Article::query()->paginate()
    )
)
```

<a name="buttons"></a>
### Кнопки

Метод `buttons` добавляет кнопки действий:

```php
->buttons([
    ActionButton::make('Do something'),
])
```

Для указания массовых действий над элементами таблицы, необходимо у `ActionButton` указать метод `bulk`:

```php
->buttons([
    ActionButton::make('Do bulk something')->bulk(),
])
```

<a name="rows"></a>
### Кастомизация строк

Поля ускоряют процесс и наполняют таблицу самостоятельно, выстраивая шапку таблицы с заголовками и полей и сортировок, тело таблицы с выводом данных через поля и футер таблицы с массовыми действиями, но иногда может возникнуть потребность указать строки самостоятельно, либо добавить дополнительные
Для этой задачи существуют методы для соответсвующих секций таблицы `headRows` (`thead`), `rows` (`tbody`), `footRows` (`tfoot`)

```php
// tbody
TableBuilder::make()
  ->rows(
    static fn(TableRowsContract $default) => $default->pushRow(
        TableCells::make()->pushCell(
            'td content'
        )
    )
  )


// thead
TableBuilder::make()
  ->headRows(
    static fn(TableRowContract $default) => TableRows::make([$default])->pushRow(
        TableCells::make()->pushCell(
            'td content'
        )
    )
  )

// tfoot
TableBuilder::make()
  ->footRows(
    static fn(TableRowContract $default) => TableRows::make([$default])->pushRow(
        TableCells::make()->pushCell(
            'td content'
        )
    )
  )
```

`TableRows` и `TableCells` коллекции компонентов с дополнительным сахаром, чтобы быстро добавить строку или ячейку таблицы

```php
TableRows::make()->pushRow(
  TableCellsContract $cells,
  int|string|null $key = null,
  ?Closure $builder = null
)
```

- `$cells` - коллекция ячеек,
- `$key` - уникальный ключ tr для массовых действий и событий обновления строк таблицы,
- `$builder` - доступ к TableBuilder.

```php
TableCells::make()->pushCell(
  Closure|string $content,
  ?int $index = null,
  ?Closure $builder = null,
  array $attributes = []
)
```

- `$content` - содержимое ячейки,
- `$index` - порядковый номер ячейки,
- `$builder` - доступ к TableBuilder,
- `$attributes` - HTML атрибуты ячейки.


У TableCells есть также дополнительные вспомогательные методы.

`pushFields` для быстрой генерации ячеек на основе полей:

```php
TableCells::make()->pushFields(
  FieldsContract $fields,
  ?Closure $builder = null,
  int $startIndex = 0
)
```

- `$fields` - коллекция полей,
- `$builder` - доступ к TableBuilder,
- `$startIndex` - начальный индекс (так как до возможно уже были добавлены ячейки таблицы)

Также доступны условные методы `pushWhen` и `pushCellWhen`

<a name="additional-features"></a>
## Дополнительные возможности

<a name="vertical-display"></a>
### Вертикальное отображение

Метод `vertical()` отображает таблицу в вертикальном формате (используется на `DetailPage`):

```php
->vertical()
```

<a name="editable-table"></a>
### Редактируемая таблица

Метод `editable()` делает таблицу редактируемой, все поля переводятся в режим `defaultMode` (режим формы):

```php
->editable()
```

<a name="adding-new-rows"></a>
### Добавление новых строк

Метод `creatable()` позволяет добавлять новые строки, делает таблицу динамической:

```php
->creatable(reindex: true, limit: 5, label: 'Добавить', icon: 'plus')
```

<a name="reindexing"></a>
### Переиндексация

Метод `reindex()` позволяет переиндексировать элементы таблицы, всем `name` атрибутам элементам формы будет добавлен индекс.
Пример - Поле `Text::make('Title', 'title')` на первой строке `tr` таблицы будет иметь вид `<input name="title[1]">`.
В режиме `creatable` или `removable` при добавлении/удалении новой строки все атрибуты `name` будут переиндексированы с учетом порядкового номера

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
### Упрощенный вид пагинатора

Метод `simple()` применяет упрощенный стиль пагинации в таблице:

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
В примере ниже при клике на строку таблицы, произойдет клик на кнопку редактирования

```php
->clickAction(ClickAction::EDIT)
```

Если вы используете кастомные кнопки или переопределили кнопки по умолчанию, в таком случае также может потребоваться указать селектор кнопки

```php
->clickAction(ClickAction::EDIT, '.edit-button')
```

<a name="save-state-in-url"></a>
### Сохранение состояния в URL

Метод `pushState()` сохраняет состояние таблицы в URL:

```php
->pushState()
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
->async(
  Closure|string|null $url = null,
  string|array|null $events = null,
  ?AsyncCallback $callback = null,
)
```

- `$url` - урл асинхронного запроса (в ответе необходимо вернуть TableBuilder),
- `$events` - события которые будут вызваны после успешного ответа
- `$callback` - js callback, который можно добавить как обертку ответа

Все параметры метода `async` являются опциональными и по умолчанию TableBuilder автоматически укажет url на основе текущей страницы.

В процессе использования TableBuilder в режиме `async` может возникнуть задача, когда вы используете его вне админ. панели на страницах не объявленных в системе MoonShine, тогда вам потребуется указать собственный url и реализововать ответ с html таблице, давайте рассмотрим пример реализации:

```php
TableBuilder::make()->name('my-table')->async(route('undefined-page.component', [
    '_namespace' => self::class,
    '_component_name' => 'my-table'
]))
```

`Controller`

```php
<?php

declare(strict_types=1);

namespace App\MoonShine\Controllers;

use Illuminate\Contracts\View\View;
use MoonShine\Laravel\MoonShineRequest;
use MoonShine\Laravel\Http\Controllers\MoonShineController;

final class UndefinedPageController extends MoonShineController
{
    public function component(MoonShineRequest $request): View
    {
        $page = app($request->input('_namespace'));

        $component = $page->getComponents()->findByName(
            $request->getComponentName()
        );

        return $component->render();
    }
}
```

<a name="data-customization"></a>
## Кастомизация данных

Метод `cast()` позволяет кастомизировать данные:

```php
->cast(new CustomDataCaster())
```

TableBuilder в MoonShine предоставляет широкий спектр возможностей для создания гибких и функциональных таблиц в административной панели.
