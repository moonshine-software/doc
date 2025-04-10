# CardsBuilder

- [Основы](#basics)
- [Основное использование](#basic-usage)
- [Основные методы](#basic-methods)
  - [Элементы и поля](#items-fields)
  - [Пагинация](#paginator)
- [Отображение](#view-methods)
  - [Содержимое](#content)
  - [Название](#title)
  - [Подзаголовок](#subtitle)
  - [Миниатюра](#thumbnail)
  - [Режим наложения](#overlay)
  - [Заголовок](#header)
  - [Кнопки](#buttons)
  - [Колонки](#columns)
  - [Пользовательский компонент](#custom-component)
- [Асинхронный режим](#async)
- [Приведение к типу](#type-cast)
- [Использование в blade](#blade)

---

<a name="basics"></a>
## Основы

С помощью `CardsBuilder` вы можете отображать список элементов в виде карточек.
Вы также можете использовать `CardsBuilder` на своих собственных страницах или даже за пределами **MoonShine**.

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

- `$fields` - поля,
- `$items` - значения полей.

<a name="basic-usage"></a>
## Основное использование

Пример использования `CardsBuilder`:

```php
CardsBuilder::make(
    [
        ['id' => 1, 'title' => 'Заголовок 1'],
        ['id' => 2, 'title' => 'Заголовок 2'],
    ],
    [
        ID::make(),
        Text::make('title')
    ]
)
```

> [!NOTE]
> Элементы и поля для `CardsBuilder` можно указать с помощью соответствующих методов.

<a name="basic-methods"></a>
## Основные методы

<a name="items-fields"></a>
### Элементы и поля

Метод `items()` позволяет передать `CardsBuilder` данные для заполнения карточек.

```php
items(iterable $items = [])
```

Метод `fields()` позволяет передать `CardsBuilder` список полей для построения карточки.

```php
fields(FieldsContract|Closure|iterable $fields)
```

```php
CardsBuilder::make()
    ->fields([Text::make('Text')])
    ->items([['text' => 'Value']])
```

<a name="paginator"></a>
### Пагинация

Метод `paginator` устанавливает пагинатор. Необходимо передать объект, реализующий интерфейс `MoonShine\Contracts\Core\Paginator\PaginatorContract`.

> [!NOTE]
> Если необходимо указать пагинатор для `QueryBuilder`, можно воспользоваться встроенным `ModelCaster`, как в примере ниже.

```php
->paginator(
  (new ModelCaster(Article::class))
    ->paginatorCast(
        Article::query()->paginate()
    )
)
```

> [!NOTE]
> Пагинатор также можно указать через метод или параметр `items`.

<a name="view-methods"></a>
## Отображение

<a name="content"></a>
### Содержимое

Методы `content()` используются для добавления произвольного содержимого в карточку.

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
### Название

Метод `title()` позволяет установить название карточки.

```php
title(Closure|string $value)
```

- `$value` - *column* или замыкание, возвращающее название.

```php
CardsBuilder::make(
    fields: [Text::make('Text')],
    items: Article::paginate()
)
    ->title('title')
```

### Ссылка

С помощью метода `url()` можно установить ссылку на заголовок.

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
### Подзаголовок

Метод `subtitle()` позволяет установить подзаголовок карточки.

```php
subtitle(Closure|string $value)
```

- `$value` - *column* или замыкание, возвращающее подзаголовок.

```php
CardsBuilder::make(
    items: Article::paginate()
)
    ->fields([Text::make('Text')])
    ->title('title')
    ->subtitle(static fn() => 'Subtitle')
```

<a name="thumbnail"></a>
### Миниатюра

Чтобы добавить изображение в карточку, можно использовать метод `thumbnail()`.
В качестве аргумента методы принимают значение поля колонки или замыкание, возвращающее `url` изображения.

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
### Режим наложения

Режим `overlay` позволяет разместить заголовок и названия поверх изображения карточки.
Этот режим активируется одноименным методом `overlay()`.

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
### Заголовок

Метод `header()` позволяет установить заголовок для карточек.

> [!NOTE]
> Работает только при наличии `thumbnail` и в режиме `overlay`.

```php
header(Closure|string $value)
```

- `$value` - `column` или замыкание, возвращающее `html` код.

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
### Кнопки

Для добавления кнопок на основе `ActionButton` используйте метод `buttons()`.

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
### Колонки

Метод `columnSpan()` позволяет задать ширину карточек в `Grid`.

```php
columnSpan(
    int $columnSpan,
    int $adaptiveColumnSpan = 12
)
```

- `$columnSpan` - значение для десктопной версии,
- `$adaptiveColumnSpan` - значение для мобильной версии.

```php
CardsBuilder::make(
    fields: [Text::make('Text')],
    items: Article::paginate()
)
    ->columnSpan(3)
```

> [!NOTE]
> В админ-панели **MoonShine** используется 12-колоночная сетка.

<a name="custom-component"></a>
### Пользовательский компонент

Компонент `CardsBuilder` позволяет переопределить компонент для построения списка элемента.
Для этого нужно воспользоваться методом `customComponent()`.

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
## Асинхронный режим

Если вам нужно получать данные асинхронно (например, при пагинации), то используйте метод `async()`.

> [!NOTE]
> Метод `async` должен быть после метода `name`

```php
->async(
  Closure|string|null $url = null,
  string|array|null $events = null,
  ?AsyncCallback $callback = null,
)
```

- `$url` - URL асинхронного запроса (в ответе необходимо вернуть `TableBuilder`),
- `$events` - события, которые будут вызваны после успешного ответа,
- `$callback` - JS callback, который можно добавить как обертку ответа.

```php
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->name('my-cards')
    ->async()
```

После успешного запроса вы можете вызывать события, добавив параметр `events`.

```php
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->name('crud')
    ->async(events: [AlpineJs::event(JsEvent::CARDS_UPDATED, 'crud')])
```

> [!NOTE]
> Для получения дополнительной информации о js событиях обратитесь к разделу [Events](/docs/{{version}}/frontend/events).

> [!NOTE]
> Для срабатывания события необходимо указать уникальное имя компонента!

<a name="type-cast"></a>
## Приведение к типу

Метод `cast()` служит для приведения значений к определенному типу.
Так как по умолчанию поля работают с примитивными типами:

```php
use MoonShine\Laravel\TypeCasts\ModelCaster;

CardsBuilder::make()
    ->cast(new ModelCaster(User::class))
```

В этом примере мы привели данные к формату модели `User` с использованием `ModelCaster`.

> [!NOTE]
> За более подробной информацией обратитесь к разделу [TypeCasts](/docs/{{version}}/advanced/type-casts).

<a name="blade"></a>
## Использование в blade

<a name="blade-basics"></a>
### Основы

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
> Реализуется на основе нескольких компонентов, подробнее в разделах:
> [Card](/docs/{{version}}/components/card),
> [Grid](/docs/{{version}}/components/grid),
> [Column](/docs/{{version}}/components/column).
