# Url

- [Basics](#basics)
- [Title](#title)
- [Blank](#blank)

---

Inherits from [Text](/docs/{{version}}/fields/text).

\* has the same capabilities.

<a name="basics"></a>
## Basics

The `Url` field is an extension of `Text` that defaults to setting `type=url`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Url;

Url::make('Link')
```

@preview('fields.url')

<a name="title"></a>
## Title

The `title()` method allows you to set the link title.

```php
title(Closure $callback)
```

```php
Url::make('Link')
    ->title(fn(string $url, Url $ctx) => str($url)->limit(3))
```

<a name="blank"></a>
## Blank

The `blank()` method adds the attribute `target="_blank"` for the link preview. Therefore, in this mode, the link will open in a new window.

```php
blank()
```

```php
Url::make('Link')
    ->blank()
```
