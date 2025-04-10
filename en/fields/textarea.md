# Textarea

- [Basics](#basics)
- [Field Height](#rows)
- [Disabling Escaping](#unescape)

---

<a name="basics"></a>
## Basics

Contains all [Basic Methods](/docs/{{version}}/fields/basic-methods).

The `Textarea` field is a multi-line text input field in **MoonShine**. This field is equivalent to the `<textarea></textarea>` tag.

```php
use MoonShine\UI\Fields\Textarea;

Textarea::make('Text')
```

<a name="rows"></a>
## Field Height

To set the height of the field, you can use [attributes](/docs/{{version}}/fields/basic-methods#custom-attributes).

```php
Textarea::make('Text')
    ->customAttributes([
        'rows' => 6,
    ])
```

<a name="unescape"></a>
## Disabling Escaping

The `unescape()` method disables the escaping of HTML tags in the field value.

```php
Textarea::make('HTML Content', 'content')
    ->unescape()
```
