<x-sub-title>Способ отображения</x-sub-title>

<x-p>
    Для отображения действий в виде выпадающего списка можно воспользоваться методом <code>showInDropdown</code>
</x-p>

<x-code language="php">
->showInDropdown()
</x-code>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    Данный способ отображения используется по умолчанию
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/actions_dropdown.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/actions_dropdown_dark.png') }}"></x-image>

<x-p>
    Для отображения действий в виде горизонтального списка можно воспользоваться методом <code>showInLine</code>
</x-p>

<x-code language="php">
->showInLine()
</x-code>

<x-image theme="light" src="{{ asset('screenshots/actions_line.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/actions_line_dark.png') }}"></x-image>

<x-sub-title>Подтверждение действия</x-sub-title>

<x-p>
    Для подтверждения действия необходимо воспользоваться методом <code>withConfirm</code>
</x-p>

<x-code language="php">
    ->withConfirm()
</x-code>

<x-image theme="light" src="{{ asset('screenshots/actions_confirm.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/actions_confirm_dark.png') }}"></x-image>
