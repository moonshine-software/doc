# Fieldset

- [Basics](#basics)
- [Edit View](#edit-view)
- [Conditional Display](#view-condition)

---

<a name="basics"></a>
## Basics

Contains all [Basic Methods](/docs/{{version}}/fields/basic-methods).

The `Fieldset` field allows grouping of fields when displayed in preview mode and wraps them in an HTML `fieldset` tag within forms.

```php
make(
    string|Closure|null $label = null,
    iterable|Closure|FieldsContract $fields = []
)
```

- `$label` - label,
- `$fields` - fields for grouping.

Also, fields for grouping can be specified using the `fields()` method.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\UI\Fields\Fieldset;
use MoonShine\UI\Fields\Slug;
use MoonShine\UI\Fields\Text;

Fieldset::make('Title', [
    Text::make('Title'),
    Slug::make('Slug'),
]),

Fieldset::make()
    ->fields([
        Text::make('Title'),
        Slug::make('Slug'),
    ]),
```

<a name="edit-view"></a>
## Edit View

You can customize the display for `Fieldset` using components.

```php
Fieldset::make('Title', [
    Text::make('Title'),
    LineBreak::make(),
    Slug::make('Slug'),
])
```

<a name="view-condition"></a>
## Conditional Display

To change the set of components in `Fieldset` under certain conditions, you need to pass a condition and sets of components using a callback function.

```php
Fieldset::make('Stack', fn(Fieldset $ctx) => $ctx->getData()?->getOriginal()->id === 3 ? [
        Date::make('Creation date', 'created_at'),
    ] : [
        Date::make('Creation date', 'created_at'),
        LineBreak::make(),
        Email::make('Email', 'email'),
    ]
)
```
