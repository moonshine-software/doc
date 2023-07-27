<x-sub-title id="view">Способ отображения</x-sub-title>

<x-p>
    Для отображения действий в виде выпадающего списка можно воспользоваться методом <code>showInDropdown</code>
</x-p>

<x-code language="php">
use MoonShine\{!! ($action === 'ExportAction' ||  $action === 'ImportAction') ? 'Action' : $action !!}s\{{ $action }};

//...
public function {!! ($action === 'ExportAction' ||  $action === 'ImportAction') ? 'action' : str($action)->camel() !!}s(): array
{
    return [
    @if ( $action === 'ExportAction' ||  $action === 'ImportAction')
    {!! $action !!}::make('{!! str($action)->replace('Action', '') !!}')
    @else
    {{ $action }}::make('Deactivation', function (Model $item) {
            $item->update(['active' => false]);
        }, 'Deactivated')
    @endif
        ->showInDropdown() // [tl! focus]
    ];
}
//...
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
use MoonShine\{!! ($action === 'ExportAction' ||  $action === 'ImportAction') ? 'Action' : $action !!}s\{{ $action }};

//...
public function {!! ($action === 'ExportAction' ||  $action === 'ImportAction') ? 'action' : str($action)->camel() !!}s(): array
{
    return [
    @if ( $action === 'ExportAction' ||  $action === 'ImportAction')
    {!! $action !!}::make('{!! str($action)->replace('Action', '') !!}')
    @else
    {{ $action }}::make('Deactivation', function (Model $item) {
            $item->update(['active' => false]);
        }, 'Deactivated')
    @endif
        ->showInLine() // [tl! focus]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/actions_line.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/actions_line_dark.png') }}"></x-image>
