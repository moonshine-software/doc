# Компонент Carousel

- [Создание](#make)
- [Элементы](#items)
- [Портретная ориентация](#portrait-orientation)

---

<a name="make"></a>
## Создание

Компонент *Carousel* позволяет создавать карусель изображений.

Вы можете создать Carousel, используя статический метод `make()` класса `Carousel`.

```php
make(
    Closure|string $alt = '',
    Closure|string|array $items = '',
    Closure|boolean $portrait = false
)
```

- `$alt` - атрибут, содержащий текстовую замену изображения,
- `$items` - изображения,
- `$portrait` - портретная ориентация.

```php
use MoonShine\Components\Carousel;

//...

public function components(): array
{
    return [
        Carousel::make(
            alt: fake()->sentence(3),
            items: ['/images/image_2.jpg','/images/image_1.jpg'],
            portrait: false
        )
    ];
}

//...
```

<a name="images"></a>
## Изображения

Чтобы добавить карусель изображений, вы можете использовать метод `items()`.

```php
items(Closure|string|array $value)
```

- `$value` - *url* изображения или массив url изображений, или замыкание.

```php
Carousel::make(
    alt: fake()->sentence(3),
)
->items(['/images/image_2.jpg','/images/image_1.jpg'])
````

<a name="#portrait"></a>
## Портретная ориентация

Чтобы использовать карусель с вертикальными изображениями, добавьте параметр `portrait: true` в метод `make()`.

```php
bool portrait = false
```

```php
Carousel::make(
    alt: fake()->sentence(3),
    portrait: true
)
->items(['/images/image_2.jpg','/images/image_1.jpg'])
```
