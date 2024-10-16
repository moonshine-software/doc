# ID

Расширяет [Hidden](https://moonshine-laravel.com/docs/resource/fields/fields-hidden)
* имеет те же функции  

Поле *ID* используется для первичного ключа.
Оно, как и поле *Hidden*, отображается только в предпросмотре и не отображается в формах.

```php
use MoonShine\Fields\ID;

//...

public function fields(): array
{
    return [
        ID::make()
    ];
}
```

Если первичный ключ имеет имя, отличное от id, то необходимо указать аргументы для метода `make()`.

```php
use MoonShine\Fields\ID;

//...

public function fields(): array
{
    return [
        ID::make('ID', 'primary_key')
    ];
}

//...
```
