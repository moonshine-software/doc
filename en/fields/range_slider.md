# RangeSlider

- [Make](#make)
- [Filter](#filter)

---

Extends [Range](/docs/{{version}}/fields/range) \* has the same features

<a name="make"></a>
## Make

The _RangeSlider_ field is an extension of _Range_ and additionally has the ability to change values using a slider.

```php
use MoonShine\Fields\RangeSlider;

//...

public function fields(): array
{
    return [
        RangeSlider::make('Age')
            ->fromTo('age_from', 'age_to')
    ];
}

//...
```

![](https://moonshine-laravel.com/screenshots/slide.png) ![](https://moonshine-laravel.com/screenshots/slide_dark.png)

<a name="filter"></a>
## Filter

While using the _RangeSlider_ field to construct a filter, method `fromTo()` is not used, because filtering occurs on one field in the database table.

```php
use MoonShine\Fields\RangeSlider;

//...

public function filters(): array
{
    return [
        RangeSlider::make('Age',  'age')
    ];
}

//...
```