# Card

- [Основы](#basics)
- [Заголовок](#header)
- [Кнопки](#actions)
- [Подзаголовок](#subtitle)
- [Ссылка](#url)
- [Миниатюры](#thumbnail)
- [Список значений](#values)
- [Подписи значений](#value-labels)

---

<a name="basics"></a>
## Основы

Компонент `Card` позволяет создавать карточки элементов.

```php
make(
    Closure|string $title = '',
    Closure|array|string $thumbnail = '',
    Closure|string $url = '#',
    Closure|array $values = [],
    Closure|string|null $subtitle = null,
    bool $overlay = false,
    array $escapeValueLabels = [],
    ?bool $escapeLabel = null,
)
```

- `$title` - заголовок,
- `$thumbnail` - изображения,
- `$url` - ссылка,
- `$values` - список значений,
- `$subtitle` - подзаголовок,
- `$overlay` - режим overlay позволяет разместить шапку и заголовки поверх изображения карточки,
- `$escapeValueLabels` - настройки экранирования подписей отдельных ключей списка значений,
- `$escapeLabel` - экранирование подписей значений по умолчанию для этой карточки; `null` использует глобальную настройку.

~~~tabs
tab: Class
```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
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

@preview('card')

<a name="header"></a>
## Заголовок

Метод `header()` позволяет установить заголовок для карточек.

```php
header(Closure|string $value)
```

- `$value` - столбец или замыкание, возвращающее html-код.

```php
Card::make(
    title: fake()->sentence(3),
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
Card::make(
    title: fake()->sentence(3),
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
Card::make(
    title: fake()->sentence(3),
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
Card::make(
    title: fake()->sentence(3),
    thumbnail: '/images/image_1.jpg',
)
    ->url(static fn() => 'https://cutcode.dev')
```

<a name="thumbnail"></a>
## Миниатюры

Чтобы добавить карусель изображений на карточку, вы можете использовать метод `thumbnail()`.

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
## Список значений

Чтобы добавить список значений на карточку, вы можете использовать метод `values()`.

```php
values(Closure|array $value)
```

- `$value` - ассоциативный массив значений или замыкание.

```php
Card::make(
    title: fake()->sentence(3),
)
    ->values([
        'ID' => 1,
        'Author' => fake()->name(),
    ])
```

<a name="value-labels"></a>
## Подписи значений

Ключи списка значений экранируются согласно глобальной настройке `escapes.label`, включённой по умолчанию. Используйте `escapeValueLabels()`, чтобы переопределить экранирование для отдельных ключей. `false` разрешает HTML, а `true` включает экранирование даже при отключённом глобальном значении.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Components\Card;

Card::make(values: ['<strong>Author</strong>' => 'Alice'])
    ->escapeValueLabels(['<strong>Author</strong>' => false]);
```

Ключи в данных остаются неизменными. Настройка управляет подписями, а не значениями, отображаемыми рядом с ними.

Также можно передать `escapeLabel: false` в `Card::make()`, чтобы разрешить HTML во всех подписях значений этой карточки. Настройки отдельных ключей из `escapeValueLabels()` имеют приоритет. В Blade используйте `:escape-label` и `:escape-value-labels`. Переопределения `values`, `escapeLabel` и `escapeValueLabels`, переданные через `customView()`, также учитываются.
