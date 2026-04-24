# Password

- [Основы](#basics)
- [PasswordRepeat](#password-repeat)

- [Режим Raw](#режим-raw)
---

<a name="basics"></a>
## Основы

Наследует [Text](/docs/{{version}}/fields/text).

\* имеет те же возможности.

Поля `Password` и `PasswordRepeat` предназначены для работы с паролями, у них по умолчанию установлен `type=password`.

Поле `Password` в режиме "preview" отображается как "***".
При выполнении метода `apply()` значение поля кодируется с помощью метода `make()` класса, привязанного к интерфейсу `Illuminate\Contracts\Hashing\Hasher`.

> [!NOTE]
> В **Laravel** по умолчанию `Hasher` класс - фасад `Illuminate\Support\Facades\Hash`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\UI\Fields\Password;

Password::make('Password')
```

@preview('fields.password')

<a name="password-repeat"></a>
## PasswordRepeat

`PasswordRepeat` наследует `Password` и используется как вспомогательное поле для подтверждения пароля и не изменяет данные при выполнении метода `apply()`.

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:2]
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\PasswordRepeat;

Password::make('Password', 'password'),
PasswordRepeat::make('Password repeat', 'password_repeat')
```

## Режим Raw

Поле `Password` теперь поддерживает режим raw, позволяющий сохранять пароли в виде обычного текста, а не в хэшированном виде. Это может быть полезно в сценариях, когда хэширование не требуется или когда вам нужно обработать пароль в его исходной форме.

### Использование

Чтобы включить режим raw, используйте метод `raw()` для поля `Password`. Вы можете передать логическое значение или замыкание, чтобы условно включить режим raw.

```php
Password::make('Password')->raw(true)
```

Если вы хотите условно включить режим raw на основе некоторой логики, вы можете передать замыкание:

```php
Password::make('Password')->raw(fn() => $someCondition)
```

По умолчанию пароли сохраняются в хэшированном виде.
