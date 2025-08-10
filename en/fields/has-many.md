# HasMany

- [Basics](#basics)
- [Fields](#fields)
- [Creating a relationship object](#creatable)
- [Record count](#limit)
- [Only link](#only-link)
- [Parent ID](#parent-id)
- [Edit button](#change-edit-button)
- [Modal window](#without-modals)
- [Modification](#modify)
- [Display](#view)
- [Active Actions](#active-actions)
- [Adding ActionButtons](#add-action-buttons)
- [Advanced usage](#advanced)

---

<a name="basics"></a>
## Basics

The `HasMany` field is designed to work with the same-name relationship in **Laravel** and includes all [Basic methods](/docs/{{version}}/fields/basic-methods).

```php
HasMany::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null,
    ModelResource|string|null $resource = null,
)
```

- `$label` - label, header of the field,
- `$relationName` - name of the relation,
- `$resource` - `ModelResource` that the relation points to.

> [!WARNING]
> The `$formatted` parameter is not used in the `HasMany` field!

> [!WARNING]
> Having a `ModelResource` that the relationship refers to is mandatory.
> The resource must also be [registered](/docs/{{version}}/model-resource/index#declaring-in-the-system) in the `MoonShineServiceProvider` service provider in the `$core->resources()` method.
> Otherwise, there will be a 500 error.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make(
    'Comments',
    'comments',
    resource: CommentResource::class
)
```

> [!WARNING]
> The BelongsTo field, referring to the parent record, is required.

![has_many](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/has_many.png#light)
![has_many_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/has_many_dark.png#dark)

You can omit the `$resource` if the `ModelResource` matches the name of the relation.

```php
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', 'comments')
```

If you do not specify `$relationName`, then the name of the relation will be determined automatically based on `$label` (following camelCase rules).

```php
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments')
```

By default, the field is displayed outside the main form.
If you want to change this behavior and display it inside the main form, use the `disableOutside()` method.

```php
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments')->disableOutside()
```

<a name="fields"></a>
## Fields

The `fields()` method allows you to set the fields that will be displayed in the *preview*.

```php
fields(FieldsContract|Closure|iterable $fields)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Fields\Text;

HasMany::make('Comments', resource: CommentResource::class)
    ->fields([
        BelongsTo::make('User'),
        Text::make('Text'),
    ])
```

![has_many_fields](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/has_many_fields.png#light)
![has_many_fields_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/has_many_fields_dark.png#dark)

<a name="creatable"></a>
## Creating a relationship object

The `creatable()` method allows you to create a new relationship object through a modal window.

```php
creatable(
    Closure|bool|null $condition = null,
    ?ActionButtonContract $button = null,
)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', resource: CommentResource::class)
    ->creatable()
```

> [!WARNING]
> The BelongsTo field, referring to the parent record, is required.

![has_many_creatable](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/has_many_creatable.png#light)
![has_many_creatable_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/has_many_creatable_dark.png#dark)

You can customize the *create* button by passing the button parameter in the method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\ActionButton;

HasMany::make('Comments', resource: CommentResource::class)
    ->creatable(
        button: ActionButton::make('Custom button', '')
    )
```

<a name="limit"></a>
## Record count

The `limit()` method allows you to limit the number of records displayed in the *preview*.

```php
limit(int $limit)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', resource: CommentResource::class)
    ->limit(1)
```

<a name="only-link"></a>
## Only link

The `relatedLink()` method allows you to display the relationship as a link with the count of elements.
The link will lead to the IndexPage of the child resource from the `HasMany` relationship, only showing those data elements.

```php
relatedLink(?string $linkRelation = null, Closure|bool $condition = null)
```

You can pass optional parameters to the method:

- `linkRelation` - link to the relation,
- `condition` - closure or boolean value responsible for displaying the relation as a link.

> [!NOTE]
> Don’t forget to add the relation to the `$with` property of the resource.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', resource: CommentResource::class)
    ->relatedLink()
```
![has_many_link](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/has_many_link.png#light)
![has_many_link_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/has_many_link_dark.png#dark)

The `linkRelation` parameter allows you to create a link to the relation with parent resource binding.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', resource: CommentResource::class)
    ->relatedLink('comment')
```

The `condition` parameter through a closure allows you to change the display method based on conditions.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Fields\Field;

HasMany::make('Comments', resource: CommentResource::class)
    ->relatedLink(condition: function (int $count, Field $field): bool {
        return $count > 10;
    })
```

<a name="parent-id"></a>
## Parent ID

If the relation has a resource, and you want to get the ID of the parent element, you can use the `ResourceWithParent` trait.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Traits\Resource\ResourceWithParent;

class PostImageResource extends ModelResource
{
    use ResourceWithParent;

    // ...
}
```

When using the trait, you need to define the methods:

```php
protected function getParentResourceClassName(): string
{
    return PostResource::class;
}

protected function getParentRelationName(): string
{
    return 'post';
}
```

To get the parent ID, use the `getParentId()` method.

```php
$this->getParentId();
```

> [!TIP]
> Recipe: [saving files](/docs/{{version}}/recipes/hasmany-parent-id) of `HasMany` relations in the directory with the parent ID.

<a name="change-edit-button"></a>
## Edit button

The `changeEditButton()` method allows you to completely override the edit button.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\ActionButton;

HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->changeEditButton(
        ActionButton::make(
            'Edit',
            fn(Comment $comment) => app(CommentResource::class)->formPageUrl($comment)
        )
    )
```

<a name="without-modals"></a>
## Modal window

By default, creating and editing a record in the `HasMany` field occurs in a modal window; the `withoutModals()` method allows you to disable this behavior.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->withoutModals()
```

<a name="modify"></a>
## Modification

The `HasMany` field has methods that can be used to modify buttons, change the `TableBuilder` for preview and form, as well as change the *relatedLink* button.

### searchable()

By default, a search field is available on the form page for the `HasMany` field.
To disable it, you can use the `searchable()` method.

```php
public function searchable(Closure|bool|null $condition = null): static
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->searchable(false) // disables the search field
```

### modifyItemButtons()

The `modifyItemButtons()` method allows you to change the view, edit, delete, and mass delete buttons.

```php
/**
 * @param  Closure(ActionButtonContract $detail, ActionButtonContract $edit, ActionButtonContract $delete, ActionButtonContract $massDelete, static $ctx): array  $callback
 */
modifyItemButtons(Closure $callback)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\ActionButton;

HasMany::make('Comments', resource: CommentResource::class)
    ->modifyItemButtons(
        fn(ActionButton $detail, $edit, $delete, $massDelete, HasMany $ctx) => [$detail]
    )
```

### modifyRelatedLink()

The `modifyRelatedLink()` method allows you to change the *relatedLink* button.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\ActionButton;

HasMany::make('Comments', resource: CommentResource::class)
    ->relatedLink()
    ->modifyRelatedLink(
        fn(ActionButton $button, bool $preview) => $button
            ->when($preview, fn(ActionButton $btn) => $btn->primary())
            ->unless($preview, fn(ActionButton $btn) => $btn->secondary())
    )
```

### modifyCreateButton() / modifyEditButton()

The `modifyCreateButton()` and `modifyEditButton()` methods allow you to change the create and edit buttons.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\ActionButton;

HasMany::make('Comments', resource: CommentResource::class)
    ->modifyCreateButton(
        fn(ActionButton $button) => $button->setLabel('Custom create button')
    )
    ->modifyEditButton(
        fn(ActionButton $button) => $button->setLabel('Custom edit button')
    )
    ->creatable(true)
```

### modifyTable()

The `modifyTable()` method allows you to change the `TableBuilder` for preview and form.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\Table\TableBuilder;

HasMany::make('Comments', resource: CommentResource::class)
    ->modifyTable(
        fn(TableBuilder $table, bool $preview) => $table
            ->when($preview, fn(TableBuilder $tbl) => $tbl->customAttributes(['style' => 'background: blue']))
            ->unless($preview, fn(TableBuilder $tbl) => $tbl->customAttributes(['style' => 'background: green']))
    )
```

### Redirect after modification

The `redirectAfter()` method allows for redirection after saving/adding/deleting.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', resource: CommentResource::class)
    ->redirectAfter(fn(int $parentId) => route('home'))
```

### Modify QueryBuilder

The `modifyBuilder()` method allows you to modify the query through *QueryBuilder*.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use Illuminate\Database\Eloquent\Relations\Relation;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', resource: CommentResource::class)
    ->modifyBuilder(fn(Relation $query, HasMany $ctx) => $query)
```

<a name="view"></a>
## Display

### Display inside Tabs

By default, relationship fields in **MoonShine** are displayed at the bottom, separately from the form, and follow one after another. To change the display of the field and add it to `Tabs`, you can use the `tabMode()` method.

```php
tabMode(Closure|bool|null $condition = null)
```

In the following example, a [Tabs](/docs/{{version}}/components/tabs) component with two tabs, Comments and Covers, will be created.

```php
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->tabMode(),
HasMany::make('Covers', 'covers', resource: CoverResource::class)
    ->tabMode()
```

> [!NOTE]
> tabMode will not work when using the `disableOutside()` method

### Display inside a modal window

To display a HasMany field in a modal window that is triggered by a button, you can use the `modalMode()` method.

```php
public function modalMode(
    Closure|bool|null $condition = null,
    ?Closure $modifyButton = null,
    ?Closure $modifyModal = null
)
```

In this example, instead of a table, there will now be an [ActionButton](/docs/{{version}}/components/action-button) that triggers a [Modal](/docs/{{version}}/components/modal).

```php
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->modalMode(),
```

To modify the `ActionButton` and `Modal`, you can use the method parameters `$modifyButton` and `$modifyModal`, into which you can pass a closure.

```php
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->modalMode(
        modifyButton: function (ActionButtonContract $button, HasMany $ctx) {
            $button->warning();
            return $button;
        },
        modifyModal: function (Modal $modal, ActionButtonContract $ctx) {
            $modal->autoClose(false);
            return $modal;
        }
    )
```

<a name="active-actions"></a>
## Active Actions

It is possible to quickly turn enable/disable certain actions within the scope of `HasMany`.

The `activeActions()` method explicitly sets the list of available actions.

```php
HasMany::make('Comments')
    ->activeActions(
        Action::VIEW,
        Action::UPDATE,
    )
```

The `withoutActions()` method allows you to exclude individual actions.

```php
HasMany::make('Comments')
    ->withoutActions(
        Action::VIEW
    )
```

> [!WARNING]
> The resource's Policies and `activeActions` take precedence. If the resource denies access, the `activeActions` field will not grant access.

<a name="add-action-buttons"></a>
## Adding ActionButtons

### indexButtons()

The `indexButtons()` method allows you to add additional `ActionButtons` for working with `HasMany` elements.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->indexButtons([
        ActionButton::make('Custom button')
    ])
```

### formButtons()

The `formButtons()` method allows you to add additional `ActionButtons` inside the form when creating or editing a `HasMany` element.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\ActionButton;

HasMany::make('Comments', 'comments', resource: CommentResource::class)
    ->formButtons([
        ActionButton::make('Custom form button')
    ])
```

<a name="advanced"></a>
## Advanced usage

### Location of the field

The field is used only within *CRUD* pages, as it retrieves the resource and page from the *URL*.
However, you can also use it on other pages by specifying its location with the `nowOn()` method.

```php
HasMany::make('Comments', resource: CommentResource::class)
    ->creatable()
    ->nowOn(page: $resource->getFormPage(), resource: $resource, params: ['resourceItem' => $item->getKey()])
    ->fillCast($item, new ModelCaster(Article::class)),
```

### Relation through RelationRepeater field
The `HasMany` field is displayed outside the main resource form by default.
If you need to display the relation fields inside the main form, you can use the `RelationRepeater` field.

> [!NOTE]
> For more detailed information, refer to the [RelationRepeater field](/docs/{{version}}/fields/relation-repeater).

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Text;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;

RelationRepeater::make('Characteristics', 'characteristics')
    ->fields([
        ID::make(),
        Text::make('Name', 'name'),
        Text::make('Value', 'value'),
    ])
```

### Relation through Template field

Using the `Template` field, you can build a field for `HasMany` relationships using a fluent interface during declaration.

> [!NOTE]
> For more detailed information, refer to the [Template field](/docs/{{version}}/fields/template).
