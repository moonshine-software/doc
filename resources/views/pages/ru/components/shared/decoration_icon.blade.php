<x-p>
    Метод <code>icon()</code> позволяет добавить иконку.
</x-p>

<x-code language="php">
use MoonShine\Decorations\{{ $decoration }};

//...

public function components(): array
{
    return [
        {{ $decoration }}::make('{{ $decoration }}')
            ->icon('heroicons.outline.users') // [tl! focus]
    ];
}

//...
</x-code>

@include('pages.ru.shared.alert_icons')

<x-image theme="light" src="{{ asset('screenshots/' . str($decoration)->snake('_')->append('_icon.png')) }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/' . str($decoration)->snake('_')->append('_icon_dark.png')) }}"></x-image>
