# Enum

- [Basics](#basics)
- [Displaying Values](#displaying-values)
- [Color](#color)

---

<a name="basics"></a>
## Basics

Inherits from [Select](/docs/{{version}}/fields/select).

\* has the same capabilities.

Operates the same as the `Select` field but accepts *Enum* as options.

```php
use MoonShine\UI\Fields\Enum;

Enum::make('Status')
    ->attach(StatusEnum::class)
```

> [!NOTE]
> The model attributes require Enum Cast.

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

<p class="my-4 flex flex-wrap gap-1">
    <span class="badge badge-primary">primary</span>
    <span class="badge badge-secondary">secondary</span>
    <span class="badge badge-success">success</span>
    <span class="badge badge-warning">warning</span>
    <span class="badge badge-error">error</span>
    <span class="badge badge-info">info</span>
</p>
<p class="my-4 flex flex-wrap gap-1">
    <span class="badge badge-purple">purple</span>
    <span class="badge badge-pink">pink</span>
    <span class="badge badge-blue">blue</span>
    <span class="badge badge-green">green</span>
    <span class="badge badge-yellow">yellow</span>
    <span class="badge badge-red">red</span>
    <span class="badge badge-gray">gray</span>
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

![enum](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/enum.png#light)
![enum_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/enum_dark.png#dark)
