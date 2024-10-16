# Пароль  
 
Расширяет [Text](/docs/{{version}}/fields/text)  
* имеет те же функции  

Поля *Password* и *PasswordRepeat* предназначены для работы с паролями, они имеют установленный по умолчанию `type=password`.  

Поле *Password* в предпросмотре отображается как `***`, а при выполнении метода `apply()` значение поля кодируется с использованием фасада `Hash`.  

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

*PasswordRepeat* используется как вспомогательное поле для подтверждения пароля и не изменяет данные при выполнении метода `apply()`.  

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
