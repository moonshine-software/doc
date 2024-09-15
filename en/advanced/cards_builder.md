https://moonshine-laravel.com/docs/resource/advanced/advanced-cards_builder?change-moonshine-locale=en

------
# CardsBuilder

  - [Basics](#basics)
  - [Items and fields](#items-fields)
  - [Casting](#cast)
  - [Header](#header)
  - [Content](#content)
  - [Title](#title)
  - [Subtitle](#subtitle)
  - [Thumbnail](#thumbnail)
  - [Buttons](#buttons)
  - [Overlay mode](#overlay)
  - [Paginator](#paginator)
  - [Asynchronous mode](#async)
  - [Attributes](#attributes)
  - [Columns](#columns)
  - [Custom component](#custom-component)

Extends [MoonShineComponent](https://moonshine-laravel.com/docs/resource/components/components-moonshine_component)
* has the same features

<a name="basics"></a>
## Basics

With *CardsBuilder* you can display a list of items as cards.  
You can also use *CardsBuilder* on your own pages or even outside of **MoonShine**.

```php
CardsBuilder::make(
    Fields|array $fields = [],
    protected iterable $items = []
)
```

- `$fields` - fields,
- `$items` - field values.

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

>![!NOTE]
>Elements and fields for *CardsBuilder* can be specified using the appropriate methods.

<a name="items-fields"></a>
## Items and fields

The `items()` method allows you to pass data to *CardsBuilder* for filling cards.

```php
items(iterable $items = [])
```

The `fields()` method allows you to pass *CardsBuilder* a list of fields to build a card.

```php
fields(Fields|Closure|array $fields)
```

```php
CardsBuilder::make()
    ->fields([Text::make('Text')])
    ->items([['text' => 'Value']])
```

>[!TIP]
>The correspondence of data with fields is carried out through the value [column](https://moonshine-laravel.com/docs/resource/fields/fields-index#make) fields!

<a name="cast"></a>
## Casting

The `cast()` method is used to cast table values to a specific type.  
Since by default fields work with primitive types:

```php
use MoonShine\TypeCasts\ModelCast;

CardsBuilder::make(items: User::paginate())
    ->fields([Text::make('Email')])
    ->cast(ModelCast::make(User::class))
```

In this example, we cast the data to the `User` model format using `ModelCast`.

>[!NOTE]
>For more detailed information, please refer to the section [TypeCasts](https://moonshine-laravel.com/docs/resource/advanced/advanced-type_casts" class="text-purple underline" link="https://moonshine-laravel.com/docs/resource/advanced/advanced-type_casts)

<a name="header"></a>
## Header

The `header()` method allows you to set the header for cards.

```php
header(Closure|string $value)
```

- `$value` - *column* or closure returning *html* code.

```php
CardsBuilder::make(
    items: Article::paginate()
)
    ->fields([Text::make('Text')])
    ->header(static fn() => Badge::make('new', 'success'))
```

<a name="content"></a>
## Content

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
## Title

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

#### Link

Using the `url()` method, you can set a link to the header.

```php
url(Closure|string $value)
```

```php
CardsBuilder::make(
    fields: [Text::make('Text')],
    items: Article::paginate()
)
    ->title('title')
    ->url(fn($data) => (new ArticleResource())->formPageUrl($data))
```

<a name="subtitle"></a>
## Subtitle

The `subtitle()` method allows you to set the subtitle of the card.

```php
subtitle(Closure|string $value)
```

- `$value` - *column* or a closure that returns a subtitle.

```php
CardsBuilder::make(
    items: Article::paginate()
)
    ->fields([Text::make('Text')])
    ->title('title')
    ->subtitle(static fn() => 'Subtitle')
```

<a name="thumbnail"></a>
## Thumbnail

To add an image to a card, you can use the `thumbnail()` method.  
As an argument, the methods take the value of a column field or a closure that returns the *url* of the image.

```php
thumbnail(Closure|string $value)
```

```php
CardsBuilder::make(
    items: Article::paginate()
)
    ->fields([Text::make('Text')])
    ->thumbnail('thumbnail')
```

![image_1](https://moonshine-laravel.com/images/image_1.jpg)
![image_2](https://moonshine-laravel.com/images/image_2.jpg)

<a name="buttons"></a>
## Buttons

To add buttons based on *ActionButton*, use the `buttons()` method.

```php
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->cast(ModelCast::make(Article::class))
    ->buttons([
        ActionButton::make('Delete', route('name.delete')),
        ActionButton::make('Edit', route('name.edit'))->showInDropdown(),
        ActionButton::make('Go to home', route('home'))->blank()->canSee(fn($data) => $data->active)
    ])
```

<a name="overlay"></a>
## Overlay mode

The *overlay* mode allows you to place the header and headings on top of the card image.  
This mode is activated by the `overlay()` method of the same name.

```php
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Text::make('Text')])
    ->cast(ModelCast::make(Article::class))
    ->thumbnail('thumbnail')
    ->header(static fn() => Badge::make('new', 'success'))
    ->title('title')
    ->subtitle(static fn() => 'Subtitle')
    ->overlay()
```



![image_1](https://moonshine-laravel.com/images/image_1.jpg)
![image_2](https://moonshine-laravel.com/images/image_2.jpg)

<a name="paginator"></a>
## Paginator

The `paginator()` method for the table to work with pagination.

```php
$paginator = Article::paginate();

CardsBuilder::make()
    ->fields([Text::make('Text')])
    ->items($paginator->items())
    ->paginator($paginator)
```

Or directly pass the paginator:

```php
CardsBuilder::make(
    items: Article::paginate()
)
    ->fields([Text::make('Text')])
```

<a name="async"></a>
## Asynchronous mode

If you need to receive data asynchronously (for example, during pagination), then use the `async()` method.

```php
async(
    ?string $asyncUrl = null,
    string|array|null $asyncEvents = null,
    ?string $asyncCallback = null
)
```

- `asyncUrl` - request url (by default, the request is sent to the current url),
- `asyncEvents` - events called after a successful request,
- `asyncCallback` - js callback function after receiving a response.


```php
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->async()
```

After a successful request, you can raise events by adding the `asyncEvents` parameter.

```php
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->name('crud')
    ->async(asyncEvents: ['cards-updated-crud'])
```

MoonShine already has a set of ready-made events:

- `table-updated-{name}` - asynchronous table update by name
- `cards-updated-{name}` - asynchronous update of a group of cards by name,
- `form-reset-{name}` - reset form values by name,
- `fragment-updated-{name}` - updating blade fragment by name.

>[!NOTE]
>To trigger an event, you must specify a unique [component name](https://moonshine-laravel.com/docs/resource/components/components-moonshine_component#name)!

<a name="attributes"></a>
## Attributes

You can set any html attributes for the table using the `customAttributes()` method:

```php
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->customAttributes(['class' => 'custom-cards'])
```

<a name="columns"></a>
## Columns

The `columnSpan()` method allows you to set the width of the cards in the *Grid*.

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

>![NOTE]
>The **MoonShine** admin panel uses a 12-column grid.

<a name="custom-component"></a>
## Custom component

The *CardsBuilder* component allows you to override the component for building a list of an element.  
To do this, you need to use the `customComponent()` method.

```php
CardsBuilder::make(
    fields: [Text::make('Text')],
    items: Article::paginate()
)
    ->customComponent(function (Article $article, int $index, CardsBuilder $builder) {
        return Badge::make($index + 1 . "." . $article->title, 'green');
    })
```
