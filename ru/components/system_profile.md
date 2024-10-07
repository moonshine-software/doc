# Системный компонент Profile

## Разделы
- [Создание](#make)
- [Аватар по умолчанию](#default-avatar)

---

<a name="make"></a>
## Создание

Системный компонент *Profile* используется для отображения информации об авторизованном пользователе в **MoonShine**.

Вы можете создать *Profile*, используя статический метод `make()` класса `Profile`.

```php
make(
    ?string $route = null,
    ?string $logOutRoute = null,
    Closure|false|null|string $avatar = null,
    Closure|null|string $nameOfUser = null,
    Closure|null|string $username = null,
    bool $withBorder = false,
    ?string $guard = null
)
```

- `route` - маршрут страницы профиля,
- `logOutRoute` - маршрут для выхода из системы,
- `avatar` - аватар пользователя,
- `nameOfUser` - имя пользователя,
- `username` - имя пользователя (email|login|tel ...),
- `withBorder` - разделитель перед компонентом,
- `guard` - используемый *Guard* для авторизации пользователя.

```php
namespace App\MoonShine;

use MoonShine\Components\Layout\LayoutBlock;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Menu;
use MoonShine\Components\Layout\Profile;
use MoonShine\Components\Layout\Sidebar;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            Sidebar::make([
                Menu::make()->customAttributes(['class' => 'mt-2']),
                Profile::make(withBorder: true)
            ]),

            //...
        ]);
    }
}
```

<a name="default-avatar"></a>
## Аватар по умолчанию

Метод `defaultAvatar()` позволяет переопределить аватар профиля по умолчанию.

```php
defaultAvatar(string $url)
```

- `url` - URL аватара по умолчанию.

```php
use MoonShine\Components\Layout\Profile;

//...

Profile::make()
    ->defaultAvatar("https://ui-avatars.com/api/?name=$name")
```
