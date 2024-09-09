https://moonshine-laravel.com/docs/resource/fields/fields-url?change-moonshine-locale=en
------
# Url

  - [Basics](#basics)
  - [Title](#title)
  - [Blank](#blank)

Extends [Text](https://moonshine-laravel.com/docs/resource/fields/fields-text)
* has the same features

<a name="basics"></a>
### Basics

The *Url* field is an extension of *Text*, which by default sets `type=url`.

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
### Title

The `title()` method allows you to set the title of the link.

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
### Blank

The `blank()` method allows you to open a link in a new window.

```php
blank()
```
    
```php
use MoonShine\Fields\Url;

//...

Url::make('Link')
    ->blank()
```
