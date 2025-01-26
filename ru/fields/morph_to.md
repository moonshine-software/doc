# MorphTo

Расширяет [BelongsTo](/docs/{{version}}/fields/belongs_to)
* имеет те же функции    

Поле отношения MorphTo в Laravel

То же самое, что `MoonShine\Fields\Relationships\BelongsTo`, только для отношений MorphTo

```php
use MoonShine\Fields\Relationships\MorphTo; 
 
//...
 
public function fields(): array
{
    return [
        MorphTo::make('Commentable')->types([
            Article::class => 'title'
        ]), 
    ];
}
//...
```

![morph_to](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/morph_to.png#light)
![morph_to_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/morph_to_dark.png#dark)

> [!TIP]
> Требуется метод `types`, указывающий доступные классы.

Описание значения метода `types`:

Ключ - это ссылка на модель
Значение - строка или массив.

> [!TIP]
> Если значение передается как строка, оно должно указывать имя поля для отображения. Если оно передается как массив, то первый элемент массива - это имя поля для отображения, а второй - имя отношения вместо имени модели.

```php
use MoonShine\Fields\Relationships\MorphTo; 
 
//...
 
public function fields(): array
{
    return [
        MorphTo::make('Imageable')->types([
            Company::class => ['short_name', 'Organization']
        ]), 
    ];
}
//...
```

![morph_to_array](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/morph_to_array.png#light)
![morph_to_array_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/morph_to_array_dark.png#dark)
