# Textarea

Поле *Textarea* включает все базовые методы

```php   
use MoonShine\Fields\Textarea;

//...

public function fields(): array
{
    return [
        Textarea::make('Текст')
    ];
}

//...
```

## Значение по умолчанию

Вы можете использовать метод `default()`, если вам нужно указать значение по умолчанию для поля.

```php   
default(mixed $default)
```

```php
use MoonShine\Fields\Textarea;

//...

public function fields(): array
{
    return [
        Textarea::make('Текст')
            ->default('...')
    ];
}

//...
```
