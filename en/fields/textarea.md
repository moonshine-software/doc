# Textarea

- [Basics](#basics)
- [Field Height](#rows)
- [Disabling Escaping](#unescape)
- [Escaping on apply](#escape-on-apply)

---

<a name="basics"></a>
## Basics

Contains all [Basic Methods](/docs/{{version}}/fields/basic-methods).

The `Textarea` field is a multi-line text input field in **MoonShine**. This field is equivalent to the `<textarea></textarea>` tag.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Textarea;

Textarea::make('Text')
```

@preview('fields.textarea')

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

The field inherits the global [`escape` and `escape_on_apply` settings](/docs/{{version}}/configuration#field-escaping), both `true` by default. `escape` controls both the preview and the value inside the textarea form control.
Explicit `escape()` and `unescape()` calls override `escape`; they do not change escaping when applying submitted values.

<a name="escape-on-apply"></a>
## Escaping on Apply

As with [Text](/docs/{{version}}/fields/text#escape-on-apply), `escapeOnApply()` overrides the global setting independently of display escaping:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Textarea;

Textarea::make('HTML Content', 'content')
    ->escape()
    ->escapeOnApply(fn (Textarea $field): bool => false)
```

This example stores the original string while escaping its display. To explicitly enable escaping on apply even when it is disabled globally, use `->escapeOnApply()` without an argument. The field method accepts a closure, not a boolean.
