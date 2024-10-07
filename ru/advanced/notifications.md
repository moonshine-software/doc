# Уведомления

Если есть необходимость добавить уведомления в центр уведомлений MoonShine, используйте класс `MoonShine\Notifications\MoonShineNotification`.

```php
use MoonShine\Notifications\MoonShineNotification;

MoonShineNotification::send(
    message: 'Текст уведомления',
    // Необязательная кнопка
    button: ['link' => 'https://moonshine.cutcode.dev', 'label' => 'Нажми меня'],
    // Необязательные ID администраторов (по умолчанию для всех)
    ids: [1,2,3],
    // Необязательный цвет иконки (purple, pink, blue, green, yellow, red, gray)
    color: 'green'
);
```
![notifications](https://moonshine-laravel.com/screenshots/notifications.png)
![notifications_dark](https://moonshine-laravel.com/screenshots/notifications_dark.png)
