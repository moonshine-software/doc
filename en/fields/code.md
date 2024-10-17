# Code

- [Language](#language)
- [Line numbering](#line-numbers)

---

Extends [Textarea](https://moonshine-laravel.com/docs/resource/fields/fields-textarea)
*has the same features

The *Code* field is an extension of *Textarea* with a visual appearance of the edited code.

```php
use MoonShine\Fields\Code;

//...

public function fields(): array
{
    return [
        Code::make('Code')
    ];
}
//...
```

![code](https://moonshine-laravel.com/screenshots/code.png)
![code_dark](https://moonshine-laravel.com/screenshots/code_dark.png)

<a name="language"></a>
## Language

By default, PHP styling is used, but using the `language()` method You can change the design for another programming language.

```php
language(string $language)
```

Supported languages: `HTML` , `XML` , `CSS` , `PHP` , `JavaScript` and many others.

```php
use MoonShine\Fields\Code;

//...

public function fields(): array
{
    return [
        Code::make('Code')
            ->language('js')
    ];
}
//...
```

<a name="line-numbering"></a>
## Line numbering

The `lineNumbers()` method allows you to display line numbering.

```php
lineNumbers()
```

```php
use MoonShine\Fields\Code;

//...

public function fields(): array
{
    return [
        Code::make('Code')
            ->lineNumbers()
    ];
}
```
