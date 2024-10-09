# MorphMany

Расширяет [HasMany](https://moonshine-laravel.com/docs/resource/fields/fields-has_many)
* имеет те же функции    

Поле отношения в Laravel типа morphMany

То же самое, что `MoonShine\Fields\Relationships\HasMany`, только для отношений morphMany  
`MoonShine\Fields\Relationships\MorphMany`

Для создания этого поля используйте статический метод `make()`.

```php
MorphMany::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null
)
```

- `label` - метка, заголовок поля,
- `relationName` - имя отношения,
- `formatted` - замыкание или поле в связанной таблице для отображения значений.

> [!CAUTION]
> Параметр `formatted` не используется в поле `MorphMany`!

```php
use MoonShine\Fields\Relationships\MorphMany;

//...

public function fields(): array
{
    return [
        MorphMany::make('Comments', 'comments')
    ];
}

//...
```
