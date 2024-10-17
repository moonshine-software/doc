# Card Component

- [Make](#make)
- [Header](#header)
- [Buttons](#actions)
- [Subtitle](#subtitle)
- [Link](#url)
- [Thumbnails](#thumbnail)
- [List of values](#values)
- [Overlay mode](#overlay)

---

<a name="make"></a>
## Make

The *Card* component allows you to create element cards.

You can create a *Card* using the static method `make()` class `Card`.

```php
make(
    Closure|string $title = '',
    Closure|string|array $thumbnail = '',
    Closure|string $url = '#',
    Closure|array $values = [],
    Closure|string|null $subtitle = null
)
```

- `$title` - card title,
- `$thumbnail` - images,
- `$url` - link,
- `$values` - list of values
- `$subtitle` - subtitle.

```php
use MoonShine\Components\Card;

//...

public function components(): array
{
    return [
        Card::make(
            title: fake()->sentence(3),
            thumbnail: '/images/image_1.jpg',
            url: fn() => 'https://cutcode.dev',
            values: ['ID' => 1, 'Author' => fake()->name()],
            subtitle: date('d.m.Y')
        )
    ];
}

//...

```
![image_1](https://moonshine-laravel.com/images/image_1.jpg)

<a name="header"></a>
## Header

The `header()` method allows you to set the header for cards.

```php
header(Closure|string $value)
```

- `$value` - column or closure returning html code. 
    
```php
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_2.jpg',
)
    ->header(static fn() => Badge::make('new', 'success'))
```

![image_2](https://moonshine-laravel.com/images/image_2.jpg)

<a name="actions"></a>
## Buttons

To add buttons to a card, you can use the `actions()` method.


```php
actions(Closure|string $value)
```

```php
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_1.jpg',
)
    ->actions(
        static fn() => ActionButton::make('Edit', route('name.edit'))
    )
```

![image_1](https://moonshine-laravel.com/images/image_1.jpg)

<a name="subtitle"></a>
## Subtitle

```php
subtitle(Closure|string $value)
```

- `$value` - column or a closure that returns a subtitle.

```php
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_2.jpg',
)
    ->subtitle(static fn() => 'Subtitle')
```

![image_2](https://moonshine-laravel.com/images/image_2.jpg)

<a name="url"></a>
## Link

The `url()` method allows you to set a link for the card title.

```php
url(Closure|string $value)
```

- `$value` - *url* or closure.


```php
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_1.jpg',
)
    ->url(static fn() => 'https://cutcode.dev')
```

![image_1](https://moonshine-laravel.com/images/image_1.jpg)

<a name="thumbnail"></a>
## Thumbnails

To add an images carousel to a card, you can use the `thumbnails()` method.

```php
thumbnails(Closure|string|array $value)
```

```php
Cards::make(
    title: fake()->sentence(3),
)
    ->thumbnail(['/images/image_2.jpg','/images/image_1.jpg'])
```

![image_1](https://moonshine-laravel.com/images/image_1.jpg)

<a name="values"></a>
## List of values

To add a list of values to a card, you can use the `values()` method.

```php
values(Closure|array $value)
```

- `$value` - associative array of values or closure.

```php
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_1.jpg',
)
    ->values([
        'ID' => 1,
        'Author' => fake()->name()
    ])
```

![image_1](https://moonshine-laravel.com/images/image_1.jpg)

<a name="overlay"></a>
## Overlay mode

The *overlay* mode allows you to place the header and headings on top of the card image. This mode is activated by the `overlay()` method of the same name.

```php
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_2.jpg',
    url: fn() => 'https://cutcode.dev',
    values: ['ID' => 1, 'Author' => fake()->name()],
    subtitle: date('d.m.Y')
)
    ->header(static fn() => Badge::make('new', 'success'))
    ->overlay()
```

![image_2](https://moonshine-laravel.com/images/image_2.jpg)
