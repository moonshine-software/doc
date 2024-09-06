<x-page title="Table" :sectionMenu="[
    'Sections' => [
        ['url' => '#properties', 'label' => 'Properties'],
        ['url' => '#buttons', 'label' => 'Buttons'],
        ['url' => '#attributes', 'label' => 'Attributes'],
        ['url' => '#click', 'label' => 'Click Actions'],
        ['url' => '#sticky-table', 'label' => 'Sticky table header'],
        ['url' => '#simple-pagination', 'label' => 'Simple pagination'],
        ['url' => '#disable-pagination', 'label' => 'Disabling pagination'],
        ['url' => '#async', 'label' => 'Asynchronous mode'],
        ['url' => '#update-row', 'label' => 'Updating a row'],
        ['url' => '#column-display', 'label' => 'Column display'],
        ['url' => '#modify', 'label' => 'Modify'],
    ]
]">

<x-sub-title id="properties">Properties</x-sub-title>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $sortColumn = ''; // Default sort field [tl! focus]

    protected string $sortDirection = 'DESC'; // Default sort type [tl! focus]

    protected int $itemsPerPage = 25; // Number of elements per page [tl! focus]

    //...
}
</x-code>

<x-sub-title id="buttons">Buttons</x-sub-title>

<x-p>
    To add buttons to the table, use ActionButton and the <code>indexButtons</code> or <code>buttons</code> methods in the resource
</x-p>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    <x-link link="{{ to_page('action_button') }}">More details ActionButton</x-link>
</x-moonshine::alert>

<x-code>
public function indexButtons(): array
{
    return [
        ActionButton::make('Link', '/endpoint'),
    ];
}
</x-code>

<x-moonshine::alert type="primary" icon="heroicons.outline.book-open">
    An example of creating custom buttons for the index table in the section
    <x-link link="{{ to_page('recipes') }}#custom-buttons">Recipes</x-link>
</x-moonshine::alert>

<x-p>
    For bulk actions you need to add the <code>bulk</code> method
</x-p>

<x-code>
public function indexButtons(): array
{
    return [
        ActionButton::make('Link', '/endpoint')->bulk(),
    ];
}
</x-code>

<x-p>
    You can also use the <code>buttons</code> method, but in this case the buttons will be on all other pages of the resource
</x-p>

<x-code>
public function buttons(): array
{
    return [
        ActionButton::make('Link', '/endpoint'),
    ];
}
</x-code>

<x-sub-title id="attributes">Attributes</x-sub-title>

<x-p>
    Through model resources, it is possible to customize the data table <code>tr</code> and <code>td</code>.<br />
    To do this, you must use the appropriate <code>trAttributes()</code> and <code>tdAttributes()</code> methods,
    which need to pass a closure that returns attributes for the table component.
</x-p>

<x-code language="php">
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

    public function trAttributes(): Closure // [tl! focus:start]
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
    } // [tl! focus:end]

    public function tdAttributes(): Closure // [tl! focus:start]
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
    } // [tl! focus:end]

    //...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/table_class.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/table_class_dark.png') }}"></x-image>

<x-sub-title id="click">Click Actions</x-sub-title>

<x-p>
    By default, nothing will happen when clicking tr, but you can change the behavior to
    go to edit, select or go to detailed view
</x-p>

<x-code>
    // Resource property
    // ClickAction::SELECT, ClickAction::DETAIL, ClickAction::EDIT

    protected ?ClickAction $clickAction = ClickAction::SELECT;
</x-code>

<x-sub-title id="sticky-table">Sticky table header</x-sub-title>

<x-p>
    The <code>stickyTable</code> model resource property allows you to fix the header
    when scrolling a table with a large number of elements.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $stickyTable = true; // [tl! focus]

    // ...
}
</x-code>

<x-sub-title id="simple-pagination">Simple pagination</x-sub-title>

<x-p>
    If you don't plan to display the total number of pages, use <code>Simple Pagination</code>.
    This will avoid additional queries for the total number of records in the database.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $simplePaginate = true; // [tl! focus]

    // ...
}
</x-code>

<x-image theme="light" src="{{ asset('screenshots/resource_simple_paginate.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/resource_simple_paginate_dark.png') }}"></x-image>

<x-sub-title id="disable-pagination">Disabling pagination</x-sub-title>

<x-p>
    If you don't plan to use pagination, you can turn it off.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $usePagination = false; // [tl! focus]

    // ...
}
</x-code>

<x-sub-title id="async">Asynchronous mode</x-sub-title>

<x-p>
    Switch mode without reboot for filtering, sorting and pagination
</x-p>

<x-code>
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $isAsync = true; // [tl! focus]

    // ...
}
</x-code>

<x-sub-title id="update-row">Updating a row</x-sub-title>

<x-p>
    You can update a row of a table asynchronously; to do this, you need to trigger the event:
</x-p>

<x-code>
table-row-updated-@{{componentName}}-@{{row-key}}
</x-code>

<x-ul>
    <li><code>@{{componentName}}</code> - name of the component;</li>
    <li><code>@{{row-key}}</code> - row key.</li>
</x-ul>

<x-p>
    To add an event, you can use the helper class:
</x-p>

<x-code>
    AlpineJs::event(JsEvent::TABLE_ROW_UPDATED, 'main-table-{row-id}')
</x-code>

<x-ul>
    <li><code>{row-id}</code> - shortcode for the id of the current model record.</li>
</x-ul>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    The presence of the ID field and asynchronous mode are required.
</x-moonshine::alert>

<x-code>
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
                    events: [AlpineJs::event(JsEvent::TABLE_ROW_UPDATED, 'index-table-{row-id}')] // [tl! focus]
                )
        ];
    }

    //...
}
</x-code>

<x-p>
    The <code>withUpdateRow()</code> method is also available to help simplify event assignment:
</x-p>

<x-code>
TableBuilder::make()
    ->fields([
        ID::make()->sortable(),
        Text::make('Title'),
        Textarea::make('Body'),
        Switcher::make('Active')
            ->withUpdateRow('main-table') // [tl! focus]
    ])
    ->items($this->fetch())
    ->name('main-table')
    ->async(),
</x-code>

<x-sub-title id="column-display">Column display</x-sub-title>

<x-p>
    You can let users decide which columns to display in the table,
    saving the choice. To do this, you need to set the resource parameter <code>$columnSelection</code>.
</x-p>

<x-code language="php">
namespace App\MoonShine\Resources;

use App\Models\Post;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected bool $columnSelection = true; // [tl! focus]

    //...
}
</x-code>

<x-p>
    If you need to exclude fields from selection, use the <code>columnSelection()</code> method.
</x-p>

<x-code language="php">
public function columnSelection(bool $active = true)
</x-code>

<x-code>
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
                ->columnSelection(false), // [tl! focus]
            Text::make('Title'),
            Textarea::make('Body'),
        ];
    }

    //...
}
</x-code>

<x-sub-title id="modify">Modify</x-sub-title>

<x-p>
    You can replace <code>thead</code> or <code>tbody</code> or <code>tfoot</code>,
    and also add elements to the table in <code>tbody</code> before and after the first row.
</x-p>

<x-moonshine::divider label="thead()" />

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\Fields\Fields;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    public function thead(): ?Closure
    {
        return static fn(Fields $headFields): string => '<tr><th>Title</th></tr>';
    } // [tl! focus:-3]
}
</x-code>

<x-moonshine::divider label="tbody()" />

<x-code language="php">
namespace App\MoonShine\Resources;

use Illuminate\Support\Collection;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    public function tbody(): ?Closure
    {
        return static fn(Collection $rows): string => '<tr><td>Content</td></tr>';
    } // [tl! focus:-3]
}
</x-code>

<x-moonshine::divider label="tfoot()" />

<x-code language="php">
namespace App\MoonShine\Resources;

use MoonShine\ActionButtons\ActionButtons;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    public function tfoot(): ?Closure
    {
        return static fn(ActionButtons $bulkButtons): string => '<tr><td>Footer</td></tr>';
    } // [tl! focus:-3]
}
</x-code>

<x-moonshine::divider label="tbodyBefore()" />

<x-code language="php">
namespace App\MoonShine\Resources;

use Illuminate\Support\Collection;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    public function tbodyBefore(): ?Closure
    {
        return static fn(Collection $rows): string => '<tr><td>Before</td></tr>';
    } // [tl! focus:-3]
}
</x-code>

<x-moonshine::divider label="tbodyAfter()" />

<x-code language="php">
namespace App\MoonShine\Resources;

use Illuminate\Support\Collection;
use MoonShine\Resources\ModelResource;

class PostResource extends ModelResource
{
    // ...

    public function tbodyAfter(): ?Closure
    {
        return static fn(Collection $rows): string => '<tr><td>After</td></tr>';
    } // [tl! focus:-3]
}
</x-code>

</x-page>
