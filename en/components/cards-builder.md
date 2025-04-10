# CardsBuilder

- [Basics](#basics)
- [Basic Usage](#basic-usage)
- [Basic Methods](#basic-methods)
  - [Items and Fields](#items-fields)
  - [Paginator](#paginator)
- [View Methods](#view-methods)
  - [Content](#content)
  - [Title](#title)
  - [Subtitle](#subtitle)
  - [Thumbnail](#thumbnail)
  - [Overlay](#overlay)
  - [Header](#header)
  - [Buttons](#buttons)
  - [Columns](#columns)
  - [Custom Component](#custom-component)
- [Async Mode](#async)
- [Type Casting](#type-cast)
- [Usage in Blade](#blade)

---

<a name="basics"></a>
## Basics

With `CardsBuilder`, you can display a list of items in the form of cards.
You can also use `CardsBuilder` on your own pages or even outside **MoonShine**.

~~~tabs
tab: Class
```php
use MoonShine\UI\Components\CardsBuilder;

CardsBuilder::make(iterable $items = [], FieldsContract|iterable $fields = [])
```
tab: Blade
```blade
<x-moonshine::layout.grid>
    <x-moonshine::layout.column colSpan="4" adaptiveColSpan="12">
        <x-moonshine::card
            url="#"
            thumbnail="/images/image_1.jpg"
            :title="fake()->sentence(3)"
            :subtitle="date('d.m.Y')"
            :values="['ID' => 1, 'Author' => fake()->name()]"
        >
            <x-slot:header>
                <x-moonshine::badge color="green">new</x-moonshine::badge>
            </x-slot:header>

            {{ fake()->text() }}

            <x-slot:actions>
                <x-moonshine::link-button href="#">Read more</x-moonshine::link-button>
            </x-slot:actions>
        </x-moonshine::card>
    </x-moonshine::layout.column>
</x-moonshine::layout.grid>
```
~~~

- `$fields` - fields,
- `$items` - field values.

<a name="basic-usage"></a>
## Basic Usage

Example of using `CardsBuilder`:

```php
CardsBuilder::make(
    [
        ['id' => 1, 'title' => 'Title 1'],
        ['id' => 2, 'title' => 'Title 2'],
    ],
    [
        ID::make(),
        Text::make('title')
    ]
)
```

> [!NOTE]
> Items and fields for `CardsBuilder` can be specified using the corresponding methods.

<a name="basic-methods"></a>
## Basic Methods

<a name="items-fields"></a>
### Items and Fields

The `items()` method allows you to pass data to `CardsBuilder` to fill the cards.

```php
items(iterable $items = [])
```

The `fields()` method allows you to pass a list of fields to `CardsBuilder` for building the card.

```php
fields(FieldsContract|Closure|iterable $fields)
```

```php
CardsBuilder::make()
    ->fields([Text::make('Text')])
    ->items([['text' => 'Value']])
```

<a name="paginator"></a>
### Paginator

The `paginator` method sets the paginator. You need to pass an object that implements the `MoonShine\Contracts\Core\Paginator\PaginatorContract` interface.

> [!NOTE]
> If you need to specify a paginator for `QueryBuilder`, you can use the built-in `ModelCaster`, as in the example below.

```php
->paginator(
  (new ModelCaster(Article::class))
    ->paginatorCast(
        Article::query()->paginate()
    )
)
```

> [!NOTE]
> The paginator can also be specified through a method or the `items` parameter.

<a name="view-methods"></a>
## View Methods

<a name="content"></a>
### Content

The `content()` methods are used to add arbitrary content to the card.

```php
content(Closure|string $value)
```

```php
CardsBuilder::make(
    fields: [Text::make('Text')],
    items: Article::paginate()
)
    ->content('Custom content')
```

<a name="title"></a>
### Title

The `title()` method allows you to set the title of the card.

```php
title(Closure|string $value)
```

- `$value` - *column* or a closure that returns the title.

```php
CardsBuilder::make(
    fields: [Text::make('Text')],
    items: Article::paginate()
)
    ->title('title')
```

### URL

The `url()` method allows you to set a link for the title.

```php
url(Closure|string $value)
```

```php
CardsBuilder::make(
    fields: [Text::make('Text')],
    items: Article::paginate()
)
    ->title('title')
    ->url(fn($data) => $this->getFormPageUrl($data))
```

<a name="subtitle"></a>
### Subtitle

The `subtitle()` method allows you to set the subtitle of the card.

```php
subtitle(Closure|string $value)
```

- `$value` - *column* or a closure that returns the subtitle.

```php
CardsBuilder::make(
    items: Article::paginate()
)
    ->fields([Text::make('Text')])
    ->title('title')
    ->subtitle(static fn() => 'Subtitle')
```

<a name="thumbnail"></a>
### Thumbnail

To add an image to the card, you can use the `thumbnail()` method.
As an argument, the method accepts a value of the column field or a closure that returns the `url` of the image.

```php
thumbnail(Closure|string $value)
```

```php
CardsBuilder::make(
    items: Article::paginate()
)
    ->fields([Text::make('Text')])
    ->thumbnail('thumbnail')
    // or by url
    // ->thumbnail(fn() => 'https://example.com/image.png')
```

<a name="overlay"></a>
### Overlay Mode

The `overlay` mode allows you to place the title and subtitles on top of the card image.
This mode is activated using the method `overlay()`.

```php
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Text::make('Text')])
    ->cast(new ModelCaster(Article::class))
    ->thumbnail('thumbnail')
    ->header(static fn() => Badge::make('new', 'success'))
    ->title('title')
    ->subtitle(static fn() => 'Subtitle')
    ->overlay()
```

<a name="header"></a>
### Header

The `header()` method allows you to set a header for the cards.

> [!NOTE]
> Works only when `thumbnail` is present and in `overlay` mode.

```php
header(Closure|string $value)
```

- `$value` - `column` or a closure that returns `html` code.

```php
CardsBuilder::make()
    ->items(Article::paginate())
    ->thumbnail('image')
    ->overlay()
    ->fields([Text::make('Text')])
    ->header(static fn() => Badge::make('new', 'success'))
    // or by column
    // ->header('title')
```

<a name="buttons"></a>
### Buttons

To add buttons based on `ActionButton`, use the `buttons()` method.

```php
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->cast(new ModelCaster(Article::class))
    ->buttons([
        ActionButton::make('Delete', route('name.delete')),
        ActionButton::make('Edit', route('name.edit'))->showInDropdown(),
        ActionButton::make('Go to Home', route('home'))->blank()->canSee(fn($data) => $data->active),
    ])
```

<a name="columns"></a>
### Columns

The `columnSpan()` method allows you to set the width of the cards in `Grid`.

```php
columnSpan(
    int $columnSpan,
    int $adaptiveColumnSpan = 12
)
```

- `$columnSpan` - value for the desktop version,
- `$adaptiveColumnSpan` - value for the mobile version.

```php
CardsBuilder::make(
    fields: [Text::make('Text')],
    items: Article::paginate()
)
    ->columnSpan(3)
```

> [!NOTE]
> The **MoonShine** admin panel uses a 12-column grid.

<a name="custom-component"></a>
### Custom Component

The `CardsBuilder` component allows you to override the component for building the item list.
To do this, use the `customComponent()` method.

```php
CardsBuilder::make(
    fields: [Text::make('Text')],
    items: Article::paginate()
)
    ->customComponent(function (Article $article, int $index, CardsBuilder $builder) {
        return Badge::make($index + 1 . "." . $article->title, 'green');
    })
```

<a name="async"></a>
## Async Mode

If you need to fetch data asynchronously (for example, during pagination), use the `async()` method.

> [!NOTE]
> The `async` method should be after the `name` method

```php
->async(
  Closure|string|null $url = null,
  string|array|null $events = null,
  ?AsyncCallback $callback = null,
)
```

- `$url` - URL for the asynchronous request (the response must return `TableBuilder`),
- `$events` - events that will be triggered after a successful response,
- `$callback` - JS callback that can be added as a wrapper for the response.

```php
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->name('my-cards')
    ->async()
```

After a successful request, you can trigger events by adding the `events` parameter.

```php
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->name('crud')
    ->async(events: [AlpineJs::event(JsEvent::CARDS_UPDATED, 'crud')])
```

> [!NOTE]
> For more information about JS events, refer to the [Events](/docs/{{version}}/frontend/events) section.

> [!NOTE]
> To trigger the event, you must specify a unique component name!

<a name="type-cast"></a>
## Type Casting

The `cast()` method is used to cast values to a specific type.
Because by default, fields work with primitive types:

```php
use MoonShine\Laravel\TypeCasts\ModelCaster;

CardsBuilder::make()
    ->cast(new ModelCaster(User::class))
```

In this example, we cast the data to the format of the `User` model using `ModelCaster`.

> [!NOTE]
> For more detailed information, refer to the [TypeCasts](/docs/{{version}}/advanced/type-casts) section.

<a name="blade"></a>
## Usage in Blade

<a name="blade-basics"></a>
### Basics

```blade
<x-moonshine::layout.grid>
    <x-moonshine::layout.column colSpan="4" adaptiveColSpan="12">
        <x-moonshine::card
            url="#"
            thumbnail="/images/image_1.jpg"
            :title="fake()->sentence(3)"
            :subtitle="date('d.m.Y')"
            :values="['ID' => 1, 'Author' => fake()->name()]"
        >
            <x-slot:header>
                <x-moonshine::badge color="green">new</x-moonshine::badge>
            </x-slot:header>

            {{ fake()->text() }}

            <x-slot:actions>
                <x-moonshine::link-button href="#">Read more</x-moonshine::link-button>
            </x-slot:actions>
        </x-moonshine::card>
    </x-moonshine::layout.column>
</x-moonshine::layout.grid>
```

> [!NOTE]
> Implemented based on several components, more details in the sections:
> [Card](/docs/{{version}}/components/card),
> [Grid](/docs/{{version}}/components/grid),
> [Column](/docs/{{version}}/components/column).
