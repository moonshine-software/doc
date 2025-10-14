# Enum

- [Основы](#basics)
- [Отображение значений](#displaying-values)
- [Цвет](#color)

---

<a name="basics"></a>
## Основы

Наследует [Select](/docs/{{version}}/fields/select).

\* имеет те же возможности.

Работает так же, как поле `Select`, но принимает *Enum* в качестве опций.

```php
use MoonShine\UI\Fields\Enum;

Enum::make('Status')
    ->attach(StatusEnum::class)
```

> [!NOTE]
> Атрибуты модели требуют Enum Cast.

<a name="displaying-values"></a>
## Отображение значений

### toString

Метод `toString()`, реализованный в *Enum*, позволяет установить выводимое значение.

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
## Цвет

Если *Enum* реализует метод `getColor()`, то поле в режиме "preview" будет отображаться как иконка определенного цвета.

Доступные цвета:

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

![enum](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/enum.png#light)
![enum_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/enum_dark.png#dark)
