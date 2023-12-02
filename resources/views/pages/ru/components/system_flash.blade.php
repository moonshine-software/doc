<x-page
    title="Системный компонент Flash"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#make', 'label' => 'Make'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Компонент <em>Flash</em> используется для показа различных уведомлений.
</x-p>

<x-p>
    Создать <em>Flash</em> можно воспользовавшись статическим методом <code>make()</code>
    класса <code>Flash</code>.
</x-p>

<x-code language="php">
make(string $key = 'alert', string $type = 'info', bool $withToast = true, bool $removable = true)
</x-code>

<x-p>
    <code>$key</code> - ключ уведомлений в сессии,<br>
    <code>$type</code> - тип уведомления,<br>
    <code>$withToast</code> - использование Toast,<br>
    <code>$removable</code> - возможность скрыть уведомление.
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
