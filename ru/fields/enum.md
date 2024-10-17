# Enum

- [Создание](#make)
- [Отображение значений](#displaying-values)
- [getColor](#getcolor)

---

<a name="make"></a>
## Создание
Расширяет [Select](/docs/{{version}}/fields/select)  
* имеет те же функции  

Работает так же, как поле *Select*, но принимает *Enum* в качестве опций.

> [!NOTE]
> Атрибуты модели требуют Enum Cast.

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

<a name="displaying-values"></a>
## Отображение значений

-toString

Метод `toString()`, реализованный в *Enum*, позволяет установить выходное значение.

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

<a name="getcolor"></a>
## getColor
Если *Enum* реализует метод `getColor()`, то поле *preview* будет отображаться как иконка определенного цвета.

Доступные цвета:

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
![enum](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/enum.png)
![enum_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/enum_dark.png)


