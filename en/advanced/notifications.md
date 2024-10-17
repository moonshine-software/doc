https://moonshine-laravel.com/docs/resource/advanced/advanced-notifications?change-moonshine-locale=en

------
# Notifications  

If there is a need to add notifications to the MoonShine notification center, then use the `MoonShine\Notifications\MoonShineNotification` class.

```php  
use MoonShine\Notifications\MoonShineNotification;

MoonShineNotification::send(
    message: 'Notification message',
    // Optional button
    button: ['link' => 'https://moonshine.cutcode.dev', 'label' => 'Click me'],
    // Optional id of administrators (default to all)
    ids: [1,2,3],
    // Optional icon color (purple, pink, blue, green, yellow, red, gray)
    color: 'green'
);  
```  
![notifications](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/notifications.png)
![notifications_dark](https://raw.githubusercontent.com/moonshine-software/doc/2.x/resources/screenshots/notifications_dark.png)
