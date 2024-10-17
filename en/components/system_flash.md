# System component Flash

## Make

The *Flash* component is used to display various notifications.

You can create *Flash* using the static method `make()` class `Flash`.

```php
make(string $key = 'alert', string $type = 'info', bool $withToast = true, bool $removable = true)
```

`$key` - session notification key,
`$type` - notification type,
`$withToast` - using Toast,
`$removable` - option to hide notification.

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

![flash](https://moonshine-laravel.com/screenshots/flash.png)
![flash_dark](https://moonshine-laravel.com/screenshots/flash_dark.png)
