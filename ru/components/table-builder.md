# TableBuilder

- [Вступление](#intro)
- [Основное использование](#basic-usage)
- [Основные методы](#basic-methods)
  - [Поля](#fields)
  - [Данные](#items)
  - [Пагинация](#paginator)
  - [Упрощенный вид пагинатора](#simple-paginate)
  - [Кнопки](#buttons)
- [Отображение](#view-methods)
  - [Вертикальное отображение](#vertical-display)
  - [Редактируемая таблица](#editable-table)
  - [Упрощенный режим](#preview-table)
  - [С уведомлением "Ничего не найдено"](#not-found)
  - [Кастомизация строк](#rows)
- [Дополнительные возможности](#additional-features)
  - [Добавление новых строк](#adding-new-rows)
  - [Переиндексация](#reindexing)
  - [Сортировка перетаскиванием](#drag-and-drop-sorting)
  - [Фиксированный заголовок](#sticky-header)
  - [Выбор колонок](#column-selection)
  - [Поиск](#search)
  - [Действие по клику](#click-action)
  - [Сохранение состояния в URL](#save-state-in-url)
- [Настройка атрибутов](#attribute-configuration)
- [Асинхронная загрузка](#async-loading)
- [Приведение к типу](#type-cast)

<a name="intro"></a>
## Вступление

`TableBuilder` - инструмент в MoonShine для создания настраиваемых таблиц для отображения данных. Он используется на индексной и детальной CRUD-страницах, а также для полей отношений, таких как `HasMany`, `BelongsToMany`, `RelationRepeater` и поля `Json`.

```php
TableBuilder::make(iterable $fields = [], iterable $items = [])
```

<a name="basic-usage"></a>
## Основное использование

Пример использования `TableBuilder`:

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

<a name="basic-methods"></a>
## Основные методы

<a name="fields"></a>
### Поля

Поля для `TableBuilder` упрощают наполнение данными и отображение ячеек таблицы.
По умолчанию поля выводятся в режиме `preview`.
Метод `fields` определяет поля таблицы, каждое поле является ячейкой таблицы (`td`):

```php
->fields([
    ID::make()->sortable(),
    Text::make('Название', 'title'),
])
```

Если необходимо указать атрибуты для `td`, воспользуйтесь методом `customWrapperAttributes`:

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

Метод `paginator` устанавливает пагинатор для таблицы. Необходимо передать объект, реализующий интерфейс `MoonShine\Contracts\Core\Paginator\PaginatorContract`:

> [!NOTE]
> Если необходимо указать пагинатор для QueryBuilder, можно воспользоваться встроенным `ModelCaster`, как в примере ниже:

```php
->paginator(
  (new ModelCaster(Article::class))
    ->paginatorCast(
        Article::query()->paginate()
    )
)
```

> [!NOTE]
> Пагинатор также можно указать через метод `items`.

<a name="simple-paginate"></a>
### Упрощенный вид пагинатора

Метод `simple()` применяет упрощенный стиль пагинации в таблице:

```php
->simple()
```

<a name="buttons"></a>
### Кнопки

Метод `buttons` добавляет кнопки действий:

```php
->buttons([
    ActionButton::make('Delete', fn() => route('name.delete')),
    ActionButton::make('Edit', fn() => route('name.edit'))->showInDropdown(),
    ActionButton::make('Go to home', fn() => route('home'))->blank()->canSee(fn($data) => $data->active),
    ActionButton::make('Mass Delete', fn() => route('name.mass_delete'))->bulk(),
])
```

Для указания массовых действий над элементами таблицы необходимо у `ActionButton` указать метод `bulk`:

```php
->buttons([
    ActionButton::make('Mass Delete', fn() => route('name.mass_delete'))->bulk(),
])
```

<a name="view-methods"></a>
## Отображение

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

<a name="preview-table"></a>
### Упрощенный режим

Метод `preview()` отключает отображение кнопок и сортировок для таблицы:

```php
->preview()
```

<a name="not-found"></a>
### С уведомлением "Ничего не найдено"

По умолчанию, если у таблицы нет данных, то она будет пустой, но можно вывести сообщение "Пока записей нет".
Для этого воспользуйтесь методом `withNotFound`:

```php
TableBuilder::make()
    ->withNotFound()
```

<a name="rows"></a>
### Кастомизация строк

Поля ускоряют процесс и наполняют таблицу самостоятельно, выстраивая шапку таблицы с заголовками полей и сортировок, тело таблицы с выводом данных через поля и футер таблицы с массовыми действиями. Однако иногда может возникнуть потребность указать строки самостоятельно либо добавить дополнительные.
Для этой задачи существуют методы для соответствующих секций таблицы: `headRows` (`thead`), `rows` (`tbody`), `footRows` (`tfoot`).

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

`TableRows` и `TableCells` - это коллекции компонентов с дополнительным функционалом для быстрого добавления строки или ячейки таблицы.

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

У TableCells также есть дополнительные вспомогательные методы.

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
- `$startIndex` - начальный индекс (так как до этого, возможно, уже были добавлены ячейки таблицы)

Также доступны условные методы `pushWhen` и `pushCellWhen`.

<a name="additional-features"></a>
## Дополнительные возможности

<a name="adding-new-rows"></a>
### Добавление новых строк

Метод `creatable()` позволяет добавлять новые строки, делает таблицу динамической:

```php
->creatable(reindex: true, limit: 5, label: 'Добавить', icon: 'plus', attributes: ['class' => 'my-class'])
```

```php
creatable(
    bool $reindex = true,
    ?int $limit = null,
    ?string $label = null,
    ?string $icon = null,
    array $attributes = [],
    ?ActionButtonContract $button = null
)
```

- `$reindex` - режим редактирования с динамическим name,
- `$limit` - количество записей, которые можно добавить,
- `$label` - название кнопки,
- `$icon` - иконка у кнопки,
- `$attributes` - дополнительные атрибуты,
- `$button` - кастомная кнопка добавления.

> [!NOTE]
> В режиме добавления необходимо, чтобы последний элемент был пустым (скелет новой записи)!

Если в таблице находятся поля в режиме редактирования с динамическим name, то нужно добавить метод или параметр `reindex`:

```php
TableBuilder::make()
    ->creatable(reindex: true)

TableBuilder::make()
    ->creatable()
    ->reindex()
```

Пример с указанием кастомной кнопки добавления:

```php
TableBuilder::make()
    ->creatable(
        button: ActionButton::make('Foo', '#')
    )
```

<a name="reindexing"></a>
### Переиндексация

Метод `reindex()` позволяет переиндексировать элементы таблицы, всем `name` атрибутам элементов формы будет добавлен индекс.
Пример: Поле `Text::make('Title', 'title')` на первой строке `tr` таблицы будет иметь вид `<input name="title[1]">`.
В режиме `creatable` или `removable` при добавлении/удалении новой строки все атрибуты `name` будут переиндексированы с учетом порядкового номера.

```php
->reindex()
```

<a name="drag-and-drop-sorting"></a>
### Сортировка перетаскиванием

Метод `reorderable()` добавляет возможность сортировки строк перетаскиванием:

```php
->reorderable(url: '/reorder-url', key: 'id', group: 'group-name')
```

- `$url` - URL-обработчика,
- `$key` - ключ элемента,
- `$group` - группировка (если требуется).

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

Если необходимо у определенных полей отключить выбор отображения, то воспользуйтесь методом `columnSelection` у поля с параметром, равным `false`:

```php
TableBuilder::make()
    ->fields([
        Text::make('Title')
            ->columnSelection(false),
        Text::make('Text')
    ])
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
В примере ниже при клике на строку таблицы произойдет клик на кнопку редактирования.

```php
->clickAction(ClickAction::EDIT)
```

Если вы используете кастомные кнопки или переопределили кнопки по умолчанию, в таком случае также может потребоваться указать селектор кнопки:

```php
->clickAction(ClickAction::EDIT, '.edit-button')
```

Типы ClickAction:

- `ClickAction::SELECT` - выбор строки для массовых действий,
- `ClickAction::EDIT` - переход в редактирование,
- `ClickAction::DETAIL` - переход в детальный просмотр.

<a name="save-state-in-url"></a>
### Сохранение состояния в URL

Метод `pushState()` сохраняет состояние таблицы в URL:

```php
->pushState()
```

<a name="attribute-configuration"></a>
## Настройка атрибутов

TableBuilder предоставляет методы для настройки HTML-атрибутов:

Приношу извинения за неполный ответ. Продолжу с того места, где остановился:

```php
->trAttributes(fn($data, $row) => ['class' => $row % 2 ? 'bg-gray-100' : ''])
->tdAttributes(fn($data, $row, $cell) => ['class' => $cell === 0 ? 'font-bold' : ''])
->headAttributes(['class' => 'bg-blue-500 text-white'])
->bodyAttributes(['class' => 'text-sm'])
->footAttributes(['class' => 'bg-gray-200'])
->customAttributes(['class' => 'custom-table']) 
```

<a name="async-loading"></a>
## Асинхронная загрузка

Метод `async()` настраивает асинхронную загрузку таблицы:

> [!NOTE]
> Метод `async` должен быть после метода `name`

```php
->async(
  Closure|string|null $url = null,
  string|array|null $events = null,
  ?AsyncCallback $callback = null,
)
```

- `$url` - URL асинхронного запроса (в ответе необходимо вернуть TableBuilder),
- `$events` - события, которые будут вызваны после успешного ответа,
- `$callback` - JS callback, который можно добавить как обертку ответа.

После успешного запроса можно вызвать события, добавив параметр `asyncEvents`.

```php
use MoonShine\Support\AlpineJs;
use MoonShine\Support\Enums\JsEvent;

TableBuilder::make()
        ->name('crud')
        ->async(events: [
          AlpineJs::event(JsEvent::FORM_RESET, 'main-form'),
          AlpineJs::event(JsEvent::TOAST, params: ['text' => 'Success', 'type' => 'success']),
        ])
```

Список событий для TableBuilder:

- `JsEvent::TABLE_UPDATED` - обновление таблицы,
- `JsEvent::TABLE_REINDEX` - реиндексация таблицы (см. `reindex()`)
- `JsEvent::TABLE_ROW_UPDATED` - обновление строки таблицы (`AlpineJs::event(JsEvent::TABLE_ROW_UPDATED, "{component-name}-{row-id}")`)

Все параметры метода `async` являются опциональными, и по умолчанию TableBuilder автоматически укажет URL на основе текущей страницы.

В процессе использования TableBuilder в режиме `async` может возникнуть задача, когда вы используете его вне админ-панели на страницах, не объявленных в системе MoonShine. Тогда вам потребуется указать собственный URL и реализовать ответ с HTML таблицы. Давайте рассмотрим пример реализации:

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

<a name="type-cast"></a>
## Приведение к типу

Метод `cast` служит для приведения значений таблицы к определенному типу.
Так как по умолчанию поля работают с примитивными типами:

```php
use MoonShine\Laravel\TypeCasts\ModelCaster;

TableBuilder::make()
    ->cast(new ModelCaster(User::class))
```

В этом примере мы привели данные к формату модели `User` с использованием `ModelCaster`.

> [!NOTE]
> За более подробной информацией обратитесь к разделу [TypeCasts](/docs/{{version}}/advanced/type-casts)

TableBuilder в MoonShine предоставляет широкий спектр возможностей для создания гибких и функциональных таблиц в административной панели.
