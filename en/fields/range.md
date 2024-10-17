# Range

- [Make](#make)
- [Attributes](#attributes)
- [Filter](#filter)

---

Extends [Number](/docs/{{version}}/fields/number) \* has the same features

<a name="make"></a>
## Make

The _Range_ field is an extension of _Number_, allows you to set values for two logically related fields.

Since the range has two values, you need to specify them using the `fromTo()` method.

```php
fromTo(string $fromField, string $toField)
```

```php
use MoonShine\Fields\Range;

//...

public function fields(): array
{
    return [
        Range::make('Age')
            ->fromTo('age_from', 'age_to')
    ];
}

//...
```

![](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/range.png) ![](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/range_dark.png)

<a name="attributes"></a>
## Attributes

If you need to add custom attributes for fields, you can use the appropriate methods `fromAttributes()` and `toAttributes()`.

```php
fromAttributes(array $attributes)
```

```php
toAttributes(array $attributes)
```

```php
use MoonShine\Fields\Range;

//...

public function fields(): array
{
    return [
        Range::make('Age')
            ->fromTo('age_from', 'age_to')
            ->fromAttributes(['placeholder'=> 'from'])
            ->toAttributes(['placeholder'=> 'to'])
    ];
}

//...
```

<a name="filter"></a>
## Filter

While using the _Range_ field to construct a filter, method `fromTo()` is not used, because filtering occurs on one field in the database table.

```php
use MoonShine\Fields\Range;

//...

public function filters(): array
{
    return [
        Range::make('Age',  'age')
    ];
}

//...
```