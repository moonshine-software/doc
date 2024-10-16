# Url

  - [Основы](#basics)
  - [Заголовок](#title)
  - [Новое окно](#blank)

---

Расширяет [Text](https://moonshine-laravel.com/docs/resource/fields/fields-text)
* имеет те же функции

<a name="basics"></a>
## Основы

Поле *Url* является расширением *Text*, которое по умолчанию устанавливает `type=url`.

```php
use MoonShine\Fields\Url;

//...

public function fields(): array
{
    return [
        Url::make('Link')
    ];
}

//...
```

<a name="title"></a>
## Заголовок

Метод `title()` позволяет установить заголовок ссылки.

```php
title(Closure $callback)
```
  
```php
use MoonShine\Fields\Url;

//...

Url::make('Link')
    ->title(fn(string $url, Url $ctx) => str($url)->limit(3))
```

<a name="blank"></a>
## Новое окно

Метод `blank()` позволяет открывать ссылку в новом окне.

```php
blank()
```
    
```php
use MoonShine\Fields\Url;

//...

Url::make('Link')
    ->blank()
```
