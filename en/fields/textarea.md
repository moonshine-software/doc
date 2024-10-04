https://moonshine-laravel.com/docs/resource/fields/fields-textarea?change-moonshine-locale=en

------
# Textarea

The *Textarea* field includes all the basic methods

```php   
use MoonShine\Fields\Textarea;

//...

public function fields(): array
{
    return [
        Textarea::make('Text')
    ];
}

//...
```

## Default value

You can use the `default()` method if you need to specify a default value for a field.

```php   
default(mixed $default)
```

```php
use MoonShine\Fields\Textarea;

//...

public function fields(): array
{
    return [
        Textarea::make('Text')
            ->default('...')
    ];
}

//...
```
