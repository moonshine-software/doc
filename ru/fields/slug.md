# Slug

- [Основы](#basics)
- [Генерация slug](#from)
- [Разделитель](#separator)
- [Локаль](#locale)
- [Уникальные значения](#unique)
- [Динамический slug](#live)

---

<a name="basics"></a>
## Основы

Наследует [Text](/docs/{{version}}/fields/text).

\* имеет те же возможности

> [!NOTE]
> Поле зависит от модели Eloquent

С помощью данного поля вы можете генерировать slug на основе выбранного поля, а также сохранять только уникальные значения.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Fields\Slug;

Slug::make('Slug')
```

@preview('fields.text')

<a name="from"></a>
## Генерация slug

Через метод `from()` можно указать на основе какого поля модели генерировать slug, при отсутствии значения.

```php
from(string $from)
```

```php
Slug::make('Slug')
    ->from('title')
```

<a name="separator"></a>
## Разделитель

По умолчанию в качестве разделителя слов при генерации slug используется `-` , метод `separator()` позволяет изменить это значение.

```php
separator(string $separator)
```

```php
Slug::make('Slug')
    ->separator('_')
```

<a name="locale"></a>
## Локаль

По умолчанию при генерации slug учитывается заданная локаль приложения.
Метод `locale()` позволяет изменить данное поведения для поля.

```php
locale(string $local)
```

```php
Slug::make('Slug')
    ->locale('ru')
```

<a name="unique"></a>
## Уникальные значения

Если необходимо сохранять только уникальные slug, то необходимо воспользоваться методом `unique()`.

```php
unique()
```

```php
Slug::make('Slug')
    ->unique()
```

<a name="live"></a>
## Динамический slug

Метод `live()` позволяет создать динамическое поле, которое будет отслеживать изменения в исходном поле.

```php
Text::make('Title')
    ->reactive(),
Slug::make('Slug')
    ->from('title')
    ->live()
```

Также поддерживается lazy режим.

```php
Text::make('Title')
    ->reactive(lazy: true),
Slug::make('Slug')
    ->from('title')
    ->live(lazy: true)
```

> [!NOTE]
> Динамичность основана на [реактивности полей](/docs/{{version}}/fields/basic-methods#reactive).
