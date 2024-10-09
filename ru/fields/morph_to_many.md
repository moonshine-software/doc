# MorphToMany

Расширяет [BelongsToMany](https://moonshine-laravel.com/docs/resource/fields/fields-belongs_to_many) 
* имеет те же функции

Поле отношения MorphToMany в Laravel

То же самое, что `MoonShine\Fields\Relationships\BelongsToMany`, только для отношений MorphToMany `MoonShine\Fields\Relationships\MorphToMany`.

Для создания этого поля используйте статический метод `make()`.

```php
MorphToMany::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null
)
```

- `label` - метка, заголовок поля
- `relationName` - имя отношения
- `formatted` - замыкание или поле в связанной таблице для отображения значений.

```php
use MoonShine\Fields\Relationships\MorphToMany;

//...

public function fields(): array
{
    return [
        MorphToMany::make('Categories', 'categories')
    ];
}

//...
```
