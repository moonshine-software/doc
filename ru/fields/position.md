# Position

Расширяет [Preview](/docs/{{version}}/fields/preview)
* имеет те же функции  

Поле *Position* позволяет создавать нумерацию для итерируемых элементов.

```php
use MoonShine\Fields\Json;
use MoonShine\Fields\Position;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Json::make('Опции продукта', 'options')
            ->fields([
                Position::make(),
                Text::make('Заголовок'),
                Text::make('Значение'),
                Switcher::make('Активно')
            ])
    ];
}

//...
```

![json_fields](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/json_fields.png#light) 
![json_fields](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/json_fields_dark.png#dark)
