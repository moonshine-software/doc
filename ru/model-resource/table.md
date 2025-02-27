# Таблицы

- [Основы](#basics)
- [Сортировка](#order-by)
- [Кнопки](#buttons)
- [Атрибуты](#attributes)
- [Действия по клику](#click)
- [Фиксированная шапка](#sticky-table)
- [Отображение колонок](#column-display)
- [Sticky ячейки](#sticky)
- [Пагинация](#pagination)
  - [Курсорная](#simple-pagination)
  - [Упрощенная](#simple-pagination)
  - [Отключение пагинации](#disable-pagination)
- [Асинхронный режим](#async)
  - [Обновление ряда](#update-row)
  - [Lazy режим](#lazy)
- [Модификаторы](#modifiers)
  - [Компоненты](#components)
  - [Элементы thead, tbody, tfoot](#thead-tbody-tfoot)

---

<a name="basics"></a>
## Основы

В `CrudResource`(`ModelResource`) на страницах `indexPage`, а также `DetailPage` для отображения основных данных используется `TableBuilder`,
поэтому мы рекомендуем вам также изучить раздел документации [TableBuilder](/docs/{{version}}/components/table-builder).

<a name="order-by"></a>
## Сортировка

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Enums\SortDirection;

class PostResource extends ModelResource
{
    // Поле сортировки по умолчанию
    protected string $sortColumn = 'created_at';

    // Тип сортировки по умолчанию
    protected SortDirection $sortDirection = SortDirection::DESC;

    // ...
}
```

<a name="buttons"></a>
## Кнопки

Для добавления кнопок в таблицу используются `ActionButton` и методы `indexButtons()`, а также `detailButtons()` для детальной страницы.

> [!TIP]
> [Подробнее об ActionButton](/docs/{{version}}/components/action-button)

После основных:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\ActionButton;

protected function indexButtons(): ListOf
{
    return parent::indexButtons()
        ->add(ActionButton::make('Link', '/endpoint'));
}
```

До основных:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\ActionButton;

protected function indexButtons(): ListOf
{
    return parent::indexButtons()
        ->prepend(ActionButton::make('Link', '/endpoint'));
}
```

Убрать кнопку удаления:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\ActionButton;

protected function indexButtons(): ListOf
{
    return parent::indexButtons()
        ->except(fn(ActionButton $btn) => $btn->getName() === 'resource-delete-button');
}
```

Названия стандартных кнопкок для таблицы: 
- resource-detail-button,
- resource-edit-button,
- resource-delete-button,
- mass-delete-button.

> [!NOTE]
> Также можно глобально отключить любые действия с ресурсом (см. [активные действия](/docs/{{version}}/model-resource/index#buttons).

Очистить набор кнопок и добавить свою:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\ActionButton;

protected function indexButtons(): ListOf
{
    parent::indexButtons()
        ->empty()
        ->add(ActionButton::make('Link', '/endpoint'));
}
```

> [!NOTE]
> Такой же подход используется и для таблицы на детальной страницы, только через метод `detailButtons()`.

Для массовых действий необходимо добавить метод `bulk()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\ActionButton;

protected function indexButtons(): ListOf
{
    return parent::indexButtons()
        ->add(ActionButton::make('Link', '/endpoint')->bulk());
}
```

По умолчанию все кнопки в таблице выводятся в строку, но вы можете изменить поведение и вывести их через выпадающий список.
Для этого в ресурсе измените свойство `$indexButtonsInDropdown`:

```php
class PostResource extends ModelResource
{
    protected bool $indexButtonsInDropdown = true;

    // ...
}
```

<a name="attributes"></a>
## Атрибуты

Чтобы добавить атрибуты для `td` элемента таблицы, можно воспользоваться методом `customWrapperAttributes()` у поля, которое представляет нужную вам ячейку.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Text;

protected function indexFields(): iterable
{
    return [
        // ...
        Text::make('Title')
            ->customWrapperAttributes(['width' => '20%']);
    ];
}
```

Также есть возможность кастомизировать `tr` и `td` у таблицы с данными через ресурс.
Для этого необходимо использовать соответствующие методы `trAttributes()` и `tdAttributes()`,
которым нужно передать замыкание, возвращающее массив атрибутов для компонента таблицы.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:6]
namespace App\MoonShine\Resources;

use Closure;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Fields\Text;

class PostResource extends ModelResource
{
    // ...

    protected function tdAttributes(): Closure
    {
        return fn(?DataWrapperContract $data, int $row, int $cell) => [
            'width' => '20%'
        ];
    }

    protected function trAttributes(): Closure
    {
        return fn(?DataWrapperContract $data, int $row) => [
            'data-tr' => $row
        ];
    }
}
```

![img](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/table_class.png#light)
![img](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/table_class_dark.png#dark)

<a name="click"></a>
## Действия по клику

По умолчанию на клик по `tr` ничего не произойдет, но можно изменить поведение на переход в редактирование, выбор или переход к детальному просмотру.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Support\Enums\ClickAction;

// ClickAction::SELECT, ClickAction::DETAIL, ClickAction::EDIT

protected ?ClickAction $clickAction = ClickAction::SELECT;
```

<a name="sticky-table"></a>
## Фиксированная шапка таблицы

Свойство ресурса модели `stickyTable` позволяет зафиксировать шапку при прокрутке таблицы с большим числом элементов.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravle\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected bool $stickyTable = true;

    // ...
}
```

<a name="column-display"></a>
## Отображение колонок

Можно предоставить пользователям самостоятельно определять какие колонки отображать в таблице, с сохранением выбора.
Для этого необходимо у ресурса задать параметр `$columnSelection`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected bool $columnSelection = true;

    // ...
}
```

Если необходимо исключить поля из выбора, то воспользуйтесь методом `columnSelection()`.

```php
columnSelection(
    bool $active = true,
    bool $hideOnInit = false
)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:6]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

class PostResource extends ModelResource
{
    protected bool $columnSelection = true;

    // ...

    protected function indexFields(): iterable
    {
        return [
            ID::make()
                ->columnSelection(false),
            Text::make('Title'),
            Textarea::make('Body'),
        ];
    }
}
```

Если необходимо скрыть поле по умолчанию:

```php
->columnSelection(hideOnInit: true)
```

<a name="sticky"></a>
## Sticky ячейки

Вы можете фиксировать ячейки при больших таблицах, подойдет для колонок ID и кнопок.

Чтобы зафиксировать кнопки в таблице, переключите ресурс в режим `stickyButtons`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected bool $stickyButtons = true;

    // ...
}
```

Для фиксации колонки вызовите у поля метод `sticky()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\ID;

protected function indexFields(): iterable
{
    return [
        ID::make()->sticky(),
    ];
}
```

<a name="pagination"></a>
## Пагинация

Для изменения количества элементов на странице воспользуйтесь свойством `$itemsPerPage`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected int $itemsPerPage = 25;

    // ...
}
```

<a name="cursor-pagination"></a>
### Курсорная

При большом объеме данных наилучшим решение будет использовать курсорную пагинацию.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected bool $cursorPaginate = true;

    // ...
}
```

<a name="simple-pagination"></a>
### Упрощенная

Если вы не планируете отображать общее количество страниц, воспользуйтесь `Simple Pagination`.
Это позволит избежать дополнительных запросов на общее количество записей в базе данных.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected bool $simplePaginate = true;

    // ...
}
```

![img](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/resource_simple_paginate.png#light)
![img](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/resource_simple_paginate_dark.png#dark)

<a name="disable-pagination"></a>
### Отключение пагинации

Если вы не планируете использовать разбиение на страницы, то его можно отключить.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected bool $usePagination = false;

    // ...
}
```

<a name="async"></a>
## Асинхронный режим

В ресурсе асинхронный режим используется по умолчанию.
Такой режим дает возможность использовать пагинацию, фильтрацию и сортировку без перезагрузки страницы.
Но если вы хотите отключить асинхронный режим, то воспользуйтесь свойством `$isAsync`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected bool $isAsync = false;

    // ...
}
```

<a name="update-row"></a>
### Обновление ряда

У таблицы можно асинхронно обновить ряд, для этого необходимо вызвать событие:

```php
table-row-updated-{{componentName}}-{{row-id}}
```

- `{{componentName}}` - название компонента;
- `{{row-id}}` - ключ элемента ряда

Для добавления события можно воспользоваться классом-помощником:

```php
AlpineJs::event(JsEvent::TABLE_ROW_UPDATED, 'main-table-{row-id}')
```

- `{row-id}` - shortcode для id текущей записи модели.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:8]
namespace App\MoonShine\Resources;

use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\AlpineJs;
use MoonShine\Support\Enums\JsEvent;

class PostResource extends ModelResource
{
    // ...

    protected function indexFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Title'),
            Switcher::make('Active')
                ->updateOnPreview(
                    events: [AlpineJs::event(JsEvent::TABLE_ROW_UPDATED, 'index-table-{row-id}')]
                )
        ];
    }
}
```

Также доступен метод `withUpdateRow()`, который помогает упростить назначение событий.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:6]
namespace App\MoonShine\Resources;

use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    protected function indexFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Title'),
            Switcher::make('Active')
                ->withUpdateRow($this->getListComponentName())
        ];
    }
}
```

<a name="lazy"></a>
## Lazy режим

Если необходимо отобразить страницу без ожидания загрузки данных, а затем отправить запрос для получения данных таблицы, используйте режим *Lazy*.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected bool $isLazy = true;
}
```

<a name="modifiers"></a>
## Модификаторы

<a name="components"></a>
### Компоненты

Вы можете полностью заменить или модифицировать `TableBuilder` ресурса для индексной и детальной страницы.
Для этого воспользуйтесь методами `modifyListComponent()` или `modifyDetailComponent()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\ComponentContract;

public function modifyListComponent(ComponentContract $component): ComponentContract
{
    return parent::modifyListComponent($component)->customAttributes([
        'data-my-attr' => 'value'
    ]);
}
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Contracts\UI\ComponentContract;

public function modifyDetailComponent(ComponentContract $component): ComponentContract
{
    return parent::modifyDetailComponent($component)->customAttributes([
        'data-my-attr' => 'value'
    ]);
}
```

<a name="thead-tbody-tfoot"></a>
### Элементы thead, tbody, tfoot

Если вам недостаточно просто автоматически выводить поля в `thead`, `tbody` и `tfoot`,
то вы можете переопределить или дополнить эту логику на основе методов ресурса `thead()`, `tbody()`, `tfoot()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:5]
use Closure;
use MoonShine\Contracts\UI\Collection\TableRowsContract;
use MoonShine\Contracts\UI\TableRowContract;
use MoonShine\UI\Collections\TableCells;
use MoonShine\UI\Collections\TableRows;

protected function thead(): null|TableRowsContract|Closure
{
    return static fn(TableRowContract $default) => TableRows::make([$default])->pushRow(
        TableCells::make()->pushCell(
            'td content'
        )
    );
}

protected function tbody(): null|TableRowsContract|Closure
{
    return static fn(TableRowsContract $default) => $default->pushRow(
        TableCells::make()->pushCell(
            'td content'
        )
    );
}

protected function tfoot(): null|TableRowsContract|Closure
{
    return static fn(?TableRowContract $default) => TableRows::make([$default])->pushRow(
        TableCells::make()->pushCell(
            'td content'
        )
    );
}
```

#### Пример добавления строки в tfoot
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:7]
use Closure;
use MoonShine\Contracts\UI\Collection\TableRowsContract;
use MoonShine\Contracts\UI\TableRowContract;
use MoonShine\UI\Collections\TableCells;
use MoonShine\UI\Collections\TableRows;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Components\Table\TableRow;

protected function tfoot(): null|TableRowsContract|Closure
{
    return static function(?TableRowContract $default, TableBuilder $table) {
        $cells = TableCells::make();

        $cells->pushCell('Balance:');
        $cells->pushCell('$1000');

        return TableRows::make([TableRow::make($cells), $default]);
    };
}
```
