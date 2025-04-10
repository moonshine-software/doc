# FieldsGroup

- [Basics](#basics)
- [Filling with data](#fill)
- [Preview mode](#preview)
- [Without wrappers mode](#without-wrappers)
- [Mass field modification](#map)

---

<a name="basics"></a>
## Basics

The `FieldsGroup` component is designed for the quick grouping of a set of fields, filling them with data, and changing their states.

```php
make(iterable $components = [])
```

`$components` - a set of `FieldContract`.

```php
use MoonShine\UI\Components\FieldsGroup;

FieldsGroup::make([
    Text::make('Title'),
    Email::make('Email'),
]);
```

<a name="fill"></a>
## Filling with data

To fill all fields with data, use the `fill()` method.

```php
fill(
    array $raw = [],
    ?DataWrapperContract $casted = null,
    int $index = 0,
)
```

```php
FieldsGroup::make($fields)
    ->fill($data)
```

<a name="preview"></a>
## Preview mode

You can switch all fields in the set to "preview" mode using the `previewMode()` method.

```php
FieldsGroup::make($fields)
    ->previewMode()
```

<a name="without-wrappers"></a>
## Without wrappers mode

You can switch all fields in the set to without wrappers mode using the `withoutWrappers()` method.

> [!NOTE]
> Wrappers - fields that implement the `FieldsWrapperContract` interface, for example, `StackFields`.
> Therefore, when using the `withoutWrappers` method, all nested fields will be extracted from the wrapper field,
> and the wrapper field itself will not be included in the final set.

```php
FieldsGroup::make($fields)
    ->withoutWrappers()
```

<a name="map"></a>
## Mass field modification

All the methods described above use the `mapFields()` method under the hood, which allows you to iterate through all elements in the set and change their state.

```php
FieldsGroup::make($fields)
    ->mapFields(
        fn(FieldContract $field, int $index): FieldContract => $field
    )
```
