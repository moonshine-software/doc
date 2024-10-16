# Phone

Расширяет [Text](/docs/{{version}}/fields/text)
* имеет те же функции  

Поле *Phone* является расширением *Text*, которое по умолчанию устанавливает `type=tel`.  

```php
use MoonShine\Fields\Phone;

//...

public function fields(): array
{
    return [
        Phone::make('Phone')
    ];
}

//...
```

> [!NOTE]
> Для использования маски для телефона используйте метод `mask('7 999 999-99-99')`
