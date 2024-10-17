# HasMany

   - [Basics](#basics)
   - [Fields](#fields)
   - [Creating a Relationship Object](#creatable)
   - [Number of records](#limit)
   - [Link only](#only-link)
   - [Parent ID](#parent-id)
   - [Edit button](#change-edit-button)
   - [Modal](#without-modals)
   - [Modify](#modify)
   - [Advanced](#advanced)

---

<a name="basics"></a> 
## Basics

The *HasMany* field is designed to work with the relation of the same name in Laravel and includes all the basic methods.

To create this field, use the static `make()` method.

```php
HasMany::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null,
    ?ModelResource $resource = null
```

-`$label` - label, field header,
-`$relationName` - name of the relationship,
-`$resource` - the model resource referenced by the relation.

> [!CAUTION]
> The `$formatted` parameter is not used in the `HasMany` field!

> [!WARNING]
> The presence of the model resource referenced by the relation is mandatory
The resource also needs to be [registered](https://moonshine-laravel.com/docs/resource/models-resources/resources-index#define) with the service provider `MoonShineServiceProvider` in the method `menu()` or `resources()`. Otherwise, there will be a 404 error.

```php
use MoonShine\Fields\Relationships\HasMany; 
 
//...
 
public function fields(): array
{
    return [
        HasMany::make('Comments', 'comments', resource: new CommentResource()) 
    ];
}
 
//...
```

![has_many](https://moonshine-laravel.com/screenshots/has_many.png)
![has_many_dark](https://moonshine-laravel.com/screenshots/has_many_dark.png)

> [!NOTE]
> If you do not specify `$relationName`, then the relation name will be determined automatically based on `$label`.

```php
use MoonShine\Fields\Relationships\HasMany; 
 
//...
 
public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource()) 
    ];
}
 
//...
```

> [!NOTE]
> You can omit `$resource` if the model resource matches the name of the relationship.

```php
use MoonShine\Fields\Relationships\HasMany; 
 
//...
 
public function fields(): array
{
    return [
        HasMany::make('Comments', 'comments') 
    ];
}
 
//...
```

<a name="fields"></a> 
## Fields

The `fields()` method allows you to set the fields that will be displayed in the *preview*.

```php
fields(Fields|Closure|array $fields)
```

```php
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;
 
//...
 
public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->fields([
                BelongsTo::make('User'),
                Text::make('Text'),
            ]) 
    ];
}
 
//...
```

![has_many_fields](https://moonshine-laravel.com/screenshots/has_many_fields.png)
![has_many_fields_dark](https://moonshine-laravel.com/screenshots/has_many_fields_dark.png)

<a name="creatable"></a> 
## Creating a Relationship Object

The `creatable()` method allows you to create a new relation object through a modal window.

```php
creatable(
    Closure|bool|null $condition = null,
    ?ActionButton $button = null,
)
```

```php
use MoonShine\Fields\Relationships\HasMany;
 
//...
 
public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->creatable() 
    ];
}
 
//...
```

![has_many_creatable](https://moonshine-laravel.com/screenshots/has_many_creatable.png)
![has_many_creatable_dark](https://moonshine-laravel.com/screenshots/has_many_creatable_dark.png)

You can customize the create *button* by passing the button parameter to the method.

```php
use MoonShine\Fields\Relationships\HasMany;
 
//...
 
public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->creatable(
                button: ActionButton::make('Custom button', '')
            ) 
    ];
}
 
//...
```

<a name="limit"></a> 
## Number of records

The `limit()` method allows you to limit the number of records displayed in *preview*.

```php
limit(int $limit)
```

```php
use MoonShine\Fields\Relationships\HasMany;
 
//...
 
public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->limit(1) 
    ];
}
 
//...
```

<a name="only-link"></a> 
## Link only

The `onlyLink()` method will allow you to display the relationship as a link with the number of elements.

```php
onlyLink(?string $linkRelation = null, Closure|bool|null $condition = null)
```

You can pass optional parameters to the method:
- `linkRelation` - link to the relationship;
- `condition` - closure or boolean value, responsible for displaying the relationship as a link.

```php
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink()
    ];
}

//...
```
![has_many_link](https://moonshine-laravel.com/screenshots/has_many_link.png)
![has_many_link_dark](https://moonshine-laravel.com/screenshots/has_many_link_dark.png)

## linkRelation

The `linkRelation` parameter allows you to create a link to a relation with a parent resource binding.

```php
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink('comment')
    ];
}

//...
```

## condition

The `condition` parameter via a closure will allow you to change the display method depending on the conditions.

```php
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink(condition: function (int $count, Field $field): bool {
                return $count > 10;
            })
    ];
}

//...
```

<a name="parent-id"></a> 
## Parent ID

If the relationship has a resource, and you want to get the ID of the parent element, then you can use the *ResourceWithParent* trait.

```php
use MoonShine\Resources\ModelResource;
use MoonShine\Traits\Resource\ResourceWithParent;

class PostImageResource extends ModelResource
{
    use ResourceWithParent;

    //...
}
```

When using a trait, it is necessary to define methods:

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
> Recipe: [saving files](https://moonshine-laravel.com/docs/resource/recipes/recipes#hasmany-parent-id) *HasMany* connections in the directory with the parent ID.

<a name="change-edit-button"></a> 
## Edit button

The `changeEditButton()` method allows you to completely redefine the edit button.

```php
use MoonShine\Fields\Relationships\HasMany;

//...

HasMany::make('Comments', 'comments', resource: new CommentResource())
    ->changeEditButton(
        ActionButton::make(
            'Edit',
            fn(Comment $comment) => (new CommentResource())->formPageUrl($comment)
        )
    )
```

<a name="without-modals"></a> 
## Modal

By default, creating and editing a *HasMany* field entry occurs in a modal, The `withoutModals()` method allows you to disable this behavior.

```php
use MoonShine\Fields\Relationships\HasMany;

//...

HasMany::make('Comments', 'comments', resource: new CommentResource())
    ->withoutModals()
```

<a name="modify"></a> 
## Modify

The *HasMany* field has methods that can be used to modify the buttons, change *TableBuilder* for preview and form, and change *onlyLink* button.

#### modifyItemButtons()

The `modifyItemButtons()` method allows you to change the view, edit, deletion and mass deletion.

```php
/**
 * @param  Closure(ActionButton $detail, ActionButton $edit, ActionButton $delete, ActionButton $massDelete, self $field): array  $callback
 */
modifyItemButtons(Closure $callback)
```

```php
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->modifyItemButtons(
                fn(ActionButton $detail, $edit, $delete, $massDelete, HasMany $ctx) => [$detail]
            )
    ];
}
```

#### modifyOnlyLinkButton()

The `modifyOnlyLinkButton()` method allows you to change the *onlyLink* button.

```php
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->onlyLink()
            ->modifyOnlyLinkButton(
                fn(ActionButton $button, bool $preview) => $button
                    ->when($preview, fn(ActionButton $btn) => $btn->primary())
                    ->unless($preview, fn(ActionButton $btn) => $btn->secondary())
            )
    ];
}
```

#### modifyCreateButton() / modifyEditButton()

`modifyCreateButton()` and `modifyEditButton()` methods allow you to change the create and edit buttons.

```php
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->modifyCreateButton(
                fn(ActionButton $button) => $button->setLabel('Custom create button')
            )
            ->modifyEditButton(
                fn(ActionButton $button) => $button->setLabel('Custom edit button')
            )
            ->creatable(true)
    ];
}
```

#### modifyTable()

The `modifyTable()` method allows you to change the *TableBuilder* for the preview and form.

```php
use MoonShine\Fields\Relationships\HasMany;

//...

public function fields(): array
{
    return [
        HasMany::make('Comments', resource: new CommentResource())
            ->modifyTable(
                fn(TableBuilder $table, bool $preview) => $table
                    ->when($preview, fn(TableBuilder $tbl) => $tbl->customAttributes(['style' => 'background: blue']))
                    ->unless($preview, fn(TableBuilder $tbl) => $tbl->customAttributes(['style' => 'background: green']))
            )
    ];
}
```

<a name="advanced"></a> 
## Advanced

#### Relation via JSON field
The *HasMany* field is displayed outside the main resource form by default. If you need to display relation fields inside the main form, then you can use the *JSON* field in the `asRelation()` mode. 

```php
//...

public function fields(): array
{
    return [
        Json::make('Comments', 'comments')
            ->asRelation(new CommentResource())
            //...
    ]
}

//...
```
> [!NOTE]
> For more detailed information, please refer to the section [Json field](https://moonshine-laravel.com/docs/resource/fields/fields-json#relation).

#### Relationship via Template field

Using the *Template field* you can construct a field for *HasMany* relationships using fluent interface during the declaration process.

> [!NOTE]
> For more detailed information, please refer to the section [Template field](https://moonshine-laravel.com/docs/resource/fields/fields-template).

#### HasMany field tabs

In **Moonshine** you can customize the form page and place *HasMany* fields in tabs using the *Tabs* and *Tab* decorations.

```php
class PostFormPage extends FormPage
{
    public function components(): array
    {
        if(! $this->getResource()->getItemID()) {
            return parent::components();
        }

        $bottomComponents = $this->getLayerComponents(Layer::BOTTOM);
        $imagesComponent = collect($bottomComponents)->filter(fn($component) => $component->getName() === 'images')->first();
        $commentsComponent = collect($bottomComponents)->filter(fn($component) => $component->getName() === 'comments')->first();

        $tabLayer = [
            Block::make('', [
                Tabs::make([
                    Tab::make('Edit', $this->mainLayer()),
                    Tab::make('Images', [$imagesComponent]),
                    Tab::make('Comments', [$commentsComponent])
                ])
            ])
        ];

        return [
            ...$this->getLayerComponents(Layer::TOP),
            ...$tabLayer,
        ];
    }
}
```

> [!NOTE]
> For more details you can read the article [Form page customization. Moon Shine 2.0](https://cutcode.dev/articles/kastomizaciia-stranicy-formy-moonshine-20).
