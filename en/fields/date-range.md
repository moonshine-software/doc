# DateRange

- [Basics](#basics)
- [Creation](#make)
- [Date and Time](#date-and-time)
- [Format](#format)
- [Attributes](#attributes)
- [Filter](#filter)

---

<a name="basics"></a>
## Basics

Contains all [Basic methods](/docs/{{version}}/fields/basic-methods).

<a name="make"></a>
## Creation

The `DateRange` field allows you to select a date range.
Since the date range has two values, they must be specified using the `fromTo()` method.

```php
fromTo(string $fromField, string $toField)
```

```php
use MoonShine\UI\Fields\DateRange;

DateRange::make('Dates')
    ->fromTo('date_from', 'date_to')
```

<a name="date-and-time"></a>
## Date and Time

Using the `withTime()` method allows you to enter both date and time in the fields.

```php
withTime()
```

```php
DateRange::make('Dates')
    ->fromTo('date_from', 'date_to')
    ->withTime()
```

<a name="format"></a>
## Format

The `format()` method allows you to change the display format of the field values in the preview.

```php
format(string $format)
```

```php
DateRange::make('Dates')
    ->fromTo('date_from', 'date_to')
    ->format('d.m.Y')
```

<a name="attributes"></a>
## Attributes

The `DateRange` field has attributes that can be set using the corresponding methods.
The `min()` and `max()` methods are used to set the minimum and maximum date values.

```php
min(string $min)
```

```php
max(string $max)
```

The `step()` method is used to set the date step for the field.

```php
step(int|float|string $step)
```

```php
DateRange::make('Dates')
    ->fromTo('date_from', 'date_to')
    ->min('2024-01-01')
    ->max('2024-12-31')
    ->step(5)
```

If you need to add custom attributes for the fields, you can use the corresponding methods `fromAttributes()` and `toAttributes()`.

```php
fromAttributes(array $attributes)
```

```php
toAttributes(array $attributes)
```

```php
DateRange::make('Dates')
    ->fromTo('date_from', 'date_to')
    ->fromAttributes(['class'=> 'bg-black'])
    ->toAttributes(['class'=> 'bg-white'])
```

<a name="filter"></a>
## Filter

When using the `DateRange` field to build a filter, the `fromTo()` method is not used, as filtering occurs by one field in the database table.

```php
DateRange::make('Creation date', 'created_at')
```
