# ActionGroup

- [Basics](#basics)
- [Filling with Data](#fill)
- [Adding Elements](#add)

---

<a name="basics"></a>
## Basics

The `ActionGroup` component is designed for the quick grouping of a set of `ActionButton` instances, as well as for filling the buttons with data.

```php
ActionGroup::make(iterable $actions = [])
```

- `$actions` - a set of `ActionButton`.

```php
use MoonShine\UI\Components\ActionGroup;

ActionGroup::make([
    ActionButton::make('Button 1'),
    ActionButton::make('Button 2'),
])
```

<a name="fill"></a>
## Filling with Data

To fill all the buttons with data, use the `fill()` method and pass a `DataWrapperContract`.

```php
ActionGroup::make($buttons)
    ->fill($data)
```

<a name="add"></a>
## Adding Elements

You can conveniently manipulate the set of `ActionButton` instances using the `add()`, `prepend()` and `addMany()` methods.

```php
ActionGroup::make($buttons)
    ->add(ActionButton::make('Button 3'))
```

```php
ActionGroup::make($buttons)
    ->prepend(ActionButton::make('Button 4'))
```

```php
ActionGroup::make($buttons)
    ->addMany([
        ActionButton::make('Button 5'),
        ActionButton::make('Button 6'),
    ])
```
