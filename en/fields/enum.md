# Enum

- [Basics](#basics)
- [Displaying Values](#displaying-values)
- [Color](#color)
- [Icon](#icon)

---

<a name="basics"></a>
## Basics

Inherits from [Select](/docs/{{version}}/fields/select).

\* has the same capabilities.

Operates the same as the `Select` field but accepts *Enum* as options.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Enum;

Enum::make('Status')
    ->attach(StatusEnum::class)
```

> [!NOTE]
> The model attributes require Enum Cast.

@preview('fields.select')

<a name="displaying-values"></a>
## Displaying Values

### toString

The `toString()` method implemented in *Enum* allows you to set the displayed value.

```php
namespace App\Enums;

enum StatusEnum: string
{
    case NEW = 'new';
    case DRAFT = 'draft';
    case PUBLIC = 'public';

    public function toString(): ?string
    {
        return match ($this) {
            self::NEW => 'New',
            self::DRAFT => 'Draft',
            self::PUBLIC => 'Public',
        };
    }
}
```

<a name="color"></a>
## Color

If *Enum* implements the `getColor()` method, the field in "preview" mode will be displayed as an icon of a specific color.

Available colors:

<p class="colors">
<span class="color color-primary">primary</span>
<span class="color color-secondary">secondary</span>
<span class="color color-success">success</span>
<span class="color color-warning">warning</span>
<span class="color color-error">error</span>
<span class="color color-info">info</span>
<span class="color color-purple">purple</span>
<span class="color color-pink">pink</span>
<span class="color color-blue">blue</span>
<span class="color color-green">green</span>
<span class="color color-yellow">yellow</span>
<span class="color color-red">red</span>
<span class="color color-gray">gray</span>
</p>

```php
namespace App\Enums;

enum StatusEnum: string
{
    case NEW = 'new';
    case DRAFT = 'draft';
    case PUBLIC = 'public';

    public function getColor(): ?string
    {
        return match ($this) {
            self::NEW => 'info',
            self::DRAFT => 'gray',
            self::PUBLIC => 'success',
        };
    }
}
```

<a name="icon"></a>
## Icon

If *Enum* implements the `getIcon()` method, an icon will be displayed next to the value in "preview" mode.

> [!NOTE]
> To display the icon, the `getColor()` method must also be implemented.

```php
namespace App\Enums;

enum StatusEnum: string
{
    case NEW = 'new';
    case DRAFT = 'draft';
    case PUBLIC = 'public';

    public function getColor(): ?string
    {
        return match ($this) {
            self::NEW => 'info',
            self::DRAFT => 'gray',
            self::PUBLIC => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::NEW => 'sparkles',
            self::DRAFT => 'pencil',
            self::PUBLIC => 'check-circle',
        };
    }
}
```

> [!TIP]
> A list of all available icons can be found in the [Icons](/docs/{{version}}/appearance/icons) section.
