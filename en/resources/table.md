https://moonshine-laravel.com/docs/resource/models-resources/resources-table?change-moonshine-locale=en

------
# Table

  - [Properties](#properties)
  - [Buttons](#buttons)
  - [Attributes](#attributes)
  - [Click Actions](#click)
  - [Sticky table header](#sticky-table)
  - [Simple pagination](#simple-pagination)
  - [Disabling pagination](#disable-pagination)
  - [Asynchronous mode](#async)
  - [Updating a row](#update-row)
  - [Column display](#column-display)
  - [Modify](#modify)

<a name="properties"></a>
### Properties

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $sortColumn = ''; // Default sort field

    protected string $sortDirection = 'DESC'; // Default sort type

    protected int $itemsPerPage = 25; // Number of elements per page

    //...
}
```


<a name="buttons"></a>
### Buttons

To add buttons to the table, use `ActionButton` and the `indexButtons` or `buttons` methods in the resource

> [!TIP]
> [More details ActionButton](https://moonshine-laravel.com/docs/resource/actionbutton/action_button)

```php
public function indexButtons(): array
{
   return [
       ActionButton::make('Link', '/endpoint'),
   ];
}
```

> [!TIP]
> An example of creating custom buttons for the index table in the section [Recipes](https://moonshine-laravel.com/docs/resource/recipes/recipes#custom-buttons)

For bulk actions you need to add the `bulk` method

```php
public function indexButtons(): array
{
    return [
        ActionButton::make('Link', '/endpoint')->bulk(),
    ];
}
```

You can also use the `buttons` method, but in this case the buttons will be on all other pages of the resource

```php
public function buttons(): array
{
    return [
        ActionButton::make('Link', '/endpoint'),
    ];
}
```

<a name="attributes"></a>
### Attributes

Through model resources, it is possible to customize the data table `tr` and `td`.
To do this, you must use the appropriate `trAttributes()` and `tdAttributes()` methods, which need to pass a closure that returns attributes for the table component.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use Closure;
use Illuminate\View\ComponentAttributeBag;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    //...

    public function trAttributes(): Closure
    {
        return function (
            Model $item,
            int $row,
            ComponentAttributeBag $attr
        ): ComponentAttributeBag {
            if ($item->id === 1 | $row === 2) {
                $attr->setAttributes([
                    'class' => 'bgc-green'
                ]);
            }

            return $attr;
        };
    }

    public function tdAttributes(): Closure
    {
        return function (
            Model $item,
            int $row,
            int $cell,
            ComponentAttributeBag $attr = null
        ): ComponentAttributeBag {
            if ($cell === 6) {
                $attr->setAttributes([
                    'class' => 'bgc-red'
                ]);
            }

            return $attr;
        };
    }

    //...
}

![img](https://moonshine-laravel.com/screenshots/table_class_dark.png)

<a name="click"></a>
### Click Actions

By default, nothing will happen when clicking tr, but you can change the behavior to go to edit, select or go to detailed view

```php
// Resource property
    // ClickAction::SELECT, ClickAction::DETAIL, ClickAction::EDIT

    protected ?ClickAction $clickAction = ClickAction::SELECT;
```

<a name="sticky-table"></a>
### Sticky table header

The `stickyTable` model resource property allows you to fix the header when scrolling a table with a large number of elements.

```php
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $stickyTable = true;

    // ...
}
```

<a name="simple-pagination"></a>
### Simple pagination

If you don't plan to display the total number of pages, use `Simple Pagination`. This will avoid additional queries for the total number of records in the database.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $simplePaginate = true;

    // ...
}
```

![img] (https://moonshine-laravel.com/screenshots/resource_simple_paginate_dark.png)

<a name="disable-pagination"></a>
### Disabling pagination

If you don't plan to use pagination, you can turn it off.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $usePagination = false;

    // ...
}
```

<a name="async"></a>
### Asynchronous mode

Switching mode without reboot for filtering, sorting, and pagination.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $isAsync = true;

    // ...
}
```

<a name="update-row"></a>
### Updating a row

You can update a row of a table asynchronously; to do this, you need to trigger the event:

```php
table-row-updated-{{componentName}}-{{row-key}}
```
-`{{componentName}}` - name of the component;
-`{{row-key}}` - row key.

To add an event, you can use the helper class:

```php
AlpineJs::event(JsEvent::TABLE_ROW_UPDATED, 'main-table-{row-id}')
```

-`{row-id}` - shortcode for the id of the current model record.

> [!WARNING] 
> The presence of the ID field and asynchronous mode are required.

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Enums\JsEvent;
use MoonShine\Fields\ID;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;
use MoonShine\Support\AlpineJs;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $isAsync = true;

    //...

    public function fields(): array
    {
        return [
            ID::make(),
            Text::make('Title'),
            Textarea::make('Body'),
            Switcher::make('Active')
                ->updateOnPreview(
                    events: [AlpineJs::event(JsEvent::TABLE_ROW_UPDATED, 'index-table-{row-id}')]
                )
        ];
    }

    //...
}
```

The `withUpdateRow()` method is also available to help simplify event assignment:

```php
TableBuilder::make()
    ->fields([
        ID::make()->sortable(),
        Text::make('Title'),
        Textarea::make('Body'),
        Switcher::make('Active')
            ->withUpdateRow('main-table')
    ])
    ->items($this->fetch())
    ->name('main-table')
    ->async(),
```

<a name="column-display"></a>
### Column display

You can let users decide which columns to display in the table, saving the choice. To do this, you need to set the resource parameter `$columnSelection`.

```
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $columnSelection = true;

    //...
}
```

If you need to exclude fields from selection, use the `columnSelection()` method.

```php
public function columnSelection(bool $active = true)
```

```php
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $columnSelection = true;

    //...

    public function fields(): array
    {
        return [
            ID::make()
                ->columnSelection(false),
            Text::make('Title'),
            Textarea::make('Body'),
        ];
    }

    //...
}
```

<a name="modify"></a>
### Modify

You can replace `thead` or `tbody` or `tfoot`, and also add elements to the table in `tbody` before and after the first row.

#### thead()

```php
namespace App\MoonShine\Resources;

use MoonShine\Fields\Fields;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    public function thead(): ?Closure
    {
        return static fn(Fields $headFields): string => '<tr><th>Title</th></tr>';
    }
}
```

#### tbody()

```php
namespace App\MoonShine\Resources;

use Illuminate\Support\Collection;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    public function tbody(): ?Closure
    {
        return static fn(Collection $rows): string => '<tr><td>Content</td></tr>';
    }
}
```

#### tfoot()

```php
namespace App\MoonShine\Resources;

use MoonShine\ActionButtons\ActionButtons;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    public function tfoot(): ?Closure
    {
        return static fn(ActionButtons $bulkButtons): string => '<tr><td>Footer</td></tr>';
    }
}
```

#### tbodyBefore()

```php
namespace App\MoonShine\Resources;

use Illuminate\Support\Collection;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    public function tbodyBefore(): ?Closure
    {
        return static fn(Collection $rows): string => '<tr><td>Before</td></tr>';
    }
}
```

#### tbodyAfter()

```php
namespace App\MoonShine\Resources;

use Illuminate\Support\Collection;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    public function tbodyAfter(): ?Closure
    {
        return static fn(Collection $rows): string => '<tr><td>After</td></tr>';
    }
}
```

