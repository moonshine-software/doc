# HasOneThrough

Extends  [HasMany](https://moonshine-laravel.com/docs/resource/fields/fields-has_one)
* has the same features  

The *HasOneThrough* field is designed to work with the relation of the same name in Laravel, inherits from the *HasOne* field and includes all its methods.

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
