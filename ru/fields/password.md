# Password

- [Основы](#basics)
- [PasswordRepeat](#password-repeat)

---

<a name="basics"></a>
## Основы

Наследует [Text](/docs/{{version}}/fields/text).

\* имеет те же возможности.

Поля *Password* и *PasswordRepeat* предназначены для работы с паролями, у них по умолчанию установлен `type=password`.

Поле *Password* в режиме предпросмотра отображается как `***`, а при выполнении метода `apply()` значение поля кодируется, с помощью метода `make`, класса забиндженного на интерфейс `Illuminate\Contracts\Hashing\Hasher`.

> [!NOTE]
> В Laravel по умолчанию Hasher класс - фасад `Illuminate\Support\Facades\Hash`.

```php
use MoonShine\UI\Fields\Password;

Password::make('Password')
```

<a name="password-repeat"></a>
## PasswordRepeat

*PasswordRepeat* наследует *Password* и используется как вспомогательное поле для подтверждения пароля, и не изменяет данные при выполнении метода `apply()`.

```php
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\PasswordRepeat;

Password::make('Password'),
PasswordRepeat::make('Password repeat', 'password_repeat')
```

