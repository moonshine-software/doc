# Url

- [Основы](#basics)
- [Заголовок](#title)
- [Blank](#blank)

---

Наследует [Text](/docs/{{version}}/fields/text).

\* имеет те же возможности.

<a name="basics"></a>
## Основы

Поле *Url* является расширением *Text*, которое по умолчанию устанавливает `type=url`.

```php
use MoonShine\UI\Fields\Url;

Url::make('Link')
```

<a name="title"></a>
## Заголовок

Метод `title()` позволяет задать заголовок ссылки.

```php
title(Closure $callback)
```

```php
use MoonShine\UI\Fields\Url;

Url::make('Link')
    ->title(fn(string $url, Url $ctx) => str($url)->limit(3))
```

<a name="blank"></a>
## Blank

Метод `blank()` добавляет для превью ссылки аттрибут `target="_blank"`. Поэтому в таком режиме ссылка будет открываться в новом окне.

```php
blank()
```

```php
use MoonShine\UI\Fields\Url;

Url::make('Link')
    ->blank()
```