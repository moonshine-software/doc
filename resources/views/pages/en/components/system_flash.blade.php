<x-page
    title="System component Flash"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The <em>Flash</em> component is used to display various notifications.
</x-p>

<x-p>
    You can create <em>Flash</em> using the static method <code>make()</code>
     class <code>Flash</code>.
</x-p>

<x-code language="php">
make(string $key = 'alert', string $type = 'info', bool $withToast = true, bool $removable = true)
</x-code>

<x-p>
    <code>$key</code> - session notification key,<br>
    <code>$type</code> - notification type,<br>
    <code>$withToast</code> - using Toast,<br>
    <code>$removable</code> - option to hide notification.
</x-p>

<x-code language="php">
use MoonShine\Decorations\Flash; // [tl! focus]

//...

public function components(): array
{
    return [
        Flash::make(key: 'session_key', type: 'info', withToast: true, removable: true) // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/flash.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/flash_dark.png') }}"></x-image>

</x-page>
