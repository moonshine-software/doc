# DateRange

- [Make](#make)
- [Date and time](#with-time)
- [Format](#format)
- [Attributes](#attributes)
- [Filter](#filter)

---

<a name="make"></a>
## Make

The _DateRange_ field includes all the basic methods and allows you to select a date range.

Since the date range has two values, you need to specify them using the `fromTo()` method.

```php
fromTo(string $fromField, string $toField)
```

```php
use MoonShine\Fields\DateRange;

//...

public function fields(): array
{
    return [
        DateRange::make('Dates')
            ->fromTo('date_from', 'date_to')
    ];
}

//...
```

![](https://moonshine-laravel.com/screenshots/date-range.png) ![](https://moonshine-laravel.com/screenshots/date-range_dark.png)

<a name="with-time"></a>
## Date and time

Using the `withTime()` method allows you to enter date and time into fields.

```php
withTime()
```

```php
use MoonShine\Fields\DateRange;

//...

public function fields(): array
{
    return [
        DateRange::make('Dates')
            ->fromTo('date_from', 'date_to')
            ->withTime()
    ];
}

//...
```

<a name="format"></a>
## Format

The `format()` method allows you to change the display format of field values in preview.

```php
format(string $format)
```

```php
use MoonShine\Fields\DateRange;

//...

public function fields(): array
{
    return [
        DateRange::make('Dates')
            ->fromTo('date_from', 'date_to')
            ->format('d.m.Y')
    ];
}

//...
```

<a name="attributes"></a>
## Attributes

Does the _DateRange_ field have attributes? which can be set through the appropriate methods.

Methods `min()` and `max()` are used to set the minimum and maximum date values.

```php
min(string $min)
```

```php
max(string $max)
```

The `step()` method is used to set the date step for a field.

```php
step(int|float|string $step)
```

```php
use MoonShine\Fields\DateRange;

//...
public function fields(): array
{
    return [
        DateRange::make('Dates')
            ->fromTo('date_from', 'date_to')
            ->min('2023-01-01')
            ->max('2023-12-31')
            ->step(5)
    ];
}

//...
```

If you need to add custom attributes for fields, you can use the appropriate methods `fromAttributes()` and `toAttributes()`.

```php
fromAttributes(array $attributes)
```

```php
toAttributes(array $attributes)
```

```php
use MoonShine\Fields\DateRange;

//...

public function fields(): array
{
    return [
        DateRange::make('Dates')
            ->fromTo('date_from', 'date_to')
            ->fromAttributes(['placeholder'=> 'from'])
            ->toAttributes(['placeholder'=> 'to'])
    ];
}

//...
```

<a name="filter"></a>
## Filter

While using the _DateRange_ field to construct a filter, method `fromTo()` is not used, because filtering occurs on one field in the database table.

```php
use MoonShine\Fields\DateRange;

//...

public function filters(): array
{
    return [
        DateRange::make('Dates',  'dates')
    ];
}

//...
```

