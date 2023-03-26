<x-page title="Notifications">

<x-p>
    If there is a need to add notifications to the notification center MoonShine, then
    use the class <code>Leeto\MoonShine\Notifications\MoonShineNotification</code>
</x-p>

<x-code language="php">
use Leeto\MoonShine\Notifications\MoonShineNotification;

MoonShineNotification::send(
    message: 'Notification message',
    // Optional button
    button: ['link' => 'https://moonshine.cutcode.dev', 'label' => 'Click me'],
    // Optional id administrators (by default for everyone)
    ids: [1,2,3]
);
</x-code>

<x-image src="{{ asset('screenshots/notifications.png') }}"></x-image>

</x-page>
