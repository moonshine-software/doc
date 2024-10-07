# Компонент Card

- [Создание](#make)
- [Заголовок](#header)
- [Кнопки](#actions)
- [Подзаголовок](#subtitle)
- [Ссылка](#url)
- [Миниатюры](#thumbnail)
- [Список значений](#values)
- [Режим наложения](#overlay)

---

<a name="make"></a>
## Создание

Компонент *Card* позволяет создавать карточки элементов.

Вы можете создать *Card*, используя статический метод `make()` класса `Card`.

```php
make(
    Closure|string $title = '',
    Closure|string|array $thumbnail = '',
    Closure|string $url = '#',
    Closure|array $values = [],
    Closure|string|null $subtitle = null
)
```

- `$title` - заголовок карточки,
- `$thumbnail` - изображения,
- `$url` - ссылка,
- `$values` - список значений,
- `$subtitle` - подзаголовок.

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

<a name="header"></a>
## Заголовок

Метод `header()` позволяет установить заголовок для карточек.

```php
header(Closure|string $value)
```

- `$value` - столбец или замыкание, возвращающее html-код.
    
```php
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_2.jpg',
)
    ->header(static fn() => Badge::make('new', 'success'))
```

<a name="actions"></a>
## Кнопки

Чтобы добавить кнопки на карточку, вы можете использовать метод `actions()`.

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

<a name="subtitle"></a>
## Подзаголовок

```php
subtitle(Closure|string $value)
```

- `$value` - столбец или замыкание, возвращающее подзаголовок.

```php
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_2.jpg',
)
    ->subtitle(static fn() => 'Subtitle')
```

<a name="url"></a>
## Ссылка

Метод `url()` позволяет установить ссылку для заголовка карточки.

```php
url(Closure|string $value)
```

- `$value` - *url* или замыкание.

```php
Cards::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_1.jpg',
)
    ->url(static fn() => 'https://cutcode.dev')
```

<a name="thumbnail"></a>
## Миниатюры

Чтобы добавить карусель изображений на карточку, вы можете использовать метод `thumbnails()`.

```php
thumbnails(Closure|string|array $value)
```

```php
Cards::make(
    title: fake()->sentence(3),
)
    ->thumbnail(['/images/image_2.jpg','/images/image_1.jpg'])
```

<a name="values"></a>
## Список значений

Чтобы добавить список значений на карточку, вы можете использовать метод `values()`.

```php
values(Closure|array $value)
```

- `$value` - ассоциативный массив значений или замыкание.

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

<a name="overlay"></a>
## Режим наложения

Режим *overlay* позволяет разместить заголовок и заголовки поверх изображения карточки. Этот режим активируется методом `overlay()`.

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
