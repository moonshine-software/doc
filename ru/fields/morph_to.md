# MorphTo

Расширяет [BelongsTo](https://moonshine-laravel.com/docs/resource/fields/fields-belongs_to)
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

![morph_to](https://moonshine-laravel.com/screenshots/morph_to.png)
![morph_to_dark](https://moonshine-laravel.com/screenshots/morph_to_dark.png)

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

![morph_to_array](https://moonshine-laravel.com/screenshots/morph_to_array.png)
![morph_to_array_dark](https://moonshine-laravel.com/screenshots/morph_to_array_dark.png)
