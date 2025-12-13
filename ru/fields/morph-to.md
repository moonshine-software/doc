# MorphTo

Наследует [BelongsTo](/docs/{{version}}/fields/belongs-to).

\* имеет те же возможности.

Поле отношения в **Laravel** типа `MorphTo`.

```php
use MoonShine\Laravel\Fields\Relationships\MorphTo;

MorphTo::make('Commentable')->types([
    Article::class => 'title'
])
```

![morph_to](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/morph_to.png#light)
![morph_to_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/morph_to_dark.png#dark)

> [!NOTE]
> Требуется метод `types()`, указывающий доступные классы.

Описание значения метода `types`:

- Ключ - class-string<Model>
- Значение - строка или массив.

> [!NOTE]
> Если значение передаётся как строка, то она должна указывать на название поля, которое нужно отобразить.
> Если же передаётся как массив, то первый элемент массива — это название поля для отображения, а второй — имя отношения вместо названия модели.

```php
use MoonShine\Laravel\Fields\Relationships\MorphTo;

MorphTo::make('Imageable')->types([
    Company::class => ['short_name', 'Organization']
])
```

![morph_to_array](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/morph_to_array.png#light)
![morph_to_array_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/morph_to_array_dark.png#dark)

> [!WARNING]
> При использовании поля в сторонних ресурсах обязательно указывайте resource,
> иначе будет использоваться ресурс из запроса, что может привести к ошибкам.

```php
MorphTo::make('Commentable', resource: PolyCommentResource::class)->types([
    Post::class => 'name',
    Project::class => 'name',
])
```
