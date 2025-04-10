# Text

- [Basics](#basics)
- [Basic methods](#basic-methods)
  - [Placeholder](#placeholder)
  - [Mask](#mask)
  - [Tags](#tags)
  - [Disable escaping](#unescape)
- [Extensions](#extensions)
  - [Copy](#copy)
  - [Hide value](#eye)
  - [Lock](#locked)
  - [Suffix](#suffix)
- [Editing in preview mode](#preview-edit)

---

<a name="basics"></a>
## Basics

Contains all [Basic methods](/docs/{{version}}/fields/basic-methods).

The `Text` field is a basic text input field in **MoonShine**. This field is equivalent to `<input type="text">`.

~~~tabs
tab: Class
```php
use MoonShine\UI\Fields\Text;

Text::make('Title')
```
tab: Blade
```blade
<x-moonshine::field-container label="Title">
    <x-moonshine::form.input
        type="text"
        name="title"
    />
</x-moonshine::field-container>
```
~~~

![mask](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/mask.png#light)
![mask_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/mask_dark.png#dark)

<a name="basic-methods"></a>
## Basic methods

<a name="placeholder"></a>
### Placeholder

The `placeholder()` method allows you to set placeholder text for the field.

```php
placeholder(string $value)
```

```php
Text::make('Username', 'username')
    ->placeholder('Enter username')
```

<a name="mask"></a>
### Mask
The `mask()` method allows you to apply a mask to the entered text.

```php
mask(string $mask)
```

Example usage:

```php
Text::make('Phone', 'phone')
    ->mask('+7 (999) 999-99-99')
```

![mask](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/mask.png#light)
![mask_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/mask_dark.png#dark)

<a name="tags"></a>
### Tags

The `tags()` method transforms the text field into a tag input field.

```php
tags(?int $limit = null)
```

```php
Text::make('Tags', 'tags')
    ->tags(5)
```

<a name="unescape"></a>
### Disable escaping

The `unescape()` method disables HTML tag escaping in the field value.

```php
Text::make('HTML Content', 'content')
    ->unescape()
```

<a name="extensions"></a>
## Extensions

Fields support various extensions to assist with input control.

![expansion](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/expansion.png#light)
![expansion_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/expansion_dark.png#dark)

<a name="copy"></a>
### Copy

The `copy()` method adds a button to copy the field value.

```php
copy(string $value = '{{value}}')
```

```php
Text::make('Token', 'token')
    ->copy()
```

<a name="eye"></a>
### Hide value

The `eye()` method adds a button to show/hide the field value (e.g., for passwords).

```php
Text::make('Password', 'password')
    ->eye()
```

<a name="locked"></a>
### Lock

The `locked()` method adds a lock icon to the field.

```php
Text::make('Protected field', 'protected_field')
    ->locked()
```

<a name="suffix"></a>
### Suffix

The `suffix()` method adds a suffix to the input field.

```php
suffix(string $ext)
```

```php
Text::make('Domain', 'domain')
    ->suffix('.com')
```

<a name="preview-edit"></a>
## Editing in preview mode

This field supports [editing in preview mode](/docs/{{version}}/fields/basic-methods#preview-edit).

> [!NOTE]
> If you want to avoid input errors, you can use the [Lock](#locked) extension.

```php
Text::make('Name')
    ->updateOnPreview()
    ->locked()
```
