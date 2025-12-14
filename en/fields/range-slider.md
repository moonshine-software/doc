# RangeSlider

- [Basics](#basics)
- [Creation](#make)
- [Filter](#filter)

---

<a name="basics"></a>
## Basics

Inherits from [Range](/docs/{{version}}/fields/range).

\* has the same capabilities.

The `RangeSlider` field is an extension of `Range` and additionally has the ability to change values using a slider.

<a name="make"></a>
## Creation

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\RangeSlider;

RangeSlider::make('Age', 'age')
    ->fromTo('age_from', 'age_to')
```

<a name="filter"></a>
## Filter

When using the `RangeSlider` field to build a filter, the `fromTo()` method is not used, as filtering occurs by a single field in the database table.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\RangeSlider;

RangeSlider::make('Age', 'age')
```
