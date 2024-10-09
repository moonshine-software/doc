# MorphOne

Расширяет [HasOne](https://moonshine-laravel.com/docs/resource/fields/fields-has_one)
* имеет те же функции  

Поле отношения в Laravel типа morphOne.

То же самое, что `MoonShine\Fields\Relationships\HasOne`, только для отношений MorphOne  
`MoonShine\Fields\Relationships\MorphOne`.

Для создания этого поля используйте статический метод `make()`.

```php
MorphOne::make(
    Closure|string $label,
    ?string $relationName = null,
    Closure|string|null $formatted = null
)
```

- `label` - метка, заголовок поля 
- `relationName` - имя отношения  
- `formatted` - замыкание или поле в связанной таблице для отображения значений.  

```php
use MoonShine\Fields\Relationships\MorphOne;

//...

public function fields(): array
{
    return [
        MorphOne::make('Profile', 'profile')
    ];
}

//...
```
