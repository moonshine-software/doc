<x-page title="Уведомления">

<x-p>
    Если есть необходимость добавить уведомления в центр уведомлений MoonShine, то
    воспользуйтесь классом <code>MoonShine\Notifications\MoonShineNotification</code>.
</x-p>

<x-code language="php">
use MoonShine\Notifications\MoonShineNotification;

MoonShineNotification::send(
    message: 'Notification message',
    // Опционально button
    button: ['link' => 'https://moonshine.cutcode.dev', 'label' => 'Click me'],
    // Опционально id администраторов (по умолчанию всем)
    ids: [1,2,3],
    // Опционально цвет иконки (purple, pink, blue, green, yellow, red, gray)
    color: 'green'
);
</x-code>

<x-image theme="light" src="{{ asset('screenshots/notifications.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/notifications_dark.png') }}"></x-image>

</x-page>
