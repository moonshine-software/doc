# HasOneThrough

Расширяет [HasMany](https://moonshine-laravel.com/docs/resource/fields/fields-has_one)
* имеет те же функции

Поле *HasOneThrough* предназначено для работы с отношением того же имени в Laravel, наследуется от поля *HasOne* и включает все его методы.

```php
use MoonShine\Fields\Relationships\HasOneThrough;

//...

public function fields(): array
{
    return [
        HasOneThrough::make('Car owner', 'carOwner', resource: new OwnerResource())
    ];
}

//...
```
