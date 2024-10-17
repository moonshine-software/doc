# Dropdown Component

- [Make](#make)
- [Toggler](#toggler)
- [Items](#items)
- [Search item](#search-item)
- [Content](#content)
- [Placement](#placement)

---

<a name="make"></a> 
## Make

The *Dropdown* component allows you to create drop-down blocks.

You can create a *Dropdown* using the static `make()` method class `Dropdown`.

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

- `$title` - title of the dropdown,
- `$toggler` - switch,
- `$content` - content
- `$isSearchable` - search by elements
- `$items` - block elements,
- `$placement` - location of the dropdown.

```php
use MoonShine\Components\Dropdown;
use MoonShine\Components\Link;

Dropdown::make(
    title: 'Title',
    toggler: 'Click me',
    items: [
        Link::make('#', 'Link 1'),
        Link::make('#', 'Link 2'),
        Link::make('#', 'Link 3'),
    ],
    placement: 'top',
)
```

<a name="toggler"></a> 
## Toggler

The `toggler()` method allows you to specify an element that, when clicked, will open `Dropdown`.

```php
toggler(Closure|string $toggler)
```

```php
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\Dropdown;

Dropdown::make(
    title: 'Dropdown',
    content: fn() => fake()->text()
)
    ->toggler(fn() => ActionButton::make('Click me'))

```

<a name="items"></a> 
## Items

The `items()` method allows you to add items to the dropdown list.

```php
items(Closure|array $items)
```

```php
use MoonShine\Components\Dropdown;
use MoonShine\Components\Link;

Dropdown::make(
    toggler: 'Click me',
)
    ->items([
        Link::make('#', 'Link 1'),
        Link::make('#', 'Link 2'),
        Link::make('#', 'Link 3'),
    ])
```

<a name="search-item"></a> 
## Search item

The `searchable()` method allows you to add a search for elements in the dropdown.

```php
searchable(Closure|bool|null $condition = null)
```

```php
use MoonShine\Components\Dropdown;
use MoonShine\Components\Link;

Dropdown::make(
    toggler: 'Click me',
)
    ->items([
        Link::make('#', 'Link 1'),
        Link::make('#', 'Link 2'),
        Link::make('#', 'Link 3'),
    ])
    ->searchable()
```

#### Placeholder

The `searchPlaceholder()` method allows you to change the placeholder in the search field.

```php
searchPlaceholder(Closure|string $placeholder)
```

```php
use MoonShine\Components\Dropdown;
use MoonShine\Components\Link;

Dropdown::make(
    toggler: 'Click me',
)
    ->items([
        Link::make('#', 'Link 1'),
        Link::make('#', 'Link 2'),
        Link::make('#', 'Link 3'),
    ])
    ->searchable()
    ->searchPlaceholder('Search item')
```

<a name="content"></a> 
## Content

The `content()` method allows you to display arbitrary content in the revealing block.

```php
content(Closure|View|string $content)
```

```php
use MoonShine\Components\Dropdown;

Dropdown::make(
    toggler: 'Click me',
)
    ->content(fake()->text())
```

<a name="placement"></a> 
## Placement

The `placement()` method allows you to change the location of the dropdown.


```php
placement(string $placement)
```

Available locations:

- bottom
- top
- left
- right

```php
use MoonShine\Components\Dropdown;

Dropdown::make(
    toggler: 'Click me',
    content: fake()->text(),
)
    ->placement('right')
```

> [!NOTE]
> Additional location options can be found in the official documentation [tippy.js](https://atomiks.github.io/tippyjs/v6/all-props/#placement)
