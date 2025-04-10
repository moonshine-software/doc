# Date

- [Basics](#basics)
- [Basic Methods](#basic-methods)
  - [Date and Time](#date-and-time)
  - [Format](#format)
- [Extensions](#extensions)
    - [Copy](#copy)
    - [Hide Value](#eye)
    - [Lock](#locked)
    - [Suffix](#suffix)
- [Preview Edit](#preview-edit)

---

<a name="basics"></a>
## Basics

Contains all [Basic Methods](/docs/{{version}}/fields/basic-methods).

The `Date` field is equivalent to `<input type="date">`.

~~~tabs
tab: Class
```php
use MoonShine\UI\Fields\Date;

Date::make('Created at', 'created_at')
```
tab: Blade
```blade
<x-moonshine::form.wrapper label="Created at">
    <x-moonshine::form.input
        type="date"
        name="created_at"
    />
</x-moonshine::form.wrapper>

```
~~~

![Creation date](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/date.png#light)
![Creation date](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/date_dark.png#dark)

<a name="basic-methods"></a>
## Basic Methods

<a name="date-and-time"></a>
### Date and Time

Using the `withTime()` method allows you to enter both date and time in the field.

```php
Date::make('Created at', 'created_at')
    ->withTime()
```

![date_time](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/date_time.png#light)
![date_time_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/date_time_dark.png#dark)

<a name="format"></a>
### Format

The `format()` method allows you to change the display format of the field's value in preview.

```php
format(string $format)
```

```php
Date::make('Created at', 'created_at')
    ->format('d.m.Y')
```

<a name="extensions"></a>
## Extensions

The field supports various extensions for help and input control.

![expansion](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/expansion.png#light)
![expansion_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/expansion_dark.png#dark)

<a name="copy"></a>
### Copy

The `copy()` method adds a button to copy the field's value.

```php
copy(string $value = '{{value}}')
```

```php
Date::make('Created at', 'created_at')
    ->copy()
```

<a name="eye"></a>
### Hide Value

The `eye()` method adds a button to show/hide the field's value (for example, for passwords).

```php
Date::make('Created at', 'created_at')
    ->eye()
```

<a name="locked"></a>
### Lock

The `locked()` method adds a lock icon to the field.

```php
Date::make('Created at', 'created_at')
    ->locked()
```

### Suffix

The `suffix()` method adds a suffix to the input field.

```php
suffix(string $ext)
```

<a name="preview-edit"></a>
### Preview Edit

This field supports [preview editing](/docs/{{version}}/fields/basic-methods#preview-edit).
