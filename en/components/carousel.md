# Carousel

- [Basics](#basics)
- [Items](#items)

---

<a name="basics"></a>
## Basics

The `Carousel` component allows you to create an image carousel.

```php
make(
   Closure|array $items = [],
   Closure|bool $portrait = false,
   Closure|string $alt = ''
)
```

- `$items` - images,
- `$portrait` - portrait orientation,
- `$alt` - an attribute containing alternative text for the image.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Carousel;

Carousel::make(
    items: ['/images/image_2.jpg', '/images/image_1.jpg'],
    alt: fake()->sentence(3)
)
```
tab: Blade
```blade
<x-moonshine::carousel
    :items="['/images/image_2.jpg','/images/image_1.jpg']"
    :alt="fake()->sentence(3)"
/>
```
~~~

@preview('carousel')

<a name="items"></a>
## Items

To add an image carousel, you can use the `items()` method.

```php
items(Closure|array $value)
```

- `$value` - an array of image URLs or a closure.

```php
Carousel::make(
    alt: 'Some alt',
)
    ->items(['/images/image_2.jpg','/images/image_1.jpg'])
````
