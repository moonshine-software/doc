# Profile

- [Basics](#basics)
- [Avatar placeholder](#avatar-placeholder)
- [Menu](#menu)
- [Update SideBar and TopBar](#update-sidebar-and-topbar)

---

<a name="basics"></a>
## Basics

Using the `Profile` component, you can display a user's profile card with a logout button, a link to the profile, and an additional menu.

```php
make(
    ?string $route = null,
    ?string $logOutRoute = null,
    ?Closure $avatar = null,
    ?Closure $nameOfUser = null,
    ?Closure $username = null,
    bool $withBorder = false,
    ?string $guard = null,
)
```

- `$route` - URL page with Profile,
- `$logOutRoute` - URL for Logout,
- `$avatar` - Avatar,
- `$nameOfUser` - Name,
- `$username` - Nickname,
- `$withBorder` - Divider
- `$guard` - Guard.

~~~tabs
tab: Class
```php
Profile::make()
```
tab: Blade
```blade
<x-moonshine::layout.profile
    route="/admin/profile"
    log-out-route="/logout"
    avatar="/vendor/moonshine/avatar.jpg"
    name-of-user="Admin"
    username="admin@getmoonshine.app"
>
</x-moonshine::layout.profile>
```
~~~

<a name="avatar-placeholder"></a>
## Avatar placeholder

```php
Profile::make()->avatarPlaceholder('https://robohash.org/username.png')
```

<a name="menu"></a>
## Menu

~~~tabs
tab: Class
```php
Profile::make()->menu([
    ActionButton::make('Dashboard', '/admin')->icon('home-modern'),
])
```
tab: Blade
```blade
<x-moonshine::layout.profile
    route="/admin/profile"
    log-out-route="/logout"
    avatar="/vendor/moonshine/avatar.jpg"
    name-of-user="Admin"
    username="admin@getmoonshine.app"
>
    <x-slot:before></x-slot:before>
    <x-slot:after></x-slot:after>

    <x-slot:menu>
        <ul class="dropdown-menu">
            <li class="dropdown-menu-item p-2">
                <x-moonshine::link-native href="/admin/profile">
                    Profile
                </x-moonshine::link-native>
            </li>
        </ul>
    </x-slot:menu>
</x-moonshine::layout.profile>
```
~~~

<a name="update-sidebar-and-topbar"></a>
## Update SideBar and TopBar

After updating the profile, fragments with the `SideBar` and `TopBar` components are automatically updated so that the user immediately sees the updated profile data and interface elements that depend on this data.

> [!NOTE]
> Important condition: The `SideBar` and `TopBar` components must be in the `sidebar-content` and `topbar-actions` fragments. The base template `MoonShine\Laravel\Layouts\BaseLayout` implements this by default.

