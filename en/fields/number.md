# Number

- [Basics](#basics)
- [Basic Methods](#basic-methods)
  - [Default Value](#default)
  - [Placeholder](#placeholder)
  - [Buttons +/-](#buttons)
- [Methods for Working with Numerical Values](#number-type-methods)
  - [Max and Min Value](#min-and-max)
  - [Step](#step)
  - [Stars](#stars)
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

The `Number` field is a basic numeric input field in **MoonShine**. This field is equivalent to `<input type="number">`.

~~~tabs
tab: Class
```php
use MoonShine\UI\Fields\Number;

Number::make('Sort')
```
tab: Blade
```blade
<x-moonshine::field-container label="Sort">
    <x-moonshine::form.input
        type="number"
        name="sort"
    />
</x-moonshine::field-container>
```
~~~

<a name="basic-methods"></a>
## Basic Methods

<a name="default"></a>
### Default Value

You can use the `default()` method if you need to specify a default value for the field.

```php
default(mixed $default)
```

```php
use MoonShine\UI\Fields\Number;

Number::make('Title')
    ->default(2)
```

<a name="placeholder"></a>
### Placeholder

The `placeholder()` method allows you to set the *placeholder* attribute for the field.

```php
placeholder(string $value)
```

```php
use MoonShine\UI\Fields\Number;

Number::make('Rating', 'rating')
    ->nullable()
    ->placeholder('Product Rating')
```

<a name="buttons"></a>
### Buttons +/-

The `buttons()` method allows you to add buttons to the field for increasing or decreasing the value.

```php
buttons()
```

```php
use MoonShine\UI\Fields\Number;

Number::make('Rating')
    ->buttons()
```

![number_buttons](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/number_buttons.png)

<a name="number-type-methods"></a>
## Methods for Working with Numerical Values

<a name="min-and-max"></a>
### Max and Min Value

The `min()` and `max()` methods are used to set the minimum and maximum values for the field.

```php
min(int|float $min)
```

```php
max(int|float $max)
```

<a name="step"></a>
### Step

The `step()` method is used to specify the step value for the field.

```php
step(int|float $step)
```

```php
use MoonShine\UI\Fields\Number;

Number::make('Price')
    ->min(0)
    ->max(100000)
    ->step(5)
```

<a name="stars"></a>
### Stars

The `stars()` method is used to display the numerical value in the preview mode as stars (e.g., for ratings).

```php
stars()
```

```php
use MoonShine\UI\Fields\Number;

Number::make('Rating')
    ->stars()
    ->min(1)
    ->max(10)
```

<a name="extensions"></a>
## Extensions

Fields support various extensions for assistance and input control.

![expansion](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/expansion.png#light)
![expansion_dark](https://raw.githubusercontent.com/moonshine-software/doc/3.x/resources/screenshots/expansion_dark.png#dark)

<a name="copy"></a>
### Copy

The `copy()` method adds a button to copy the field's value.

```php
copy(string $value = '{{value}}')
```

Example usage:

```php
Number::make('Price')
    ->copy()
```

<a name="eye"></a>
### Hide Value

The `eye()` method adds a button to show/hide the field's value (e.g., for passwords).

```php
eye()
```

Example usage:

```php
Number::make('Password', 'password')
    ->eye()
```

<a name="locked"></a>
### Lock

The `locked()` method adds a lock icon to the field.

```php
locked()
```

Example usage:

```php
Number::make('Protected Field', 'protected_field')
    ->locked()
```

### Suffix

The `suffix()` method adds a suffix to the input field.

```php
suffix(string $ext)
```

<a name="preview-edit"></a>
## Preview Edit

This field supports [preview editing](/docs/{{version}}/fields/basic-methods#preview-edit).
