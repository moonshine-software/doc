# Profile

- [Основы](#basics)
- [Аватар placeholder](#avatar-placeholder)
- [Меню](#menu)

---

<a name="basics"></a>
## Основы

С помощью компонента `Profile` вы можете отобразить карточку профиля пользователя с кнопкой выхода, переходом в профиль и дополнительным меню.

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

- `$route` - URL страницы с профилем,
- `$logOutRoute` - URL для logout,
- `$avatar` - Аватар пользователя,
- `$nameOfUser` - Имя пользователя,
- `$username` - Nickname пользователя,
- `$withBorder` - С разделителем сверху,
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
## Аватар placeholder

```php
Profile::make()->avatarPlaceholder('https://robohash.org/username.png')
```

<a name="menu"></a>
## Меню

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
