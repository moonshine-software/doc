# Card

- [Basics](#basics)
- [Header](#header)
- [Buttons](#actions)
- [Subtitle](#subtitle)
- [URL](#url)
- [Thumbnails](#thumbnail)
- [Values List](#values)

---

<a name="basics"></a>
## Basics

The `Card` component allows you to create element cards.

```php
make(
    Closure|string $title = '',
    Closure|array|string $thumbnail = '',
    Closure|string $url = '#',
    Closure|array $values = [],
    Closure|string|null $subtitle = null,
    bool $overlay = false,
)
```

- `$title` - title,
- `$thumbnail` - images,
- `$url` - link,
- `$values` - list of values,
- `$subtitle` - subtitle,
- `$overlay` - the overlay mode allows placing the header and titles over the card image.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\Card;

Card::make(
    title: fake()->sentence(3),
    thumbnail: 'https://moonshine-laravel.com/images/image_1.jpg',
    url: fn() => 'https://cutcode.dev',
    values: ['ID' => 1, 'Author' => fake()->name()],
    subtitle: date('d.m.Y'),
)
```
tab: Blade
```blade
<x-moonshine::card
        :title="fake()->sentence(3)"
        :thumbnail="'https://moonshine-laravel.com/images/image_1.jpg'"
        :url="'https://cutcode.dev'"
        :subtitle="'test'"
        :values="['ID' => 1, 'Author' => fake()->name()]"
>
    {{ fake()->text(100) }}
</x-moonshine::card>
```
~~~

<a name="header"></a>
## Header

The `header()` method allows you to set a header for the cards.

```php
header(Closure|string $value)
```

- `$value` - a column or closure that returns HTML code.

```php
Card::make(
    title: fake()->sentence(3),
)
    ->header(static fn() => Badge::make('new', 'success'))
```

<a name="actions"></a>
## Buttons

To add buttons to the card, you can use the `actions()` method.

```php
actions(Closure|string $value)
```

```php
Card::make(
    title: fake()->sentence(3),
)
    ->actions(
        static fn() => ActionButton::make('Edit', route('name.edit'))
    )
```

<a name="subtitle"></a>
## Subtitle

```php
subtitle(Closure|string $value)
```

- `$value` - a column or closure that returns a subtitle.

```php
Card::make(
    title: fake()->sentence(3),
)
    ->subtitle(static fn() => 'Subtitle')
```

<a name="url"></a>
## URL

The `url()` method allows you to set a link for the card header.

```php
url(Closure|string $value)
```

- `$value` - *url* or closure.

```php
Card::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_1.jpg',
)
    ->url(static fn() => 'https://cutcode.dev')
```

<a name="thumbnail"></a>
## Thumbnails

To add a carousel of images to the card, you can use the `thumbnail()` method.

```php
thumbnail(Closure|string|array $value)
```

```php
Card::make(
    title: fake()->sentence(3),
)
    ->thumbnail([
        '/images/image_2.jpg',
        '/images/image_1.jpg',
    ])
```

<a name="values"></a>
## Values List

To add a list of values to the card, you can use the `values()` method.

```php
values(Closure|array $value)
```

- `$value` - an associative array of values or a closure.

```php
Card::make(
    title: fake()->sentence(3),
)
    ->values([
        'ID' => 1,
        'Author' => fake()->name(),
    ])
```
