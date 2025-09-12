# Fieldset

- [Basics](#basics)
- [Edit View](#edit-view)
- [Conditional Display](#view-condition)

---

<a name="basics"></a>
## Basics

Contains all [Basic Methods](/docs/{{version}}/fields/basic-methods).

The `Fieldset` field allows grouping of fields when displayed in preview mode and wraps them in an HTML `fieldset` tag within forms.

The parameter or method `fields()` must accept an array of fields to group.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\Laravel\Fields\BelongsTo;
use MoonShine\UI\Fields\Fieldset;
use MoonShine\UI\Fields\Text;

Fieldset::make('Title', [
    Text::make('Title'),
    BelongsTo::make('Author', resource: 'name'),
])
```

<a name="edit-view"></a>
## Edit View

You can customize the display for `Fieldset` using components.

```php
Fieldset::make('Title', [
    Text::make('Title'),
    LineBreak::make(), // adds a line break
    BelongsTo::make('Author', resource: 'name'),
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
