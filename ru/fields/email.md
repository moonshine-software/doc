# Email

Расширяет [Text](/docs/{{version}}/fields/text)  
* имеет те же функции  

Поле электронной почты является расширением *Text*, которое по умолчанию устанавливает `type=email`.

```php
use MoonShine\Fields\Email;

//...

public function fields(): array
{
    return [
        Email::make('Email')
    ];
}

//...
```
