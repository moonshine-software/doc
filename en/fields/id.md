https://moonshine-laravel.com/docs/resource/fields/fields-id?change-moonshine-locale=en

------

# ID

Extends [Hidden](https://moonshine-laravel.com/docs/resource/fields/fields-hidden)
* has the same features  

The *ID* field is used for the primary key.
It, like the *Hidden* field, is displayed only in preview and is not displayed in forms.

```php
use MoonShine\Fields\ID;

//...

public function fields(): array
{
    return [
        ID::make()
    ];
}
```

If the primary key has a name different from id, then you must specify the arguments to the `make()` method.

```php
use MoonShine\Fields\ID;

//...

public function fields(): array
{
    return [
        ID::make('ID', 'primary_key')
    ];
}

//...
```
