# RelationRepeater

- [Basics](#basics)
- [Field Set](#fields)
- [Vertical Mode](#vertical)
- [Add/Delete](#creatable-removable)
- [Buttons](#buttons)
- [Modifiers](#modify)

---

<a name="basics"></a>
## Basics

Contains all [Basic Methods](/docs/{{version}}/fields/basic-methods).

The `RelationRepeater` field is designed for working with `HasMany` and `HasOne` relationships.
It allows you to create, edit, and delete related records directly from the main model's form.

> [!NOTE]
> The field automatically syncs related records when saving the main model.

```php
make(
    string|Closure $label,
    ?string $relationName = null,
    string|Closure|null $formatted = null,
    ModelResource|string|null $resource = null,
)
```

- `$label` - field title,
- `$relationName` - relationship name,
- `$formatted` - closure for formatting the field's value in "preview" mode,
- `$resource` - resource of the related model.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;

RelationRepeater::make(
    'Comments',
    'comments',
    resource: CommentResource::class
)
```

<a name="fields"></a>
## Field Set

By default, the field uses all form fields from the specified resource.
However, you can override the field set using the `fields()` method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

RelationRepeater::make('Characteristics', 'characteristics')
    ->fields([
        ID::make(),
        Text::make('Name', 'name'),
        Text::make('Value', 'value'),
    ])
```

> [!WARNING]
> The presence of the `ID` field is required, otherwise records will always be added.

<a name="vertical"></a>
## Vertical Mode

The `vertical()` method changes the display of the table from horizontal mode to vertical.

```php
vertical(Closure|bool|null $condition = null)
```

```php
RelationRepeater::make('Comments', 'comments')
    ->vertical()
```

<a name="creatable-removable"></a>
## Add/Delete

By default, the field allows adding new items.
This behavior can be changed using the `creatable()` method.

```php
creatable(
    Closure|bool|null $condition = null,
    ?int $limit = null,
    ?ActionButtonContract $button = null
)
```

- `$condition` - the condition under which the method should be applied,
- `$limit` - limit on the number of possible elements,
- `$button` - ability to replace the adding button with your own.

The ability to delete items is handled by the `removable()` method.

```php
removable(
    Closure|bool|null $condition = null,
    array $attributes = []
)
```

```php
RelationRepeater::make('Comments', 'comments')
    ->creatable(limit: 5)
    ->removable()
```

<a name="buttons"></a>
## Buttons

The `buttons()` method allows overriding the buttons used in the field.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\UI\Components\ActionButton;

RelationRepeater::make('Comments', 'comments')
    ->buttons([
        ActionButton::make('', '#')
            ->icon('trash')
            ->onClick(fn() => 'remove()', 'prevent')
            ->class('btn-error')
            ->showInLine()
    ])
```

<a name="modify"></a>
## Modifiers

### Table Modifier

The `modifyTable()` method allows modifying the table (`TableBuilder`).

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\UI\Components\Table\TableBuilder;

RelationRepeater::make('Comments', 'comments')
    ->modifyTable(
        fn(TableBuilder $table, bool $preview) => $table
            ->customAttributes([
                'class' => 'custom-table'
            ])
    )
```

### Remove Button Modifier

The `modifyRemoveButton()` method allows changing the remove button.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\UI\Components\ActionButton;

RelationRepeater::make('Comments', 'comments')
    ->modifyRemoveButton(
        fn(ActionButton $button) => $button
            ->customAttributes([
                'class' => 'btn-secondary'
            ])
    )
```
