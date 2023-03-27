<x-page title="Switch">

<x-code language="php">
use Leeto\MoonShine\Fields\SwitchBoolean;

//...
public function fields(): array
{
    return [
        SwitchBoolean::make('Publish', 'active')
    ];
}

//...
</x-code>

<x-code language="php">
use Leeto\MoonShine\Fields\SwitchBoolean;

//...
public function fields(): array
{
    return [
        SwitchBoolean::make('Publish', 'active')
            ->onValue(1) // Active value of a form element
            ->offValue(0) // Inactive value of a form element
    ];
}

//...
</x-code>


<x-code language="php">
use Leeto\MoonShine\Fields\SwitchBoolean;

//...
public function fields(): array
{
    return [
        SwitchBoolean::make('Publish', 'active')
            ->autoUpdate(false) // The option to change on the main page is disabled
            ->autoUpdate(true) // The option to change on the home page is enabled
            ->autoUpdate(fn() => true)
    ];
}

//...
</x-code>

<x-image src="{{ asset('screenshots/switch.png') }}"></x-image>

</x-page>



