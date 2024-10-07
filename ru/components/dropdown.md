# Компонент Dropdown

- [Создание](#make)
- [Переключатель](#toggler)
- [Элементы](#items)
- [Поиск элементов](#search-item)
- [Содержимое](#content)
- [Расположение](#placement)

---

<a name="make"></a> 
## Создание

Компонент *Dropdown* позволяет создавать выпадающие блоки.

Вы можете создать *Dropdown*, используя статический метод `make()` класса `Dropdown`.

```php
make(
    ?string $title = null,
    Closure|string $toggler = '',
    Closure|View|string $content = '',
    bool $isSearchable = false,
    Closure|array $items = [],
    string $placement = 'bottom-start'
)
```

- `$title` - заголовок выпадающего списка,
- `$toggler` - переключатель,
- `$content` - содержимое,
- `$isSearchable` - поиск по элементам,
- `$items` - элементы блока,
- `$placement` - расположение выпадающего списка.

```php
use MoonShine\Components\Dropdown;
use MoonShine\Components\Link;

Dropdown::make(
    title: 'Заголовок',
    toggler: 'Нажми меня',
    items: [
        Link::make('#', 'Ссылка 1'),
        Link::make('#', 'Ссылка 2'),
        Link::make('#', 'Ссылка 3'),
    ],
    placement: 'top',
)
```

<a name="toggler"></a> 
## Переключатель

Метод `toggler()` позволяет указать элемент, при клике на который будет открываться `Dropdown`.

```php
toggler(Closure|string $toggler)
```

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\Dropdown;

Dropdown::make(
    title: 'Выпадающий список',
    content: fn() => fake()->text()
)
    ->toggler(fn() => ActionButton::make('Нажми меня'))

```

<a name="items"></a> 
## Элементы

Метод `items()` позволяет добавить элементы в выпадающий список.

```php
items(Closure|array $items)
```

```php
use MoonShine\Components\Dropdown;
use MoonShine\Components\Link;

Dropdown::make(
    toggler: 'Нажми меня',
)
    ->items([
        Link::make('#', 'Ссылка 1'),
        Link::make('#', 'Ссылка 2'),
        Link::make('#', 'Ссылка 3'),
    ])
```

<a name="search-item"></a> 
## Поиск элементов

Метод `searchable()` позволяет добавить поиск элементов в выпадающем списке.

```php
searchable(Closure|bool|null $condition = null)
```

```php
use MoonShine\Components\Dropdown;
use MoonShine\Components\Link;

Dropdown::make(
    toggler: 'Нажми меня',
)
    ->items([
        Link::make('#', 'Ссылка 1'),
        Link::make('#', 'Ссылка 2'),
        Link::make('#', 'Ссылка 3'),
    ])
    ->searchable()
```

#### Плейсхолдер

Метод `searchPlaceholder()` позволяет изменить плейсхолдер в поле поиска.

```php
searchPlaceholder(Closure|string $placeholder)
```

```php
use MoonShine\Components\Dropdown;
use MoonShine\Components\Link;

Dropdown::make(
    toggler: 'Нажми меня',
)
    ->items([
        Link::make('#', 'Ссылка 1'),
        Link::make('#', 'Ссылка 2'),
        Link::make('#', 'Ссылка 3'),
    ])
    ->searchable()
    ->searchPlaceholder('Поиск элемента')
```

<a name="content"></a> 
## Содержимое

Метод `content()` позволяет отобразить произвольное содержимое в раскрывающемся блоке.

```php
content(Closure|View|string $content)
```

```php
use MoonShine\Components\Dropdown;

Dropdown::make(
    toggler: 'Нажми меня',
)
    ->content(fake()->text())
```

<a name="placement"></a> 
## Расположение

Метод `placement()` позволяет изменить расположение выпадающего списка.

```php
placement(string $placement)
```

Доступные расположения:

- bottom (низ)
- top (верх)
- left (лево)
- right (право)

```php
use MoonShine\Components\Dropdown;

Dropdown::make(
    toggler: 'Нажми меня',
    content: fake()->text(),
)
    ->placement('right')
```

> [!NOTE]
> Дополнительные варианты расположения можно найти в официальной документации [tippy.js](https://atomiks.github.io/tippyjs/v6/all-props/#placement)
