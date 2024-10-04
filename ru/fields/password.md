# Password

Наследует [Text](/docs/{{version}}/fields/text).

\* имеет те же возможности.

Поля *Password* и *PasswordRepeat* предназначены для работы с паролями, у них по умолчанию установленно `type=password`.
Поле *Password* в preview отображается как `***`, а при выполнении метода `apply()` значение поля кодируется, с помощью метода `make`, класса забинженного на интерфейс `Illuminate\Contracts\Hashing\Hasher`.

> [!NOTE]
> В Laravel по умолчанию Hasher класс - фасад `Illuminate\Support\Facades\Hash`.


```php
use MoonShine\UI\Fields\Password;

Password::make()
```

*PasswordRepeat* используется как вспомогательное поле для подтверждения пароля и не изменяет данные при выполнении метода `apply()`.

```php
use MoonShine\UI\Fields\PasswordRepeat;

PasswordRepeat::make()
```