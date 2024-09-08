https://moonshine-laravel.com/docs/resource/fields/fields-date?change-moonshine-locale=en

------

## Date

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

![Creation date](https://moonshine-laravel.com/screenshots/date_dark.png)
![Creation date](https://moonshine-laravel.com/screenshots/date.png)

### Date and time
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

![date_time](https://moonshine-laravel.com/screenshots/date_time.png)

![date_time_dark](https://moonshine-laravel.com/screenshots/date_time_dark.png)

### Format

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
