# Password  
 
Extends [Text](https://moonshine-laravel.com/docs/resource/fields/fields-text)  
* has the same features  

The *Password*and *PasswordRepeat* fields are intended for working with passwords, they have `type=password` set by default.  

The *Password* field in preview is displayed as `***`, and when the `apply()` method is executed, the value of the field is encoded using the `Hash` facade.  

```php
use MoonShine\Fields\Password;

//...

public function fields(): array
{
    return [
        Password::make('Password')
    ];
}

//...
```

*PasswordRepeat* is used as an auxiliary field to confirm the password, and does not change the data when executing the `apply()` method.  

```php
use MoonShine\Fields\Password;
use MoonShine\Fields\PasswordRepeat;

//...

public function fields(): array
{
    return [
        Password::make('Password'),
        PasswordRepeat::make('Password repeat', 'password_repeat')
    ];
}

//...
```
