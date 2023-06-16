<x-sub-title id="view">Display method</x-sub-title>

<x-p>
    To display actions as a dropdown list, you can use the <code>showInDropdown</code> method
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
    This display method is used by default
</x-moonshine::alert>

<x-image theme="light" src="{{ asset('screenshots/actions_dropdown.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/actions_dropdown_dark.png') }}"></x-image>

<x-p>
    To display actions as a horizontal list, you can use the <code>showInLine</code> method
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

<x-sub-title id="confirm">Confirm the action</x-sub-title>

<x-p>
    To confirm the action, you must use the <code>withConfirm</code> method
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
        ->withConfirm() // [tl! focus]
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/actions_confirm.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/actions_confirm_dark.png') }}"></x-image>

<x-p>
    The <code>withConfirm()</code> method can be passed the title and text for the modal window, as well as the title
    for confirmation button
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
        ->withConfirm('Title', 'Modal content', 'Accept') // [tl! focus]
    ];
}
//...
</x-code>

<x-p>
    The <code>errorMessage()</code> method allows you to set the text of the error message
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
        ->withConfirm('Title', 'Modal content', 'Accept')
        ->errorMessage('Fail') // [tl! focus]
    ];
}
//...
</x-code>
