https://moonshine-laravel.com/docs/resource/components/components-system_profile?change-moonshine-locale=en

------
# System component Profile

## Sections
- [Make](#make)
- [Default avatar](#default-avatar)

<a name="make"></a>
## Make

The system component *Profile* is used to display information about an authorized user in **MoonShine**.

You can create a *Profile* using the static method `make()` class `Profile`.

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

- `route` - profile page route,
- `logOutRoute` - route for logout
- `avatar` - user avatar
- `nameOfUser` - user name
- `username` - username (email|login|tel ...)
- `withBorder` - split before the component
- `guard` - used by *Guard* for user authorization.

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

![profile](https://moonshine-laravel.com/screenshots/profile.png)
![profile_dark](https://moonshine-laravel.com/screenshots/profile_dark.png)

<a name="default-avatar"></a>
## Default avatar

The `defaultAvatar()` method allows you to override the default profile avatar.

```php
defaultAvatar(string $url)
```

- `url` - default avatar url.

```php
use MoonShine\Components\Layout\Profile;

//...

Profile::make()
    ->defaultAvatar("https://ui-avatars.com/api/?name=$name")
```
