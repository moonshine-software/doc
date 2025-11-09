# Profile

- [Basics](#basics)
- [Avatar placeholder](#avatar-placeholder)
- [Menu](#menu)
- [Fragments](#fragments)

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
    ?string $guard = null,
)
```

- `$route` - URL page with Profile,
- `$logOutRoute` - URL for Logout,
- `$avatar` - Avatar,
- `$nameOfUser` - Name,
- `$username` - Nickname,
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


<a name="fragments"></a>
## Fragments

The `Profile` component is placed inside a `Fragment`, due to which the profile data is updated without reloading the page when the user changes.
If necessary, you can manually restart the update of the profile block by raising the [JSEvents](/docs/{{version}}/frontend/js#events) event on the `profile` fragment.

Example with update from controller method:

```php
public function saveElement(CrudRequestContract $request): JsonResponse
{
    //...
    return JsonResponse::make()->events([
        AlpineJs::event(JsEvent::FRAGMENT_UPDATED, 'profile'),
    ]);
}
```
