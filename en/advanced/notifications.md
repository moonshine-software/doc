# Notifications

- [Basics](#basics)
- [Settings](#settings)
- [Component](#component)
- [Custom Notifications](#custom)
- [WebSocket](#web-socket)

---

<a name="basics"></a>
## Basics

> [!NOTE]
> By default, **MoonShine** uses [Laravel Database Notification](https://laravel.com/docs/notifications#database-notifications),
> but we use abstractions that can be easily replaced.

If you need to add notifications to the **MoonShine** notification center, use the `MoonShineNotification` class.

Directly via the static method `send()`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\Laravel\Notifications\MoonShineNotification;
use MoonShine\Laravel\Notifications\NotificationButton;
use MoonShine\Support\Enums\Color;

MoonShineNotification::send(
    message: 'Notification text',
    // Optional button
    button: new NotificationButton('Click me', 'https://moonshine.cutcode.dev', attributes: ['target' => '_blank']),
    // Optional administrator IDs (default for all)
    ids: [1,2,3],
    // Optional icon color
    color: Color::GREEN,
    // Optional icon
    icon: 'information-circle'
);
```

Or via `DI`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Laravel\Contracts\Notifications\MoonShineNotificationContract;

public function di(MoonShineNotificationContract $notification)
{
    $notification->notify(
        'Hello'
    );
}
```

![notifications](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/notifications.png#light)
![notifications_dark](https://raw.githubusercontent.com/moonshine-software/doc/4.x/resources/screenshots/notifications_dark.png#dark)

<a name="settings"></a>
## Settings

During the installation of **MoonShine**, you have the option to choose whether you want to use notifications and `Database Notification`.
Additionally, you can change these settings later through the configuration:

~~~tabs
tab: config/moonshine.php
```php
'use_notifications' => true,
'use_database_notifications' => true,
```
tab: MoonShineServiceProvider
```php
$config
    ->useNotifications()
    ->useDatabaseNotifications();
```
~~~

<a name="component"></a>
## Component

The component [Notifications](/docs/{{version}}/components/notifications) is used to display notifications, which you can replace with your own through [Layout](/docs/{{version}}/appearance/layout).

<a name="custom"></a>
## Custom Notifications

**MoonShine** is flexible and everything can be replaced with your own implementations.
For notifications, you need to implement the interfaces:

- `MoonShineNotificationContract`
- `NotificationItemContract`
- `NotificationButtonContract` (optional)

Then, in the `ServiceProvider`, replace the implementation with your own:

```php
public function boot(): void
{
    $this->app->singleton(
        MoonShineNotificationContract::class,
        MyNotificationSystem::class
    );
}
```

<a name="web-socket"></a>
## WebSocket

A ready-made implementation of notifications via WebSocket is available in the [Rush](/plugins/rush) package.
