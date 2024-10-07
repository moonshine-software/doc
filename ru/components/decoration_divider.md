# Декоратор Divider

- [Создание](#make)
- [Метка](#label)
- [Центрирование](#Centering)

---

<a name="make"></a>
## Создание

Для разделения на зоны можно использовать декорацию *Divider*.

```php
use MoonShine\Decorations\Divider;

//...

public function components(): array
{
    return [
        //...

        Divider::make(),

        //...
    ];
}
```

<a name="label"></a>
## Метка

Вы можете использовать текст в качестве разделителя; для этого нужно передать его в метод `make()`.

```php
use MoonShine\Decorations\Divider;

//...

public function components(): array
{
    return [
        //...

        Divider::make('Разделитель'),

        //...
    ];
}
```

<a name="centering"></a>
## Центрирование

Метод `centered()` позволяет центрировать текст.

```php
use MoonShine\Decorations\Divider;

//...

public function components(): array
{
    return [
        //...

        Divider::make('Разделитель')
            ->centered(),

        //...
    ];
}
```
