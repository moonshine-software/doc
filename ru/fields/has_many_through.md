# HasManyThrough

Расширяет [HasMany](https://moonshine-laravel.com/docs/resource/fields/fields-has_many)
* имеет те же функции

Поле *HasManyThrough* предназначено для работы с отношением того же имени в Laravel, наследуется от поля *HasMany* и включает все его методы.

```php
use MoonShine\Fields\Relationships\HasManyThrough; 
 
//...
 
public function fields(): array
{
    return [
        HasManyThrough::make('Deployments', 'deployments', resource: new DeploymentResource()) 
    ];
}
 
//...
```
