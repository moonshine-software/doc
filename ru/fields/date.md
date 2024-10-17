# Дата

- [Дата и время](#date-and-time)
- [Формат](#format)

---

Расширяет [Text](/docs/{{version}}/fields/text)  
* имеет те же функции

Поле *Дата* является расширением *Text*, которое по умолчанию устанавливает `type=date` и имеет дополнительные методы.

```php
use MoonShine\Fields\Date;

//...

public function fields(): array
{
    return [
        Date::make('Created at', 'created_at')
    ];
}

//
```

![Creation date](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/date_dark.png)
![Creation date](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/date.png)

<a name="date-and-time"></a>
## Дата и время
Использование метода `withTime()` позволяет вводить дату и время в поле.

```php
withTime()
```

```php
use MoonShine\Fields\Date;

//...

public function fields(): array
{
    return [
        Date::make('Created at', 'created_at')
            ->withTime()
    ];
}

//...
```

![date_time](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/date_time.png)

![date_time_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/date_time_dark.png)

<a name="format"></a>
## Формат

Метод `format()` позволяет изменить формат отображения значения поля в предпросмотре.

```php
format(string $format)
```

```php
use MoonShine\Fields\Date;

//...

public function fields(): array
{
    return [
        Date::make('Created at', 'created_at')
            ->format('d.m.Y')
    ];
}

//...
```
