<x-page title="Notifications">

<x-p>
    If you need to add notifications to the MoonShine notification center,
    you can use the class: <code>MoonShine\Notifications\MoonShineNotification</code>
</x-p>

<x-code language="php">
use MoonShine\Notifications\MoonShineNotification;

MoonShineNotification::send(
    message: 'Notification message',
    // Optional button
    button: ['link' => 'https://moonshine.cutcode.dev', 'label' => 'Click me'],
    // Optional id administrators (by default for everyone)
    ids: [1,2,3],
    // Optional icon color (purple, pink, blue, green, yellow, red, gray)
    color: 'green'
);
</x-code>

<x-image theme="light" src="{{ asset('screenshots/notifications.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/notifications_dark.png') }}"></x-image>

</x-page>
