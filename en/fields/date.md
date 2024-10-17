# Date

- [Date and time](#date-and-time)
- [Format](#format)

---

Extends [Text](https://moonshine-laravel.com/docs/resource/fields/fields-text)  
* has the same features

The *Date* field is an extension of *Text*, which by default sets `type=date` and has additional methods.

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
## Date and time
Using the `withTime()` method allows you to enter a date and time into a field.

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
## Format

The `format()` method allows you to change the display format of the field value in preview.

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
