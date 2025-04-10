# Slug

- [Basics](#basics)
- [Slug Generation](#from)
- [Separator](#separator)
- [Locale](#locale)
- [Unique Values](#unique)
- [Dynamic slug](#live)

---

<a name="basics"></a>
## Basics

Inherits from [Text](/docs/{{version}}/fields/text).

\* has the same capabilities

> [!NOTE]
> The field depends on the Eloquent model

This field allows you to generate a slug based on the selected field and to save only unique values.

```php
use MoonShine\Laravel\Fields\Slug;

Slug::make('Slug')
```

![slug](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/slug.png#light)
![slug_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/slug_dark.png#dark)

<a name="from"></a>
## Slug Generation

Through the `from()` method, you can specify which field of the model to generate the slug from, in case of an absence of a value.

```php
from(string $from)
```

```php
Slug::make('Slug')
    ->from('title')
```

<a name="separator"></a>
## Separator

By default, the word separator when generating the slug is `-`, and the `separator()` method allows you to change this value.

```php
separator(string $separator)
```

```php
Slug::make('Slug')
    ->separator('_')
```

<a name="locale"></a>
## Locale

By default, slug generation takes into account the application's set locale.
The `locale()` method allows you to change this behavior for the field.

```php
locale(string $local)
```

```php
Slug::make('Slug')
    ->locale('ru')
```

<a name="unique"></a>
## Unique Values

If you need to save only unique slugs, you should make use of the `unique()` method.

```php
unique()
```

```php
Slug::make('Slug')
    ->unique()
```

<a name="live"></a>
## Dynamic slug

The `live()` method allows you to create a dynamic field that will track changes in the source field.

```php
Text::make('Title')
    ->reactive(),
Slug::make('Slug')
    ->from('title')
    ->live()
```

> [!NOTE]
> Dynamism is based on [reactivity of fields](/docs/{{version}}/fields/basic-methods#reactive).
