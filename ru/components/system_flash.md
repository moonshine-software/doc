# Системный компонент Flash

## Создание

Компонент *Flash* используется для отображения различных уведомлений.

Вы можете создать *Flash*, используя статический метод `make()` класса `Flash`.

```php
make(string $key = 'alert', string $type = 'info', bool $withToast = true, bool $removable = true)
```

`$key` - ключ сессии для уведомления,
`$type` - тип уведомления,
`$withToast` - использование Toast,
`$removable` - возможность скрыть уведомление.

```php
use MoonShine\Decorations\Flash;
//...

public function components(): array
{
    return [
        Flash::make(key: 'session_key', type: 'info', withToast: true, removable: true)
    ];
}

//...
```
