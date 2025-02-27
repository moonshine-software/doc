
~~~tabs
tab: Class
```php
Profile::make()->menu([
    ActionButton::make('Dashboard', '/admin')->icon('home-modern')
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
