# HasOne

- [Basics](#basics)
- [Fields](#fields)
- [Parent ID](#parent-id)
- [Modification](#modify)
- [Display](#view)

---

<a name="basics"></a>
## Basics

The `HasOne` field is designed to work with the same-name relationship in **Laravel** and includes all [Basic methods](/docs/{{version}}/fields/basic-methods).

```php
HasOne::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null,
    ModelResource|string|null $resource = null,
)
```

- `$label` - the label, title of the field,
- `$relationName` - the name of the relationship,
- `$resource` - `ModelResource` that the relationship refers to.

> [!WARNING]
> The `$formatted` parameter is not used in the `HasOne` field!

> [!WARNING]
> Having a `ModelResource` that the relationship refers to is mandatory.
> The resource must also be [registered](/docs/{{version}}/model-resource/index#declaring-in-the-system)
> in the `MoonShineServiceProvider` service provider in the `$core->resources()` method.
> Otherwise, there will be a 500 error.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\ProfileResource;
use MoonShine\Laravel\Fields\Relationships\HasOne;

HasOne::make(
    'Profile',
    'profile',
    resource: ProfileResource::class
)
```

![has_one](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/has_one.png#light)
![has_one_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/has_one_dark.png#dark)

If you do not specify `$relationName`, the relationship name will be automatically determined based on `$label` (following camelCase rules).

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
use MoonShine\Laravel\Fields\Relationships\HasOne;
// [tl! collapse:end]

HasOne::make('Profile', 'profile')
```

You can omit `$resource` if the `ModelResource` matches the name of the relationship.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
use MoonShine\Laravel\Fields\Relationships\HasOne;
// [tl! collapse:end]

HasOne::make('Profile')
```

<a name="fields"></a>
## Fields

The `fields()` method allows you to specify which fields will be involved in the *preview* or in the form building.

```php
fields(FieldsContract|Closure|iterable $fields)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:4]
use App\MoonShine\Resources\ProfileResource;
use MoonShine\UI\Fields\Relationships\HasOne;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Text;

HasOne::make('Profile', resource: ProfileResource::class)
    ->fields([
        Phone::make('Phone'),
        Text::make('Address'),
    ])
```

![has_one_preview](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/has_one_preview.png#light)
![has_one_preview_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/has_one_preview_dark.png#dark)

<a name="parent-id"></a>
## Parent ID

If the relationship has a resource, and you want to get the parent item's ID, you can use the `ResourceWithParent` trait.

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

When using the trait, you need to define the following methods:

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

<a name="modify"></a>
## Modification

### Preview

The `modifyTable()` method allows you to change the `TableBuilder` for the preview.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasOne;
use MoonShine\UI\Components\Table\TableBuilder;

HasOne::make('Comment', resource: CommentResource::class)
    ->modifyTable(
        fn(TableBuilder $table) => $table
    )
```

### Form

The `modifyForm()` method allows you to change the `FormBuilder` for editing.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use App\MoonShine\Resources\CommentResource;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Laravel\Fields\Relationships\HasOne;

HasOne::make('Comment', resource: CommentResource::class)
    ->modifyForm(
        fn(FormBuilder $form) => $form->submit('Custom title')
    )
```

### Redirect after modification

The `redirectAfter()` method allows for redirection after saving/adding/deleting.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use App\MoonShine\Resources\CommentResource;
use MoonShine\Laravel\Fields\Relationships\HasOne;

HasOne::make('Comment', resource: CommentResource::class)
    ->redirectAfter(fn(int $parentId) => route('home'))
```

<a name="view"></a>
## Display

### Display within Tabs

By default, relationship fields in **MoonShine** are displayed at the bottom, separately from the form, and follow one after another.
To change the display of the field and add it to `Tabs`, you can use the `tabMode()` method.

```php
tabMode(Closure|bool|null $condition = null)
```

In the following example, a [Tabs](/docs/{{version}}/components/tabs) component with two tabs, Comment and Cover, will be created.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
use MoonShine\Laravel\Fields\Relationships\HasOne;
// [tl! collapse:end]

HasOne::make('Comment', 'comment', resource: CommentResource::class)
    ->tabMode(),
HasOne::make('Cover', 'cover', resource: CoverResource::class)
    ->tabMode()
```

> [!NOTE]
> tabMode will not work when using the `disableOutside()` method

### Display within a Modal Window

To display a HasOne field in a modal window that is called by a button, you can use the `modalMode()` method.

```php
public function modalMode(
    Closure|bool|null $condition = null,
    ?Closure $modifyButton = null,
    ?Closure $modifyModal = null
)
```

In this example, instead of a form, there will now be an [ActionButton](/docs/{{version}}/components/action-button) that calls a [Modal](/docs/{{version}}/components/modal).

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
use MoonShine\Laravel\Fields\Relationships\HasOne;
// [tl! collapse:end]

HasOne::make('Comment', 'comment', resource: CommentResource::class)
    ->modalMode(),
```

To modify the `ActionButton` and `Modal`, you can use the method parameters `$modifyButton` and `$modifyModal`, into which you can pass a closure.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:start]
use MoonShine\Laravel\Fields\Relationships\HasOne;
// [tl! collapse:end]

HasOne::make('Comment', 'comment', resource: CommentResource::class)
    ->modalMode(
        modifyButton: function (ActionButtonContract $button, HasOne $ctx) {
            $button->warning();
            return $button;
        },
        modifyModal: function (Modal $modal, ActionButtonContract $ctx) {
            $modal->autoClose(false);
            return $modal;
        }
    )
```

### Display within the Main Resource Form

For `HasOne`, the `disableOutside()` method is available, which allows it to be displayed inside the form at the designated field location.
`disableOutside()` for `HasOne` only works in `modalMode`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Fields\Relationships\HasOne;

HasOne::make('Comment', 'comment', resource: CommentResource::class)
    ->disableOutside(),
```
