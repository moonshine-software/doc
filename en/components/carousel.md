# Carousel Component

- [Make](#make)
- [Items](#items)
- [Portrait orientation](#portrait-orientation)

---

<a name="make"></a>
## Make

The *Carousel* component allows you to create image carousel.

You can create a Carousel using the static method `make()` class `Carousel`.

```php
make(
    Closure|string $alt = '',
    Closure|string|array $items = '',
    Closure|boolean $portrait = false
)
```

- `$alt` - attribute holds a textual replacement for the image,
- `$items` - images,
- `$portrait` - portrait orientation

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

![2](https://moonshine-laravel.com/images/image_2.jpg)
![1](https://moonshine-laravel.com/images/image_1.jpg)

<a name="images"></a>
## Images

To add an images carousel to a card, you can use the `items()` method.

```php
items(Closure|string|array $value)
```

- `$value` - *url* of the image or array urls of image or closure.

```php
Carousel::make(
    alt: fake()->sentence(3),
)
->items(['/images/image_2.jpg','/images/image_1.jpg'])
````

![2](https://moonshine-laravel.com/images/image_2.jpg)
![1](https://moonshine-laravel.com/images/image_1.jpg)

<a name="#portrait"></a>
## Portrait orientation

To use a carousel with vertical images, add a parameter `portrait: true` to `make()` method.

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

![1](https://moonshine-laravel.com/images/image_portrait_1.jpg)
![2](https://moonshine-laravel.com/images/image_portrait_2.jpg)
