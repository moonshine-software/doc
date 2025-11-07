# Уведомления

- [Основы](#basics)
- [Настройка](#settings)
- [Компонент](#component)
- [Кастомные уведомления](#custom)
- [WebSocket](#web-socket)

---

<a name="basics"></a>
## Основы

> [!NOTE]
> По умолчанию **MoonShine** использует [Laravel Database Notifications](https://laravel.com/docs/notifications#database-notifications),
> но мы используем абстракции, которые легко заменить.

Если есть необходимость добавить уведомления в центр уведомлений **MoonShine**, используйте класс `MoonShineNotification`.

Напрямую через статически метод `send()`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:3]
use MoonShine\Laravel\Notifications\MoonShineNotification;
use MoonShine\Laravel\Notifications\NotificationButton;
use MoonShine\Support\Enums\Color;

MoonShineNotification::send(
    message: 'Notification text',
    // Необязательная кнопка
    button: new NotificationButton('Click me', 'https://moonshine.cutcode.dev', attributes: ['target' => '_blank']),
    // Необязательные ID администраторов (по умолчанию для всех)
    ids: [1,2,3],
    // Необязательный цвет иконки
    color: Color::GREEN,
    // Необязательная иконка
    icon: 'information-circle'
);
```

Или через `DI`:

```php
// torchlight! {"summaryCollapsedIndicator": "namespaces"}
// [tl! collapse:1]
use MoonShine\Crud\Contracts\Notifications\MoonShineNotificationContract;

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
## Настройка

Во время установки **MoonShine** у вас есть возможность выбрать, хотите ли вы использовать уведомления и `Database Notification`.
Кроме того, вы можете изменить эти настройки позже через конфигурацию:

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
## Компонент

Для вывода уведомлений используется компонент [Notifications](/docs/{{version}}/components/notifications), который вы можете заменить на свой через [Layout](/docs/{{version}}/appearance/layout).

<a name="custom"></a>
## Кастомные уведомления

**MoonShine** гибкий и всё в нем можно заменить на собственные реализации.
Для уведомлений нужно реализовать интерфейсы:

- `MoonShineNotificationContract`
- `NotificationItemContract`
- `NotificationButtonContract` (опционально)

После в `ServiceProvider` заменить реализацию на собственную:

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

Готовая реализация уведомлений через WebSocket реализована в пакете [Rush](/plugins/rush).
