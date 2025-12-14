# Carousel

- [Основы](#basics)
- [Элементы](#items)

---

<a name="basics"></a>
## Основы

Компонент `Carousel` позволяет создавать карусель изображений.

```php
make(
   Closure|array $items = [],
   Closure|bool $portrait = false,
   Closure|string $alt = ''
)
```

- `$items` - изображения,
- `$portrait` - портретная ориентация,
- `$alt` - атрибут, содержащий текстовую замену изображения.

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

<a name="items"></a>
## Элементы

Чтобы добавить карусель изображений, вы можете использовать метод `items()`.

```php
items(Closure|array $value)
```

- `$value` - массив url изображений или замыкание.

```php
Carousel::make(
    alt: 'Some alt',
)
    ->items(['/images/image_2.jpg','/images/image_1.jpg'])
````
