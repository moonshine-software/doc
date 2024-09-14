https://moonshine-laravel.com/docs/resource/fields/fields-enum?change-moonshine-locale=en

------
# Enum

## Make
Extends [Select](https://moonshine-laravel.com/docs/resource/fields/fields-select)  
* has the same features  

Works the same as the *Select* field, but takes an *Enum* as options.

> [!NOTE]
> Model attributes require Enum Cast.

```php
use MoonShine\Fields\Enum;

//...

public function fields(): array
{
    return [
        Enum::make('Status')
            ->attach(StatusEnum::class)
    ];
}

//...
```

## Displaying values

-toString

The `toString()` method implemented in *Enum* allows you to set the output value.

```php
namespace App\Enums;

enum StatusEmun: string
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

## getColor
If *Enum* implements the `getColor()` method, then the *preview* field will appear as an icon of a certain color.

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

enum StatusEmun: string
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
![enum](https://moonshine-laravel.com/screenshots/enum.png)
![enum_dark](https://moonshine-laravel.com/screenshots/enum_dark.png)


