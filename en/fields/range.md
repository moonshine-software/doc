# Range

- [Basics](#basics)
- [Basic Methods](#basic-methods)
    - [Creation](#make)
    - [Attributes](#attributes)
- [Methods for Working with Numeric Values](#number-type-methods)
    - [Max and Min Values](#min-and-max)
    - [Step](#step)
    - [Stars](#stars)
- [Filter](#filter)

---

<a name="basics"></a>
## Basics

Contains all [Basic Methods](/docs/{{version}}/fields/basic-methods).

The `Range` field allows you to set a range of values.

<a name="basic-methods"></a>
## Basic Methods

<a name="make"></a>
## Creation

Since the range has two values, you need to specify them using the `fromTo()` method.

```php
fromTo(string $fromField, string $toField)
```

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Range;

Range::make('Age', 'age')
    ->fromTo('age_from', 'age_to')
```

@preview('fields.range')

<a name="attributes"></a>
## Attributes

If you need to add custom attributes for the fields, you can use the corresponding `fromAttributes()` and `toAttributes()` methods.

```php
fromAttributes(array $attributes)
```

```php
toAttributes(array $attributes)
```

In this example, a placeholder is added.

```php
Range::make('Age')
    ->fromTo('age_from', 'age_to')
    ->fromAttributes(['placeholder' => 'from'])
    ->toAttributes(['placeholder' => 'to'])
```

<a name="number-type-methods"></a>
## Methods for Working with Numeric Values

<a name="min-and-max"></a>
### Max and Min Values

The `min()` and `max()` methods are used to set the minimum and maximum values of the field.

```php
min(int|float $min)
```

```php
max(int|float $max)
```

<a name="step"></a>
### Step

The `step()` method is used to specify the step value for the field.

```php
step(int|float $step)
```

```php
Range::make('Price')
    ->fromTo('price_from', 'price_to')
    ->min(0)
    ->max(10000)
    ->step(5)
```

<a name="stars"></a>
### Stars

The `stars()` method is used to display the numeric value in preview mode as stars (e.g., for ratings).

```php
stars()
```

```php
Range::make('Rating')
    ->fromTo('rating_from', 'rating_to')
    ->stars()
```

<a name="filter"></a>
## Filter

When using the `Range` field for building a filter, the `fromTo()` method is not used, as filtering occurs on a single field in the database table.

```php
Range::make('Age', 'age')
```
