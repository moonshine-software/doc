# Phone

- [Basics](#basics)
- [Mask](#mask)

---

<a name="basics"></a>
## Basics

Inherits from [Text](/docs/{{version}}/fields/text).

\* has the same capabilities.

The `Phone` field is an extension of `Text`, which by default sets `type=tel`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Phone;

Phone::make('Phone')
```

@preview('fields.phone')

<a name="mask"></a>
## Mask

To use a mask for the phone number, use the `mask()` method.

```php
Phone::make('Phone')
    ->mask('7 999 999-99-99')
```
