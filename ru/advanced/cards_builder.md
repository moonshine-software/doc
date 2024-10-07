# CardsBuilder

  - [Основы](#basics)
  - [Элементы и поля](#items-fields)
  - [Приведение типов](#cast)
  - [Заголовок](#header)
  - [Содержимое](#content)
  - [Название](#title)
  - [Подзаголовок](#subtitle)
  - [Миниатюра](#thumbnail)
  - [Кнопки](#buttons)
  - [Режим наложения](#overlay)
  - [Пагинатор](#paginator)
  - [Асинхронный режим](#async)
  - [Атрибуты](#attributes)
  - [Колонки](#columns)
  - [Пользовательский компонент](#custom-component)

---

Расширяет [MoonShineComponent](https://moonshine-laravel.com/docs/resource/components/components-moonshine_component)
* имеет те же функции

<a name="basics"></a>
## Основы

С помощью *CardsBuilder* вы можете отображать список элементов в виде карточек.  
Вы также можете использовать *CardsBuilder* на своих собственных страницах или даже за пределами **MoonShine**.

```php
CardsBuilder::make(
    Fields|array $fields = [],
    protected iterable $items = []
)
```

- `$fields` - поля,
- `$items` - значения полей.

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
> Элементы и поля для *CardsBuilder* можно указать с помощью соответствующих методов.

<a name="items-fields"></a>
## Элементы и поля

Метод `items()` позволяет передать *CardsBuilder* данные для заполнения карточек.

```php
items(iterable $items = [])
```

Метод `fields()` позволяет передать *CardsBuilder* список полей для построения карточки.

```php
fields(Fields|Closure|array $fields)
```

```php
CardsBuilder::make()
    ->fields([Text::make('Text')])
    ->items([['text' => 'Значение']])
```

> [!TIP]
> Соответствие данных с полями осуществляется через значение [column](https://moonshine-laravel.com/docs/resource/fields/fields-index#make) полей!

<a name="cast"></a>
## Приведение типов

Метод `cast()` используется для приведения значений таблицы к определенному типу.  
Поскольку по умолчанию поля работают с примитивными типами:

```php
use MoonShine\TypeCasts\ModelCast;

CardsBuilder::make(items: User::paginate())
    ->fields([Text::make('Email')])
    ->cast(ModelCast::make(User::class))
```

В этом примере мы приводим данные к формату модели `User` с помощью `ModelCast`.

> [!NOTE]
> Для более подробной информации обратитесь к разделу [TypeCasts](https://moonshine-laravel.com/docs/resource/advanced/advanced-type_casts)

<a name="header"></a>
## Заголовок

Метод `header()` позволяет установить заголовок для карточек.

```php
header(Closure|string $value)
```

- `$value` - *column* или замыкание, возвращающее *html* код.

```php
CardsBuilder::make(
    items: Article::paginate()
)
    ->fields([Text::make('Text')])
    ->header(static fn() => Badge::make('new', 'success'))
```

<a name="content"></a>
## Содержимое

Методы `content()` используются для добавления произвольного содержимого в карточку.

```php
content(Closure|string $value)
```

```php
CardsBuilder::make(
    fields: [Text::make('Text')],
    items: Article::paginate()
)
    ->content('Пользовательское содержимое')
```

<a name="title"></a>
## Название

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

#### Ссылка

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
    ->url(fn($data) => (new ArticleResource())->formPageUrl($data))
```

<a name="subtitle"></a>
## Подзаголовок

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
    ->subtitle(static fn() => 'Подзаголовок')
```

<a name="thumbnail"></a>
## Миниатюра

Чтобы добавить изображение в карточку, можно использовать метод `thumbnail()`.  
В качестве аргумента методы принимают значение поля колонки или замыкание, возвращающее *url* изображения.

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

<a name="buttons"></a>
## Кнопки

Для добавления кнопок на основе *ActionButton* используйте метод `buttons()`.

```php
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->cast(ModelCast::make(Article::class))
    ->buttons([
        ActionButton::make('Удалить', route('name.delete')),
        ActionButton::make('Редактировать', route('name.edit'))->showInDropdown(),
        ActionButton::make('Перейти на главную', route('home'))->blank()->canSee(fn($data) => $data->active)
    ])
```

<a name="overlay"></a>
## Режим наложения

Режим *overlay* позволяет разместить заголовок и названия поверх изображения карточки.  
Этот режим активируется одноименным методом `overlay()`.

```php
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Text::make('Text')])
    ->cast(ModelCast::make(Article::class))
    ->thumbnail('thumbnail')
    ->header(static fn() => Badge::make('new', 'success'))
    ->title('title')
    ->subtitle(static fn() => 'Подзаголовок')
    ->overlay()
```

<a name="paginator"></a>
## Пагинатор

Метод `paginator()` для работы таблицы с пагинацией.

```php
$paginator = Article::paginate();

CardsBuilder::make()
    ->fields([Text::make('Text')])
    ->items($paginator->items())
    ->paginator($paginator)
```

Или напрямую передать пагинатор:

```php
CardsBuilder::make(
    items: Article::paginate()
)
    ->fields([Text::make('Text')])
```

<a name="async"></a>
## Асинхронный режим

Если вам нужно получать данные асинхронно (например, при пагинации), то используйте метод `async()`.

```php
async(
    ?string $asyncUrl = null,
    string|array|null $asyncEvents = null,
    ?string $asyncCallback = null
)
```

- `asyncUrl` - url запроса (по умолчанию запрос отправляется на текущий url),
- `asyncEvents` - события, вызываемые после успешного запроса,
- `asyncCallback` - js функция обратного вызова после получения ответа.


```php
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->async()
```

После успешного запроса вы можете поднимать события, добавив параметр `asyncEvents`.

```php
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->name('crud')
    ->async(asyncEvents: ['cards-updated-crud'])
```

MoonShine уже имеет набор готовых событий:

- `table-updated-{name}` - асинхронное обновление таблицы по имени
- `cards-updated-{name}` - асинхронное обновление группы карточек по имени,
- `form-reset-{name}` - сброс значений формы по имени,
- `fragment-updated-{name}` - обновление blade фрагмента по имени.

> [!NOTE]
> Для срабатывания события необходимо указать уникальное [имя компонента](https://moonshine-laravel.com/docs/resource/components/components-moonshine_component#name)!

<a name="attributes"></a>
## Атрибуты

Вы можете установить любые html-атрибуты для таблицы с помощью метода `customAttributes()`:

```php
CardsBuilder::make()
    ->items(Article::paginate())
    ->fields([ID::make(), Switcher::make('Active')])
    ->customAttributes(['class' => 'custom-cards'])
```

<a name="columns"></a>
## Колонки

Метод `columnSpan()` позволяет задать ширину карточек в *Grid*.

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
## Пользовательский компонент

Компонент *CardsBuilder* позволяет переопределить компонент для построения списка элемента.  
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
