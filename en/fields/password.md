# Password

- [Basics](#basics)
- [PasswordRepeat](#password-repeat)

- [Raw Mode](#raw-mode)
---

<a name="basics"></a>
## Basics

Inherits from [Text](/docs/{{version}}/fields/text).

\* has the same capabilities.

The `Password` and `PasswordRepeat` fields are intended for working with passwords, and they are by default set to `type=password`.

The `Password` field displays as "***" in preview mode.
When the `apply()` method is executed, the field value is encoded using the `make()` method of the class bound to the `Illuminate\Contracts\Hashing\Hasher` interface.

> [!NOTE]
> In **Laravel**, by default, `Hasher` class is the facade `Illuminate\Support\Facades\Hash`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Password;

Password::make('Password')
```

@preview('fields.password')

<a name="password-repeat"></a>
## PasswordRepeat

`PasswordRepeat` inherits from `Password` and is used as a helper field for confirming the password and it does not alter the data when the `apply()` method is executed.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\PasswordRepeat;

Password::make('Password', 'password'),
PasswordRepeat::make('Password repeat', 'password_repeat')
```

## Raw Mode

The `Password` field now supports a raw mode, allowing you to store passwords in plain text rather than hashed. This can be useful in scenarios where hashing is not required or when you need to handle the password in its raw form.

### Usage

To enable raw mode, use the `raw()` method on the `Password` field. You can pass a boolean or a closure to conditionally enable raw mode.

```php
Password::make('Password')->raw(true)
```

If you want to conditionally enable raw mode based on some logic, you can pass a closure:

```php
Password::make('Password')->raw(fn() => $someCondition)
```

By default, passwords are stored in a hashed format.
