https://moonshine-laravel.com/docs/resource/fields/fields-has_many_through?change-moonshine-locale=en

------

# HasManyThrough

Extends [HasMany](https://moonshine-laravel.com/docs/resource/fields/fields-has_many)
* has the same features    

The *HasManyThrough* field is designed to work with the relation of the same name in Laravel, inherits from the *HasMany* field and includes all its methods.

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



