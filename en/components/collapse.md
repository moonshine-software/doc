# Collapse

- [Basics](#basics)
- [Icon](#icon)
- [Display](#show)
- [State Persistence](#persist)

---

<a name="basics"></a>
## Basics

`Collapse` allows you to collapse the content of a block, which can contain various components.
When collapsed, the state of the components remains unchanged.

```php
make(
    Closure|string $label = '',
    iterable $components = [],
    bool $open = false,
    bool $persist = true
)
```

- `$label` - the title of `Collapse`,
- `$components` - a set of components inside the `Collapse`,
- `$open` - a flag that defines whether the `Collapse` is collapsed or expanded by default,
- `$persist` - state preservation inside the `Collapse`.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Collapse;

Collapse::make('Title/Slug', [
    Text::make('Title'),
    Text::make('Slug'),
])
```
tab: Blade
```blade
<x-moonshine::collapse
    :label="'Title/Slug'"
    :components='$components'
/>
```
~~~

<a name="icon"></a>
## Icon

The `icon()` method allows you to add an icon.

```php
icon(
    string $icon,
    bool $custom = false,
    ?string $path = null
)
```

> [!NOTE]
> For more detailed information, refer to the [icons](/docs/{{version}}/appearance/icons) section.

<a name="show"></a>
## Display

By default, the `Collapse` decorator is displayed in a collapsed view.
The `open()` method allows you to override this behavior.

```php
open(Closure|bool|null $condition = null)
```

<a name="persist"></a>
## State Persistence

By default, `Collapse` remembers its state, but there are cases where this should not happen.
The `persist()` method allows you to override this behavior.

```php
persist(Closure|bool|null $condition = null)
```
