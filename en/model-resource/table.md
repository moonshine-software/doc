---
video: https://youtu.be/5o8qSf94Bf0?si=9dLj_SiXA1-w6hFo&t=1183
---

# Tables

- [Basics](#basics)
- [Sorting](#order-by)
- [Buttons](#buttons)
- [Attributes](#attributes)
- [Click Actions](#click)
- [Sticky Header](#sticky-table)
- [Column Display](#column-display)
- [Sticky](#sticky)
- [Pagination](#pagination)
  - [Cursor](#simple-pagination)
  - [Simple](#simple-pagination)
  - [Disable Pagination](#disable-pagination)
- [Query parameters prefix](#query-params-prefix)
- [Async Mode](#async)
  - [Updating a row](#update-row)
  - [Lazy](#lazy)
- [Modifiers](#modifiers)
  - [Components](#components)
  - [Elements thead, tbody, tfoot](#thead-tbody-tfoot)

---

<a name="basics"></a>
## Basics

In `CrudResource` (`ModelResource`) on the `indexPage` as well as on the `DetailPage`, `TableBuilder` is used to display the main data,
so we recommend you also study the documentation section [TableBuilder](/docs/{{version}}/components/table-builder).

<a name="order-by"></a>
## Sorting

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
namespace App\MoonShine\Resources;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Enums\SortDirection;

class PostResource extends ModelResource
{
    // Default sort field
    protected string $sortColumn = 'created_at';

    // Default sort type
    protected SortDirection $sortDirection = SortDirection::DESC;

    // ...
}
```

<a name="buttons"></a>
## Buttons

To add buttons to the table, you can use `ActionButton` and the methods `indexButtons()`, as well as `detailButtons()` for the detail page.

> [!TIP]
> [More details about ActionButton](/docs/{{version}}/components/action-button).

After the main buttons:

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

Before the main buttons:

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

Remove the delete button:

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

Standard button names for the index view rows:
- resource-detail-button,
- resource-edit-button,
- resource-delete-button,
- mass-delete-button.

> [!NOTE]
> You can also globally disable any actions with the resource (see [active actions](/docs/{{version}}/model-resource/index#active-actions).

Clear the button set and add your own:

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
> The same approach is used for the table on the detail page, only through the method `detailButtons()`.

For bulk actions, you need to add the `bulk()` method.

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

By default, all buttons in the table are displayed in a line, but you can change the behavior and display them through a drop-down list.
To do this, change the `$indexButtonsInDropdown` property in the resource:

```php
class PostResource extends ModelResource
{
    protected bool $indexButtonsInDropdown = true;

    // ...
}
```

<a name="attributes"></a>
## Attributes

To add attributes for the `td` element of the table, you can use the `customWrapperAttributes()` method on the field that represents the cell you need.

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

You can also customize `tr` and `td` for the table with data through the resource.
To do this, you need to use the corresponding methods `trAttributes()` and `tdAttributes()`,
to which you need to pass a closure that returns an array of attributes for the table component.

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

![img](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/table_class.png#light)
![img](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/table_class_dark.png#dark)

<a name="click"></a>
## Click Actions

By default, clicking on `tr` does nothing, but you can change the behavior to navigate to editing, selection, or to the detailed view.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Support\Enums\ClickAction;

// ClickAction::SELECT, ClickAction::DETAIL, ClickAction::EDIT

protected ?ClickAction $clickAction = ClickAction::SELECT;
```

<a name="sticky-table"></a>
## Sticky Header

The model resource property `stickyTable` allows you to fix the header when scrolling a table with a large number of elements.

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
## Column Display

You can allow users to independently determine which columns to display in the table while retaining their selection.
To do this, you need to set the parameter `$columnSelection` for the resource.

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

If you need to exclude fields from the selection, use the `columnSelection()` method.

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

If you need to hide the default field:

```php
->columnSelection(hideOnInit: true)
```

<a name="sticky"></a>
## Sticky columns

You can freeze cells in large tables, suitable for ID columns and buttons.

To fix buttons in the table, switch the resource to `stickyButtons` mode.

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

To fix a column, call the `sticky()` method on the Field.

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
## Pagination

To change the number of items per page, use the property `$itemsPerPage`.

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
### Cursor

When dealing with a large volume of data, the best solution is to use cursor pagination.

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
### Simple

If you do not plan to display the total number of pages, use `Simple Pagination`.
This avoids additional queries for the total number of records in the database.

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

![img](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_simple_paginate.png#light)
![img](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/resource_simple_paginate_dark.png#dark)

<a name="disable-pagination"></a>
### Disable Pagination

If you do not plan to use pagination, it can be disabled.

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

<a name="query-params-prefix"></a>
## Query parameters prefix

If a page contains more than one `TableBuilder` components (for example, the main one from a resource and an additional table with other data), their query parameters may overlap. To avoid conflicts, set your resource's own prefix for pagination, filters, quick filters (tags), and sorting options.

```php
class PostResource extends ModelResource
{
    protected string $queryParamPrefix = 'posts_';
}
```

<a name="async"></a>
## Async Mode

In the resource, async mode is used by default.
This mode allows for pagination, filtering, and sorting without page reloads.
However, if you want to disable async mode, you can use the property `$isAsync`.

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
### Updating a row

You can asynchronously update a row in the table by triggering the event:

```
table-row-updated:{{componentName}}
```

- `{{componentName}}` - component name.

To add an event, you can use the helper class:

```php
AlpineJs::event(
    JsEvent::TABLE_ROW_UPDATED,
    'main-table',
    ListRowEventParams::make(1)
)
```

```php
public function softDelete(MoonShineRequest $request): JsonResponse
{
    $item = $request->getResource()->getItem();
    $item->delete();

    return JsonResponse::make()
        ->events([
            AlpineJs::event(
                JsEvent::TABLE_ROW_UPDATED,
                $this->getListComponentName(),
                ListRowEventParams::make($item->getKey())
            )
        ])
        ->toast('Success');
}
```

The `withUpdateRow()` method is also available, which helps simplify the assignment of events.

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
## Lazy mode

If you want to display a page without waiting for data to load, and then send a query to get the table data, use *Lazy* mode.

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
## Modifiers

<a name="components"></a>
### Components

You can completely replace or modify the resource's `TableBuilder` for both the index and detail pages.
Use the `modifyListComponent()` or `modifyDetailComponent()` methods for this.

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
### Elements thead, tbody, tfoot

If it is not enough to just automatically output fields in `thead`, `tbody`, and `tfoot`,
you can override or extend this logic based on the resource methods `thead()`, `tbody()`, `tfoot()`.

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

#### Example of adding a row in tfoot
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

> [!TIP]
> You can use a list component outside a resource, but you must understand what it is.
> `app(MoonShineUserResource::class)->getIndexPage()->getListComponent(withoutFragment: false)`
